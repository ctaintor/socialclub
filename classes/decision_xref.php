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
 * $Id: decision_xref.php,v 1.1 2005/03/27 19:54:25 bps7j Exp $
 */

include_once("database_object.php");

class decision_xref extends database_object {
    // {{{declarations
    var $c_decision = null;
    var $c_xref = null;
    // }}}

    /* {{{constructor
     *
     */
    function decision_xref() {
        $this->database_object();
    } //}}}

    /* {{{getXref
     *
     */
    function getXref() {
        return $this->c_xref;
    } //}}}
    
    /* {{{setXref
     *
     */
    function setXref($value) {
        $this->c_xref = $value;
    } //}}}

    /* {{{getDecision
     *
     */
    function getDecision() {
        return $this->c_decision;
    } //}}}
    
    /* {{{setDecision
     *
     */
    function setDecision($value) {
        $this->c_decision = $value;
    } //}}}

}
?>
