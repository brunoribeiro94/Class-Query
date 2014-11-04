<?php
//namespace to organize
namespace Query_src;

/**
 * Class Query Delete Query
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 0.1
 * @access public
 * @package Delete
 * @subpackage Update
 */
class Delete extends Update {

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

    /**
     * returns get affected last registry delete
     * @return array
     */
    public function get_deleted() {
        return self::get_affected();
    }

    /**
     * Function Query get affected
     * @return Integer Returns number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE 
     */
    public function get_affected() {
        for ($i = 0; $i < count($this->Connections_Settings); $i++) {
            $link = $this->link_mysqi[$i];
            if (mysqli_affected_rows($link)) {
                $result = mysqli_affected_rows($link);
            }
        }
        return $result;
    }

}
