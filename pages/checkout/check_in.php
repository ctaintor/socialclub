<?php
/*
 * This file is part of SocialClub (http://socialclub.sourceforge.net)
 * Copyright (C) 2004 Baron Schwartz <baron at sequent dot org>
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307  USA
 * 
 * $Id: check_in.php,v 1.1 2005/03/27 19:53:20 bps7j Exp $
 */

if ($object->getStatus() == $cfg['status_id']['checked_out']
    && isset($_POST['submitted']))
{

    if (isset($_POST['gear']) && is_array($_POST['gear'])) {

        foreach ($_POST['gear'] as $gear) {
            $cmd =& $obj['conn']->createCommand();
            $cmd->loadQuery("sql/checkout_gear/check_in.sql");
            $cmd->addParameter("member", $cfg['user']);
            $cmd->addParameter("checkout_gear", $gear);
            $cmd->addParameter("status", $cfg['status_id']['checked_in']);
            $cmd->executeNonQuery();
        }

    }

    if (isset($_POST['item']) && is_array($_POST['item'])) {

        foreach ($_POST['item'] as $item) {
            $cmd =& $obj['conn']->createCommand();
            $cmd->loadQuery("sql/checkout_item/check_in.sql");
            $cmd->addParameter("checkout_item", $item);
            $cmd->addParameter("status", $cfg['status_id']['checked_in']);
            $cmd->executeNonQuery();

            $cmd =& $obj['conn']->createCommand();
            $cmd->loadQuery("sql/checkout_item/add-note.sql");
            $cmd->addParameter("member", $cfg['user']);
            $cmd->addParameter("checkout_item", $item);
            $cmd->executeNonQuery();
        }

    }

    # Finally, run a query that will update the status of the checkout
    # itself once all the gear and items are checked back in.
    $cmd =& $obj['conn']->createCommand();
    $cmd->loadQuery("sql/checkout/count-outstanding-items.sql");
    $cmd->addParameter("checkout", $cfg['object']);
    $cmd->addParameter("checked_out", $cfg['status_id']['checked_out']);
    $outstandingItems = $cmd->executeScalar();
    if ($outstandingItems == 0) {
        $object->setStatus($cfg['status_id']['checked_in']);
        $object->update();
    }

}

if ($object->getStatus() != $cfg['status_id']['checked_out']) {
    redirect("$cfg[base_url]/members/checkout/read/$cfg[object]");
}

# If we didn't get redirected, we need to display some info about the inventory
$template = file_get_contents("templates/checkout/check_in.php");

# Display a table of items
$cmd =& $obj['conn']->createCommand();
$cmd->loadQuery("sql/checkout/select-items.sql");
$cmd->addParameter("checkout", $cfg['object']);
$cmd->addParameter("status", $cfg['status_id']['checked_out']);
$result =& $cmd->executeReader();
if ($result->numRows()) {
    $template = Template::unhide($template, "someitems");
    while ($row =& $result->fetchRow()) {
        $template = Template::block($template, "item", $row);
    }
}

# Display a table of gear
$cmd =& $obj['conn']->createCommand();
$cmd->loadQuery("sql/checkout/select-gear.sql");
$cmd->addParameter("checkout", $cfg['object']);
$cmd->addParameter("status", $cfg['status_id']['checked_out']);
$result =& $cmd->executeReader();
if ($result->numRows()) {
    $template = Template::unhide($template, "somegear");
    while ($row =& $result->fetchRow()) {
        $template = Template::block($template, "gear", $row);
    }
}

$res['title'] = "Check In Inventory";
$res['content'] = $template;

?>
