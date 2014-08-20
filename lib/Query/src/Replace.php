<?php

class Replace extends Pagination {
    /* REPLACE */

    public function get_replaced() {
        return self::get_affected();
    }

    public function replace($table, $keys_and_values) {
        $mysqli = $this->link_mysqi;

        $replace_keys = array();
        $replace_values = array();
        foreach ($keys_and_values as $key => $value) {
            $replace_keys[] = $key;
            $replace_values[] = (!is_null($value) ? sprintf('"%s"', mysqli_real_escape_string($mysqli, $value)) : 'NULL');
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

    public function replace_into($table, $keys_and_values) {
        return self::replace($table, $keys_and_values);
    }

}
