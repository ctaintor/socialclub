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
 * $Id: expense.php,v 1.1 2005/03/27 19:54:30 bps7j Exp $
 */

include_once("database_object.php");

class expense extends database_object {
    // {{{declarations
    var $c_report = null;
    var $c_category = null;
    var $c_expense_date = null;
    var $c_adventure = null;
    var $c_merchant = null;
    var $c_amount = null;
    var $c_description = null;
    // }}}

    /* {{{constructor
     */
    function expense() {
        $this->database_object();
    } //}}}

    /* {{{getReport
     */
    function getReport() {
        return $this->c_report;
    } //}}}
    
    /* {{{setReport
     */
    function setReport($value) {
        $this->c_report = $value;
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

    /* {{{getExpenseDate
     */
    function getExpenseDate() {
        return $this->c_expense_date;
    } //}}}

    /* {{{setExpenseDate
     */
    function setExpenseDate($value) {
        $this->c_expense_date = $value;
    } //}}}

    /* {{{getAdventure
     */
    function getAdventure() {
        return $this->c_adventure;
    } //}}}

    /* {{{setAdventure
     */
    function setAdventure($value) {
        $this->c_adventure = $value;
    } //}}}

    /* {{{getMerchant
     */
    function getMerchant() {
        return $this->c_merchant;
    } //}}}

    /* {{{setMerchant
     */
    function setMerchant($value) {
        $this->c_merchant = $value;
    } //}}}

    /* {{{getAmount
     */
    function getAmount() {
        return $this->c_amount;
    } //}}}

    /* {{{setAmount
     */
    function setAmount($value) {
        $this->c_amount = $value;
    } //}}}

    /* {{{getDescription
     */
    function getDescription() {
        return $this->c_description;
    } //}}}

    /* {{{setDescription
     */
    function setDescription($value) {
        $this->c_description = $value;
    } //}}}

}
?>
