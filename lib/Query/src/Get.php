<?php

class Get extends Insert {

    /**
     * returns select, insert or update query
     * @param boolean $use_limit
     * @return boolean
     */
    public function get($use_limit = false) {
        if (self::_get_delete_query()) {
            return $this->delete_query;
        } elseif (self::_get_insert_query()) {
            return $this->insert_query;
        } elseif (self::_get_select_query($use_limit)) {
            return $this->select_query;
        } elseif (self::_get_replace_query()) {
            return $this->replace_query;
        } elseif (self::_get_update_query()) {
            return $this->update_query;
        } elseif (self::_get_insert_multiple()) {
            return $this->insert_multiple_query;
        } 
            return false;
    }

    private function _get_distinct() {
        // FINISH
    }

    private function _get_delete_from() {
        return
                'DELETE FROM' . "\n" .
                "\t" . $this->delete_from . "\n" .
                '';
    }

    protected function _get_delete_query() {
        if (isset($this->delete_from)) {
            $this->query_type = 'delete';
            $this->delete_query = "\n" .
                    self::_get_delete_from() .
                    self::_get_where() .
                    self::_get_order_by() .
                    self::_get_limit() .
                    '';
            return true;
        }
        return false;
    }

    private function _get_from() {
        if (isset($this->from)) {
            return
                    'FROM' . "\n" .
                    "\t" . $this->from . "\n" .
                    '';
        } else {
            return '';
        }
    }

    /**
     * GROUP BY Determines how the records should be grouped.
     * @return string
     */
    private function _get_group_by() {
        if (isset($this->group_by)) {
            if (is_array($this->group_by)) {
                $this->group_by = implode(',' . "\n\t", $this->group_by);
            }
            return
                    'GROUP BY' . "\n" .
                    "\t" . $this->group_by . "\n" .
                    '';
        }
    }

    /**
     * INNER JOIN to records.
     * 
     * @return string
     * @version 2.0
     */
    private function _get_inner_join() {
        if (!isset($this->inner_join) || empty($this->inner_join)) {
            return '';
        } else {
            if (is_array($this->inner_join)) {
                $this->inner_join = implode("\n" . 'INNER JOIN' . "\n\t", $this->inner_join);
            }
            return
                    'INNER JOIN' . "\n" .
                    "\t" . $this->inner_join . "\n" .
                    '';
        }
    }

    private function _get_insert_query() {
        if (isset($this->insert_into)) {
            $this->query_type = 'insert_into';
            $this->insert_query = $this->insert_into;
            return true;
        } elseif (isset($this->insert_ignore_into)) {
            $this->query_type = 'insert_ignore_into';
            $this->insert_query = $this->insert_ignore_into;
            return true;
        }
        return false;
    }

    private function _get_insert_multiple() {
        if (isset($this->insert_multiple)) {
            $this->query_type = 'insert_multiple';
            $this->insert_multiple_query = $this->insert_multiple;
            return true;
        }
        return false;
    }

    private function _get_join() {
        return self::_get_inner_join();
    }

    private function _get_limit() {
        if (!isset($this->limit)) {
            return '';
        } else {
            if (isset($this->offset)) {
                return
                        'LIMIT' . "\n" .
                        "\t" . $this->offset . ', ' . $this->limit . "\n" .
                        '';
            }
            return
                    'LIMIT' . "\n" .
                    "\t" . $this->limit . "\n" .
                    '';
        }
    }

    /**
     * ORDER BY to order the records.
     * @return string
     */
    private function _get_order_by() {
        if (!isset($this->order_by) || empty($this->order_by)) {
            return '';
        } else {
            if (is_array($this->order_by)) {
                $this->order_by = implode(',' . "\n\t", $this->order_by);
            }
            return
                    'ORDER BY' . "\n" .
                    "\t" . $this->order_by . "\n" .
                    '';
        }
    }

