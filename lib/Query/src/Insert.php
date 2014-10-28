<?php

/**
 * Class Query Insert
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 0.4
 * @access public
 * @package Insert
 * @subpackage Delete
 */
class Insert extends Delete {

    /**
     * alias for get_inserted_id()
     * @param String $select Standard ''
     * @return Integer
     */
    public function get_insert_id($select = '') {
        return self::get_inserted_id($select);
    }

    /**
     * alias for get_inserted_id()
     * @param String $select Standard ''
     * @return Integer
     */
    public function get_inserted($select = '') {
        return self::get_inserted_id($select);
    }

    /**
     * Return last id inserted
     * @param mixed $select Standard ''
     * @return Integer
     */
    public function get_inserted_id($select = '') {
        for ($i = 0; $i < count($this->Connections_Settings); $i++) {
            $link = $this->link_mysqi[$i];
            if (mysqli_insert_id($link)) {
                $result = mysqli_insert_id($link);
            }
        }

        $this->inserted = $result;

        if ('' == $select && 'insert_multiple' != $this->query_type) {
            return $this->inserted;
        } else {
            switch ($this->query_type) {
                case 'insert_multiple':
                    $where_equal_to = array('`id` >= ' . $this->inserted);
                    break;
                default:
                    $where_equal_to = array('`id`' => $this->inserted);
                    $limit = isset($limit) ? $limit : 1;
                    self::limit($limit);
                    break;
            }
            // use select
            self::select($select);
            self::from($this->table);
            self::where_equal_to($where_equal_to);
            self::_get_select_query();
            return self::_run_select();
        }
    }

    /**
     * insert_into() alias
     * @param String $table Table name
     * @param mixed $keys_and_values Column(s) and value(s) to add
     * @param String $on_duplicate_key_update Standard ''
     * @param String $insert_options Standard ''
     * @return \Insert
     */
    public function insert($table, $keys_and_values, $on_duplicate_key_update = '', $insert_options = '') {
        return self::insert_into($table, $keys_and_values, $on_duplicate_key_update, $insert_options);
    }

    /**
     * Ignore on insert
     * @param String $table Table name
     * @param mixed $keys_and_values Column(s) and value(s) to add
     * @param String $on_duplicate_key_update Standard ''
     * @return \Insert
     */
    public function insert_ignore($table, $keys_and_values, $on_duplicate_key_update = '') {
        return self::insert_into($table, $keys_and_values, $on_duplicate_key_update, 'IGNORE');
    }

    /**
     * Insert new registry
     * @param String $table Table name
     * @param mixed $keys_and_values Column(s) and value(s) to add
     * @param String $on_duplicate_key_update Standard ''
     * @param String $insert_options Standard ''
     * @return \Insert
     */
    public function insert_into($table, $keys_and_values, $on_duplicate_key_update = '', $insert_options = '') {
        self::_set_table($table);
        self::_set_keys_and_values($keys_and_values);
        $insert_keys = array();
        $insert_values = array();
        foreach ($keys_and_values as $key => $value) {
            $insert_keys[] = $key;
            if (is_null($value)) {
                $insert_values[] = 'NULL';
            } elseif (is_int($key)) {
                $insert_values[] = $value;
            } elseif (is_array($value)) {
                foreach ($value as $k => $v) {
                    $insert_values[] = sprintf('%s', $this->_check_link_mysqli($v));
                }
            } else {
                $insert_values[] = sprintf('"%s"', $this->_check_link_mysqli($value));
            }
        }
        self::_set_keys($insert_keys);
        self::_set_values($insert_values);
        self::_on_duplicate_key_update($on_duplicate_key_update);
        $this->insert_into = "\n" .
                'INSERT ' . (empty($insert_options) ? '' : $insert_options . ' ') . 'INTO ' . $table . ' (' . "\n" .
                "\t" . implode(',' . "\n\t", $insert_keys) . "\n" .
                ')' . "\n" .
                'VALUES (' . "\n" .
                "\t" . implode(',' . "\n\t", $insert_values) . "\n" .
                ')' . "\n" .
                $this->on_duplicate_key_update .
                '';
        return $this;
    }

    /* INSERTS */

    /**
     * alias insert_multiple()
     * @param String $table Table name
     * @param String $keys Column name
     * @param mixed $values Values to add
     * @return \Insert
     */
    public function inserts($table, $keys, $values) {
        return self::insert_multiple($table, $keys, $values);
    }

    /**
     * Inserts a new record in the database
     * @param String $table Table name
     * @param String $keys Column names
     * @param mixed $values Values to add
     * @param String $on_duplicate_key_update Standard ''
     * @return \Insert
     */
    public function insert_multiple($table, $keys, $values, $on_duplicate_key_update = '') {
        self::_set_table($table);
        $insert_keys = $keys;
        $insert_values = array();
        foreach ($values as $v) {
            $vs = array();
            if (is_array($v)) {
                foreach ($v as $value) {
                    $vs[] = (!is_null($value) ? sprintf('"%s"', $this->_check_link_mysqli($value)) : 'NULL');
                }
                $insert_values[] = '(' . implode(',', $vs) . ')';
            } else {
                $insert_values[] = '(' . $this->_check_link_mysqli($v) . ')';
            }
        }
        self::_set_keys($insert_keys);
        self::_set_values($insert_values);
        self::_on_duplicate_key_update($on_duplicate_key_update);
        $this->insert_into = "\n" .
                'INSERT INTO ' . $table . '(' . "\n" .
                "\t" . implode(',' . "\n\t", $insert_keys) . "\n" .
                ')' . "\n" .
                'VALUES' . "\n" .
                "\t" . implode(',' . "\n\t", $insert_values) . "\n" .
                $this->on_duplicate_key_update .
                '';
        return $this;
    }
    
    private function _on_duplicate_key_update($on_duplicate_key_update) {
        $this->on_duplicate_key_update = '';
        if ('' !== $on_duplicate_key_update && is_array($on_duplicate_key_update)) {
            $update = array();
            foreach ($on_duplicate_key_update as $k => $v) {
                if (is_null($v)) {
                    $update[] = $k . ' = NULL';
                } elseif (is_int($k)) {
                    $update[] = $v;
                } elseif (is_array($v)) {
                    foreach ($v as $key => $value) {
                        if (is_null($value)) {
                            $update[] = $k . ' = NULL';
                        } elseif (is_int($k)) {
                            $update[] = $value;
                        } else {
                            $update[] = sprintf($k . ' = "%s"', $this->_check_link_mysqli($value));
                        }
                    }
                } else {
                    $update[] = sprintf($k . ' = "%s"', $this->_check_link_mysqli($v));
                }
            }
            $this->on_duplicate_key_update = 'ON DUPLICATE KEY UPDATE ' . "\n" .
                    "\t" . implode(',' . "\n\t", $update) . "\n";
        }
    }

    /* Get helpers */

    private function _set_keys($keys) {
        $this->keys = $keys;
    }

    private function _set_table($table) {
        $this->table = $table;
    }

    private function _set_keys_and_values($keys_and_values) {
        $this->keys_and_values = $keys_and_values;
    }

    private function _set_values($values) {
        $this->values = $values;
    }

}
