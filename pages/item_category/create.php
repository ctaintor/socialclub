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
 * $Id: create.php,v 1.1 2005/03/27 19:53:14 bps7j Exp $
 */

$template = file_get_contents("templates/item_category/create.php");
$form =& new XMLForm("forms/item_category/create.xml");

# Validate the form
$form->snatch();
$form->validate();

if ($form->isValid()) {
    $object =& new item_category();
    $object->setTitle($form->getValue("title"));
    $object->insert();
    redirect("$cfg[base_url]/members/item_category/read/$object->c_uid");
}

$res['content'] = Template::replace($template,
    array("FORM" => $form->toString()));
$res['title'] = "Create a New Item Category";

?>
