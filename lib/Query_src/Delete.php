<?php

//namespace to organize
namespace Query_src;

/**
 * Class Query Delete Query
 * @author Zachbor       <zachborboa@gmail.com>
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * 
 * @version 0.2
 * @access public
 * @package Delete
 * @subpackage Update
 */
class Delete extends Update {

    /**
     * alias delete_from() 
     * 
     * @access public
     * @param string $table Used to define table name
     * @return \Query
     */
    public function delete($table) {
        return self::delete_from($table);
    }

    /**
     * Delete table
     * 
     * @access public
     * @param string $table Used to define table name
     * @return \Query
     */
    public function delete_from($table) {
        $this->delete_from = $table;
        return $this;
    }

    /**
     * returns get affected last registry delete
     * 
     * @access public
     * @return array
     */
    public function get_deleted() {
        return self::get_affected();
    }

    /**
     * Function Query get affected
     * 
     * @access public
     * @return integer Returns number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE 
     */
    public function get_affected() {
        return mysqli_affected_rows($this->link_mysqi[0]);
    }

}
