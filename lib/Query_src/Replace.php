<?php
//namespace to organize
namespace Query_src;

/**
 * Class Query Replace
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 1.1
 * @access public
 * @package Replace
 * @subpackage Pagination
 */
class Replace extends Pagination {

    /**
     * returns last get replaced
     * 
     * @access public
     * @return array
     */
    public function get_replaced() {
        return self::get_affected();
    }

    /**
     * Function Query replace
     * 
     * @access public
     * @param string $table Table name
     * @param array|string $keys_and_values Array key is the database column the value of the array is the value that will be changed.
     * @return \Replace
     */
    public function replace($table, $keys_and_values) {
        $replace_keys = array();
        $replace_values = array();
        
        foreach ($keys_and_values as $key => $value) {
            $replace_keys[] = $key;
            $replace_values[] = (!is_null($value) ? sprintf('"%s"', $this->_check_link_mysqli($value)) : 'NULL');
        }
        
        $this->replace_into = "\n" . 'REPLACE INTO ' . $table . ' (' . "\n" . "\t" . implode(',' . "\n\t", $replace_keys) . "\n" . ')' . "\n" . 'VALUES (' . "\n" . "\t" . implode(',' . "\n\t", $replace_values) . "\n" . ')' . "\n" . '';
        return $this;
    }

    /**
     * alias for replace()
     * 
     * @access public
     * @param string $table Table name
     * @param array|string $keys_and_values Array key is the database column the value of the array is the value that will be changed.
     * @return \Replace
     */
    public function replace_into($table, $keys_and_values) {
        return self::replace($table, $keys_and_values);
    }

}