    protected function _get_results() {
        $this->results = mysqli_num_rows($this->result);
    }

    private function _get_replace_query() {
        if (isset($this->replace_into)) {
            $this->query_type = 'replace_into';
            $this->replace_query = $this->replace_into;
            return true;
        }
        return false;
    }

    private function _get_select() {
        if (is_array($this->select)) {
            $selects = array();
            foreach ($this->select as $k => $v) {
                if (false !== strpos($k, '%s')) {
                    $selects[] = sprintf($k, $this->_check_link_mysqli($v));
                } else {
                    $selects[] = $v;
                }
            }
            return
                    'SELECT' . "\n" .
                    "\t" . implode(',' . "\n\t", $selects) . "\n" .
                    '';
        } elseif (empty($this->select)) {
            return
                    'SELECT' . "\n" .
                    "\t" . '*' . "\n" .
                    '';
        } else {
            return
                    'SELECT' . "\n" .
                    "\t" . $this->select . "\n" .
                    '';
        }
    }

    protected function _get_select_query($use_limit = null) {
        if (isset($this->select)) {
            $this->query_type = 'select';
            $this->select_query = "\n" .
                    self::_get_select() .
                    self::_get_from() .
                    self::_get_join() .
                    self::_get_where() .
                    self::_get_group_by() .
                    $this->having .
                    self::_get_order_by() .
                    ($use_limit || (!isset($this->page) && !isset($this->offset)) ? self::_get_limit() : '') .
                    '';
            return true;
        }
        return false;
    }

    private function _get_set() {
        $sets = array();
        $set_equals = array();
        foreach ($this->set as $k => $v) {
            if (is_null($v)) {
                $set_equals[] = $k . ' = NULL';
            } elseif (is_int($k)) {
                $set_equals[] = $v;
            } elseif (is_int($v)) {
                $set_equals[] = sprintf($k . ' = %s', $this->_check_link_mysqli($v));
            } else {
                $set_equals[] = sprintf($k . ' = "%s"', $this->_check_link_mysqli($v));
            }
        }

        $sets[] = implode(', ' . "\n\t", $set_equals);

        return
                'SET' . "\n" .
                "\t" . implode(',' . "\n\t", $sets) . "\n" .
                '';
    }

    private function _get_update() {
        return
                'UPDATE' . "\n" .
                "\t" . $this->update . "\n" .
                '';
    }

    private function _get_update_query() {
        if (isset($this->update)) {
            $this->query_type = 'update';
            $this->update_query = "\n" .
                    self::_get_update() .
                    self::_get_set() .
                    self::_get_where() .
                    self::_get_limit() .
                    '';
            return true;
        }
        return false;
    }

