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
 * $Id: write.php,v 1.1 2005/03/27 19:53:17 bps7j Exp $
 */

$template = file_get_contents("templates/group/write.php");
$template = $object->insertIntoTemplate($template);

# Create the form.
$form =& new XmlForm("forms/group/write.xml");

# Put the group's information into the form
$form->setValue("title", $object->getTitle());
$form->setValue("description", $object->getDescription());

# Validate the form
$form->snatch();
$form->validate();

if ($form->isValid()) {
    # Update the group with the form information
    $object->setTitle($form->getValue("title"));
    $object->setDescription($form->getValue("description"));

    # Save the modified group
    $object->update();
    $template = Template::unhide($template, "SUCCESS");
}

$res['content'] = Template::replace($template, array(
    "FORM" => $form->toString()));
$res['title'] = "Edit Group Details";

?>
