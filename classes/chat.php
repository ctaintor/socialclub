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
 * $Id: chat.php,v 1.1 2005/03/27 19:54:24 bps7j Exp $
 */

include_once("database_object.php");

class chat extends database_object {
    // {{{declarations
    var $c_screenname = null;
    var $c_type = null;
    // }}}

    /* {{{constructor
     *
     */
    function chat() {
        $this->database_object();
    } //}}}

    /* {{{getScreenName
     *
     */
    function getScreenName() {
        return $this->c_screenname;
    } //}}}

    /* {{{setScreenName
     *
     */
    function setScreenName($value) {
        $this->c_screenname = $value;
    } //}}}

    /* {{{getType
     *
     */
    function getType() {
        return $this->c_type;
    } //}}}

    /* {{{setType
     *
     */
    function setType($value) {
        $this->c_type = $value;
    } //}}}

    /* {{{setPrimary
     * Sets the 'primary' flag on this chat and removes it for every
     * other chat that this member owns
     */
    function setPrimary() {
        global $obj;
        global $cfg;
        $cmd =& $obj['conn']->createCommand();
        $cmd->loadQuery("sql/misc/set-primary.sql");
        $cmd->addParameter("table", $this->table);
        $cmd->addParameter("object", $this->c_uid);
        $cmd->addParameter("primary", $cfg['flag']['primary']);
        $cmd->addParameter("member", $this->c_owner);
        $cmd->executeNonQuery();
    } //}}}
    
}
?>