    /**
     * load all where's options
     * @return string
     */
    private function _get_where() {
        $wheres = array();
        $where_greater_than = self::_get_where_greater_than();
        $where_greater_than_or_equal_to = self::_get_where_greater_than_or_equal_to();
        $where_in = self::_get_where_in();
        $where_less_than = self::_get_where_less_than();
        $where_less_than_or_equal_to = self::_get_where_less_than_or_equal_to();
        $where_equal_or = self::_get_where_equal_or();
        $where_equal_to = self::_get_where_equal_to();
        $where_not_in = self::_get_where_not_in();
        $where_not_equal_or = self::_get_where_not_equal_or();
        $where_not_equal_to = self::_get_where_not_equal_to();
        $where_like_after = self::_get_where_like_after();
        $where_like_before = self::_get_where_like_before();
        $where_like_both = self::_get_where_like_both();
        $where_like_or = self::_get_where_like_or();
        $where_not_like = self::_get_where_not_like();
        $where_like_binary = self::_get_where_like_binary();
        $where_between = self::_get_where_between();
        if (!empty($where_greater_than)) {
            $wheres[] = $where_greater_than;
        }
        if (!empty($where_between)) {
            $wheres[] = $where_between;
        }
        if (!empty($where_in)) {
            $wheres[] = $where_in;
        }
        if (!empty($where_greater_than_or_equal_to)) {
            $wheres[] = $where_greater_than_or_equal_to;
        }
        if (!empty($where_less_than)) {
            $wheres[] = $where_less_than;
        }
        if (!empty($where_less_than_or_equal_to)) {
            $wheres[] = $where_less_than_or_equal_to;
        }
        if (!empty($where_equal_or)) {
            $wheres[] = $where_equal_or;
        }
        if (!empty($where_equal_to)) {
            $wheres[] = $where_equal_to;
        }
        if (!empty($where_not_equal_or)) {
            $wheres[] = $where_not_equal_or;
        }
        if (!empty($where_not_in)) {
            $wheres[] = $where_not_in;
        }
        if (!empty($where_not_equal_to)) {
            $wheres[] = $where_not_equal_to;
        }
        if (!empty($where_like_after)) {
            $wheres[] = $where_like_after;
        }
        if (!empty($where_like_before)) {
            $wheres[] = $where_like_before;
        }
        if (!empty($where_like_both)) {
            $wheres[] = $where_like_both;
        }
        if (!empty($where_like_or)) {
            $wheres[] = $where_like_or;
        }
        if (!empty($where_not_like)) {
            $wheres[] = $where_not_like;
        }
        if (!empty($where_like_binary)) {
            $wheres[] = $where_like_binary;
        }
        if (empty($wheres)) {
            return '';
        } else {
            return
                    'WHERE' . "\n" .
                    "\t" . implode('AND' . "\n\t", $wheres) . "\n" .
                    '';
        }
    }

    /**
     * between min AND max
     * @return string
     */
    private function _get_where_between() {
        if (!isset($this->where_between) || !is_array($this->where_between) || empty($this->where_between)) {
            return '';
        } else {
            $where_between = array();
            foreach ($this->where_between as $k => $v) {
                $min = $this->_check_link_mysqli($v[0]);
                $max = $this->_check_link_mysqli($v[1]);
                if (is_array($v)) {
                    $where_between[] = $k . ' BETWEEN ' . $min . ' AND ' . $max;
                } else {
                    $where_between[] = $k . ' BETWEEN ' . $v;
                }
            }
            return implode(' AND' . "\n\t", $where_between) . ' ';
        }
    }

    private function _get_where_equal_or() {
        if (!isset($this->where_equal_or) || !is_array($this->where_equal_or) || empty($this->where_equal_or)) {
            return '';
        } else {
            $where_equal_or = array();
            foreach ($this->where_equal_or as $k => $v) {
                if (is_null($v)) {
                    $where_equal_or[] = $k . ' IS NULL';
                } elseif (is_int($k)) {
                    $where_equal_or[] = $v;
                } elseif (is_array($v)) {
                    foreach ($v as $key => $value) {
                        if (is_null($value)) {
                            $where_equal_or[] = $k . ' IS NULL';
                        } elseif (is_int($k)) {
                            $where_equal_or[] = $value;
                        } else {
                            $where_equal_or[] = sprintf($k . ' = "%s"', $this->_check_link_mysqli($value));
                        }
                    }
                } else {
                    $where_equal_or[] = sprintf($k . ' = "%s"', $this->_check_link_mysqli($v));
                }
            }
            return
                    '(' . "\n" .
                    "\t\t" . implode(' OR' . "\n\t\t", $where_equal_or) . "\n" .
                    "\t" .
                    ') ';
        }
    }

