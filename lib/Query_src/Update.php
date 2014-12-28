<?php
//namespace to organize
namespace Query_src;

/**
 * Class Query Update Query
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 0.1
 * @access public
 * @package Update
 * @subpackage Where
 */
class Update extends Where {

    /**
     * return last get updated
     * 
     * @access public
     * @return array
     */
    public function get_updated() {
        return self::get_affected();
    }

    /**
     * values set for update Query function
     * 
     * @access public
     * @param mixed $set
     * @return \Update
     */
    public function set($set) {
        $this->set = $set;
        return $this;
    }

    /**
     * Function Query update
     * 
     * @access public
     * @param string $table Table name
     * @param array $set Array colletion columns and value
     * @return \Update
     */
    public function update($table, $set = array()) {
        $this->update = $table;
        if (!empty($set)) {
            self::set($set);
        }
        return $this;
    }

}
