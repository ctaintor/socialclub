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
 * $Id: email.php,v 1.1 2005/03/27 19:53:13 bps7j Exp $
 */

include_once("MassEmail.php");
include_once("includes/authorize.php");

$template = file_get_contents("templates/main/email.php");

# Create and validate the form.
$formTemplate = file_get_contents("forms/main/email.xml");
$cmd =& $obj['conn']->createCommand();
$cmd->loadQuery("sql/generic-select.sql");
$cmd->addParameter("table", "[_]activity_category");
$cmd->addParameter("orderby", "c_uid");
$result =& $cmd->executeReader();
while ($row =& $result->fetchRow()) {
    $formTemplate = Template::block($formTemplate, "option", $row);
}

$form =& new XmlForm(Template::finalize($formTemplate), true);
$form->snatch();
$form->validate();

if ($form->isValid()) {
    MassEmail::sendMassEmail(
        $obj['user'],
        $form->getValue("subject"),
        $form->getValue("message"),
        $form->getValue("category"));
    $template = Template::unhide($template, "success");
}
else {
    # Plug the form into the template
    $template = Template::replace($template, array(
        "form" => $form->toString()));
    $template = Template::unhide($template, "initial");
}

$res['content'] = $template;
$res['title'] = "Email Club Members";
$res['navbar'] = "Member's Area";

?>
