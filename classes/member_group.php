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
 * $Id: member_group.php,v 1.1 2005/03/27 19:54:25 bps7j Exp $
 */

include_once("database_object.php");

class member_group extends database_object {
    // {{{declarations
    var $c_member = null;
    var $c_related_group = null;
    // }}}

    /* {{{constructor
     *
     */
    function member_group() {
        $this->database_object();
    } //}}}

    /* {{{getMember
     *
     */
    function getMember() {
        return $this->c_member;
    } //}}}
    
    /* {{{setMember
     *
     */
    function setMember($value) {
        $this->c_member = $value;
    } //}}}

    /* {{{getRelatedGroup
     * Note that you have to use this to get the group for the correspondence,
     * not getGroup().
     */
    function getRelatedGroup() {
        return $this->c_related_group;
    } //}}}

    /* {{{setRelatedGroup
     * Note that you have to use this to set the group for the correspondence.
     * If you use setGroup(), you will change the group that owns the object,
     * not the group that the member should belong to.
     */
    function setRelatedGroup($value) {
        $this->c_related_group = $value;
    } //}}}
}
?>