    /**
     * = Equal to
     * @return string
     */
    private function _get_where_equal_to() {
        if (!isset($this->where_equal_to) || !is_array($this->where_equal_to) || empty($this->where_equal_to)) {
            return '';
        } else {
            $where_equal_to = array();
            foreach ($this->where_equal_to as $k => $v) {
                if (is_null($v)) {
                    $where_equal_to[] = $k . ' IS NULL';
                } elseif (is_int($k)) {
                    $where_equal_to[] = $v;
                } elseif (is_int($v)) {
                    $where_equal_to[] = sprintf($k . ' = %s', $this->_check_link_mysqli($v));
                } elseif (is_array($v)) {
                    foreach ($v as $key => $value) {
                        $where_equal_to[] = sprintf($k . ' = "%s"', $this->_check_link_mysqli($value));
                    }
                } else {
                    $where_equal_to[] = sprintf($k . ' = "%s"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_equal_to) . ' ';
        }
    }

    /**
     * > greater than
     * @return string
     */
    private function _get_where_greater_than() {
        if (!isset($this->where_greater_than) || !is_array($this->where_greater_than) || empty($this->where_greater_than)) {
            return '';
        } else {
            $where_greater_than = array();
            foreach ($this->where_greater_than as $k => $v) {
                if (is_null($v)) {
                    $where_greater_than[] = $k . ' IS NULL';
                } elseif (is_int($k)) {
                    $where_greater_than[] = $v;
                } elseif (is_int($v)) {
                    $where_greater_than[] = sprintf($k . ' > %s', $this->_check_link_mysqli($v));
                } else {
                    $where_greater_than[] = sprintf($k . ' > "%s"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_greater_than) . ' ';
        }
    }

    /**
     * Select Query >= greater than or equal to
     * @return string
     */
    private function _get_where_greater_than_or_equal_to() {
        if (!isset($this->where_greater_than_or_equal_to) || !is_array($this->where_greater_than_or_equal_to) || empty($this->where_greater_than_or_equal_to)) {
            return '';
        } else {
            $where_greater_than_or_equal_to = array();
            foreach ($this->where_greater_than_or_equal_to as $k => $v) {
                if (is_null($v)) {
                    $where_greater_than_or_equal_to[] = $k . ' IS NULL';
                } elseif (is_int($k)) {
                    $where_greater_than_or_equal_to[] = $v;
                } elseif (is_int($v)) {
                    $where_greater_than_or_equal_to[] = sprintf($k . ' >= %s', $this->_check_link_mysqli($v));
                } else {
                    $where_greater_than_or_equal_to[] = sprintf($k . ' >= "%s"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_greater_than_or_equal_to) . ' ';
        }
    }

    /**
     * IN Checks for values in a list
     * @return string
     */
    private function _get_where_in() {
        if (!isset($this->where_in) || !is_array($this->where_in) || empty($this->where_in)) {
            return '';
        } else {
            $where_in = array();

            foreach ($this->where_in as $k => $v) {
                if (is_null($v)) {
                    $where_in[] = $k . ' IS NULL';
                } elseif (is_int($k)) {
                    $where_in[] = $v;
                } elseif (is_int($v)) {
                    $where_in[] = sprintf($k . ' IN(%s)', $this->_check_link_mysqli($v));
                } elseif (is_array($v)) {

                    $values = array();

                    foreach ($v as $value) {
                        $values[] = '"' . $this->_check_link_mysqli($value) . '"';
                    }
                    $where_in[] = sprintf($k . ' IN(%s)', implode(', ', $values));
                } else {
                    $where_in[] = sprintf($k . ' IN(%s)', $this->_check_link_mysqli($v));
                }
            }

            return implode(' AND' . "\n\t", $where_in) . ' ';
        }
    }

    /**
     * < Less than
     * @return string
     */
    private function _get_where_less_than() {
        if (!isset($this->where_less_than) || !is_array($this->where_less_than) || empty($this->where_less_than)) {
            return '';
        } else {
            $where_less_than = array();
            foreach ($this->where_less_than as $k => $v) {
                if (is_null($v)) {
                    $where_less_than[] = $k . ' IS NULL';
                } elseif (is_int($k)) {
                    $where_less_than[] = $v;
                } elseif (is_int($v)) {
                    $where_less_than[] = sprintf($k . ' < %s', $this->_check_link_mysqli($v));
                } else {
                    $where_less_than[] = sprintf($k . ' < "%s"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_less_than) . ' ';
        }
    }

    /**
     * <= Less than or equal to
     * @return string
     */
    private function _get_where_less_than_or_equal_to() {
        if (!isset($this->where_less_than_or_equal_to) || !is_array($this->where_less_than_or_equal_to) || empty($this->where_less_than_or_equal_to)) {
            return '';
        } else {
            $where_less_than_or_equal_to = array();
            foreach ($this->where_less_than_or_equal_to as $k => $v) {
                if (is_null($v)) {
                    $where_less_than_or_equal_to[] = $k . ' IS NULL';
                } elseif (is_int($k)) {
                    $where_less_than_or_equal_to[] = $v;
                } elseif (is_int($v)) {
                    $where_less_than_or_equal_to[] = sprintf($k . ' <= %s', $this->_check_link_mysqli($v));
                } else {
                    $where_less_than_or_equal_to[] = sprintf($k . ' <= "%s"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_less_than_or_equal_to) . ' ';
        }
    }

    private function _get_where_like_after() {
        if (!isset($this->where_like_after) || !is_array($this->where_like_after) || empty($this->where_like_after)) {
            return '';
        } else {
            $where_like_after = array();
            foreach ($this->where_like_after as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $key => $value) {
                        $where_like_after[] = sprintf($k . ' LIKE "%s%%"', $this->_check_link_mysqli($value));
                    }
                } else {
                    $where_like_after[] = sprintf($k . ' LIKE "%s%%"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_like_after) . ' ';
        }
    }

    private function _get_where_like_before() {
        if (!isset($this->where_like_before) || !is_array($this->where_like_before) || empty($this->where_like_before)) {
            return '';
        } else {
            $where_like_before = array();
            foreach ($this->where_like_before as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $key => $value) {
                        $where_like_before[] = sprintf($k . ' LIKE "%%%s"', $this->_check_link_mysqli($value));
                    }
                } else {
                    $where_like_before[] = sprintf($k . ' LIKE "%%%s"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_like_before) . ' ';
        }
    }

    private function _get_where_like_both() {
        if (!isset($this->where_like_both) || !is_array($this->where_like_both) || empty($this->where_like_both)) {
            return '';
        } else {
            $where_like_both = array();
            foreach ($this->where_like_both as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $key => $value) {
                        $where_like_both[] = sprintf($k . ' LIKE "%%%s%%"', $this->_check_link_mysqli($value));
                    }
                } else {
                    $where_like_both[] = sprintf($k . ' LIKE "%%%s%%"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_like_both) . ' ';
        }
    }

    private function _get_where_like_binary() {
        if (!isset($this->where_like_binary) || !is_array($this->where_like_binary) || empty($this->where_like_binary)) {
            return '';
        } else {
            $where_like_binary = array();
            foreach ($this->where_like_binary as $k => $v) {
                if (!is_null($v)) {
                    $where_like_binary[] = sprintf($k . ' LIKE BINARY "%s"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_like_binary) . ' ';
        }
    }

    private function _get_where_like_or() {
        if (!isset($this->where_like_or) || !is_array($this->where_like_or) || empty($this->where_like_or)) {
            return '';
        } else {
            $where_like_or = array();
            foreach ($this->where_like_or as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $key => $value) {
                        $where_like_or[] = sprintf($k . ' LIKE "%%%s%%"', $this->_check_link_mysqli($value));
                    }
                } else {
                    $where_like_or[] = sprintf($k . ' LIKE "%%%s%%"', $this->_check_link_mysqli($v));
                }
            }
            return
                    '(' . "\n" .
                    "\t\t" . implode(' OR' . "\n\t\t", $where_like_or) . "\n" .
                    "\t" .
                    ') ';
        }
    }

    /**
     * <> Not equal to | != Not equal to
     * @return string
     */
    private function _get_where_not_equal_or() {
        if (!isset($this->where_not_equal_or) || !is_array($this->where_not_equal_or) || empty($this->where_not_equal_or)) {
            return '';
        } else {
            $where_not_equal_or = array();
            foreach ($this->where_not_equal_or as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $key => $value) {
                        $where_not_equal_or[] = sprintf($k . ' <> "%%%s%%"', $this->_check_link_mysqli($value));
                    }
                } else {
                    $where_not_equal_or[] = sprintf($k . ' <> "%%%s%%"', $this->_check_link_mysqli($v));
                }
            }
            return
                    '(' . "\n" .
                    "\t\t" . implode(' OR' . "\n\t\t", $where_not_equal_or) . "\n" .
                    "\t" .
                    ') ';
        }
    }

    /**
     * <> Not equal to | != Not equal to
     * @return string
     */
    private function _get_where_not_equal_to() {
        if (!isset($this->where_not_equal_to) || !is_array($this->where_not_equal_to) || empty($this->where_not_equal_to)) {
            return '';
        } else {
            $where_not_equal_to = array();
            foreach ($this->where_not_equal_to as $k => $v) {
                // check type the data received
                if (is_array($v)) {
                    foreach ($v as $key => $value) {
                        $where_not_equal_to[] = is_null($value) ? $key . ' IS NOT NULL' : sprintf($k . ' != "%s"', $this->_check_link_mysqli($value));
                    }
                } else {
                    $where_not_equal_to[] = is_null($v) ? $k . ' IS NOT NULL' : sprintf($k . ' != "%s"', $this->_check_link_mysqli($v));
                }
            }
            return
                    '(' . "\n" .
                    "\t\t" . implode(' AND' . "\n\t\t", $where_not_equal_to) . "\n" .
                    "\t" .
                    ') ';
        }
    }

    /**
     * NOT IN Ensures the value is not in the list
     * @return string
     */
    private function _get_where_not_in() {
        if (!isset($this->where_not_in) || !is_array($this->where_not_in) || empty($this->where_not_in)) {
            return '';
        } else {
            $where_not_in = array();

            foreach ($this->where_not_in as $key => $values) {
                if (is_array($values)) {
                    $vs = array();

                    foreach ($values as $k => $v) {
                        if (is_null($v)) {
                            $vs[] = 'NULL';
                        } elseif (is_int($v)) {
                            $vs[] = $v;
                        } else {
                            $vs[] = sprintf('"%s"', $this->_check_link_mysqli($v));
                        }
                    }

                    $where_not_in[] = $key . ' NOT IN (' . "\n\t\t" .
                            implode(', ' . "\n\t\t", $vs) . "\n\t" .
                            ')';
                } else {
                    $where_not_in[] = $key . ' NOT IN (' . "\n\t\t" .
                            $values . "\n\t" .
                            ')';
                }
            }

            return implode(' AND' . "\n\t", $where_not_in) . ' ';
        }
    }

    /**
     * NOT LIKE Used to compare strings
     * @return string
     */
    private function _get_where_not_like() {
        if (!isset($this->where_not_like) || !is_array($this->where_not_like) || empty($this->where_not_like)) {
            return '';
        } else {
            $where_not_like = array();
            foreach ($this->where_not_like as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $key => $value) {
                        $where_not_like[] = sprintf($k . ' NOT LIKE "%%%s%%"', $this->_check_link_mysqli($value));
                    }
                } else {
                    $where_not_like[] = sprintf($k . ' NOT LIKE "%%%s%%"', $this->_check_link_mysqli($v));
                }
            }
            return implode(' AND' . "\n\t", $where_not_like) . ' ';
        }
    }

    /**
     * Function Query get affected
     * @return Integer Returns number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE 
     */
    public function get_affected() {
        return mysqli_affected_rows($this->link_mysqi);
    }

}
