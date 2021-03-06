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
 * $Id: item_type.php,v 1.1 2005/03/27 19:54:27 bps7j Exp $
 */

include_once("database_object.php");

class item_type extends database_object {
    // {{{declarations
    var $c_title = null;
    var $c_category = null;
    var $c_primary_feature = null;
    var $c_secondary_feature = null;
    // }}}

    /* {{{constructor
     *
     */
    function item_type() {
        $this->database_object();
    } //}}}

    /* {{{getSecondaryFeature
     */
    function getSecondaryFeature() {
        return $this->c_secondary_feature;
    } //}}}
    
    /* {{{setSecondaryFeature
     */
    function setSecondaryFeature($value) {
        $this->c_secondary_feature = $value;
    } //}}}

    /* {{{getPrimaryFeature
     */
    function getPrimaryFeature() {
        return $this->c_primary_feature;
    } //}}}
    
    /* {{{setPrimaryFeature
     */
    function setPrimaryFeature($value) {
        $this->c_primary_feature = $value;
    } //}}}

    /* {{{getCategory
     */
    function getCategory() {
        return $this->c_category;
    } //}}}
    
    /* {{{setCategory
     */
    function setCategory($value) {
        $this->c_category = $value;
    } //}}}

    /* {{{getTitle
     */
    function getTitle() {
        return $this->c_title;
    } //}}}
    
    /* {{{setTitle
     */
    function setTitle($value) {
        $this->c_title = $value;
    } //}}}

}
?>
