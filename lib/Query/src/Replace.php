<?php

class Replace extends Pagination {
    /* REPLACE */

    /**
     * returns last get replaced
     * @return array
     */
    public function get_replaced() {
        return self::get_affected();
    }

    /**
     * Function Query replace
     * @param String $table
     * @param mixed $keys_and_values
     * @return \Replace
     */
    public function replace($table, $keys_and_values) {
        $replace_keys = array();
        $replace_values = array();
        foreach ($keys_and_values as $key => $value) {
            $replace_keys[] = $key;
            $replace_values[] = (!is_null($value) ? sprintf('"%s"', $this->_check_link_mysqli($value)) : 'NULL');
        }
        $this->replace_into = "\n" .
                'REPLACE INTO ' . $table . ' (' . "\n" .
                "\t" . implode(',' . "\n\t", $replace_keys) . "\n" .
                ')' . "\n" .
                'VALUES (' . "\n" .
                "\t" . implode(',' . "\n\t", $replace_values) . "\n" .
                ')' . "\n" .
                '';
        return $this;
    }

    /**
     * alias for replace()
     * @param string $table
     * @param mixed $keys_and_values
     * @return \Replace
     */
    public function replace_into($table, $keys_and_values) {
        return self::replace($table, $keys_and_values);
    }

}
