<?php

class Delete extends Update {
    /* DELETE */

    /**
     * alias delete_from() 
     * @param String $table used for define table
     * @return \Query
     */
    public function delete($table) {
        return self::delete_from($table);
    }

    /**
     * Delete table
     * @param String $table used for define table
     * @return \Query
     */
    public function delete_from($table) {
        $this->delete_from = $table;
        return $this;
    }

    public function get_deleted() {
        return self::get_affected();
    }

    /**
     * Function Query get affected
     * @return Integer Returns number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE 
     */
    public function get_affected() {
        $mysqli = $this->link_mysqi;
        return mysqli_affected_rows($mysqli);
    }

}
