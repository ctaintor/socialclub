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
 * $Id: adventure_activity.php,v 1.1 2005/03/27 19:54:22 bps7j Exp $
 */

include_once("database_object.php");

class adventure_activity extends database_object {
    // {{{declarations
    var $c_adventure = null;
    var $c_activity = null;
    // }}}

    /* {{{constructor
     *
     */
    function adventure_activity() {
        $this->database_object();
    } //}}}

    /* {{{getAdventure
     *
     */
    function getAdventure() {
        return $this->c_adventure;
    } //}}}
    
    /* {{{setAdventure
     *
     */
    function setAdventure($value) {
        $this->c_adventure = $value;
    } //}}}

    /* {{{getActivity
     *
     */
    function getActivity() {
        return $this->c_activity;
    } //}}}

    /* {{{setActivity
     *
     */
    function setActivity($value) {
        $this->c_activity = $value;
    } //}}}
}
?>
