<?php

// Use Config class query
use Query_src\Config as Config;

/**
 * Class query
 * This class works with mysqli onlys, anti-SQL injection techniques were added.
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 2.6.1
 * @access public
 * @package Config
 * @todo Finish the functions : SUM, DISTINCT, and commands of tools to database.
 * */
class Query extends Config {

    /**
     * 
     * Method Magic
     * 
     * @access public
     * @param string $database Database ID see : config.php
     * @return void
     * 
     */
    public function __construct($database = NULL) {
        parent::__construct($database); // conect database
        $this->debug = defined('DEBUG') && DEBUG === true;
        $this->having = '';
    }

    /**
     * alias for get_selected_count()
     * 
     * @access public
     * @return Integer
     */
    public function count() {
        return self::get_selected_count();
    }

    /**
     * Returns the number of records
     * 
     * @access public
     * @return Integer
     */
    public function get_selected_count() {
        return empty($this->results) ? 0 : $this->results;
    }

    /**
     * returns an array of the SELECT result(s)
     * 
     * @access public
     * @return Array
     */
    public function get_selected() {
        if (isset($this->limit) && 1 == $this->limit) {
            // for use when selecting with limit(1)
            $result = array();
            while ($this->result && $result[] = mysqli_fetch_assoc($this->result)) {
                
            }
            array_pop($result);
            $results = array();
            foreach ($result as $values) {
                $results = $values;
            }
        } else {
            // for use when selecting with no limit or a limit > 1
            $results = array();
            while ($this->result && $results[] = mysqli_fetch_assoc($this->result)) {
                
            }
            array_pop($results);
        }
        return $results;
    }

    /**
     * SELECT Retrieves fields from one or more tables.
     * 
     * @access public
     * @param String $select standard *
     * @return \Query
     */
    public function select($select = '*') {
        $this->select = $select;
        return $this;
    }

    /**
     * alias for select() instead of using both select() && from()
     * 
     * @access public
     * @param array $select Select Column is key and Value to add is value
     * @param String $table Table name
     * @return \Query
     */
    public function select_from($select, $table) {
        self::select($select);
        self::from($table);
        return $this;
    }

    /**
     * Execute custom SQL lines
     * 
     * @param string $sql FULL SQL
     * @return \Query
     */
    public function customSQL($sql) {
        $this->customSQL = $sql;
        return $this;
    }
    
    /* Query helpers */

    public function distinct($distinct) {
        $this->distinct = $distinct;
        return $this;
    }

    /**
     * Function Query
     * FROM target the specifed tables.
     * 
     * @access public
     * @param String $from Used to specify the table
     * @return \Query
     */
    public function from($from) {
        // FROM target the specifed tables.
        $this->from = $from;
        return $this;
    }

    /**
     * Function Query 
     * GROUP BY Determines how the records should be grouped.
     *     
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * <b>GROUP BY</b>
     *           `name`,
     *           `company`,
     *           `email`
     * </code>
     * </pre>
     * 
     * @access public
     * @param Array $group_by A string can be used if only one column
     * @return \Query 
     */
    public function group_by($group_by) {
        $this->group_by = $group_by;
        return $this;
    }

    /**
     * Function Query having
     * Used with GROUP BY to specify the criteria for the grouped records.
     * 
     * @access public
     * @param Array $having The data type can be string
     * @param String $comparison Used for comparison 
     * @param String $boolean_operator Used for operator
     * 
     * @return \Query
     */
    public function having($having = '', $comparison = '=', $boolean_operator = 'AND') {
        if (empty($having)) {
            $this->having = '';
        } else {
            if (!is_array($having)) {
                $this->having = 'HAVING' . "\n" . "\t" . $having . "\n" . '';
            } else {
                $array = array();
                foreach ($having as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $key => $value) {
                            $array[] = sprintf('%1$s %2$s "%3$s"',$key, $comparison, $this->_check_link_mysqli($value));
                        }
                    } else {
                        $array[] = sprintf('%1$s %2$s "%3$s"',$k, $comparison, $this->_check_link_mysqli($v));
                    }
                }

                $this->having = 'HAVING' . "\n" . "\t" . implode(' ' . $boolean_operator . "\n\t", $array) . "\n" . '';
            }
        }

        return $this;
    }

    /**
     * Function Query inner join
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          c.*
     * FROM
     *          `table` AS c
     * <b>INNER JOIN</b>
     *           countrylanguage ON countrylanguage.`CountryCode` = c.`Code`
     * </code>
     * </pre>
     * 
     * @access public
     * @param array|string $inner_join string can be used
     * @return \Query
     */
    public function inner_join($inner_join) {
        $this->inner_join = $inner_join;
        return $this;
    }

    /**
     * Function Query left join
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          c.*
     * FROM
     *          `table` AS c
     * <b>LEFT JOIN</b>
     *           countrylanguage ON countrylanguage.`CountryCode` = c.`Code`
     * </code>
     * </pre>
     * @param array|string $left_join string can be used
     * @access public
     * @return \Query
     */
    public function left_join($left_join) {
        $this->left_join = $left_join;
        return $this;
    }
    
    /**
     * Function Query limit
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * <b>LIMIT</b>
     *           1
     * </code>
     * </pre>
     * 
     * @access public
     * @param Integer $limit Used to limit the records per page
     * @return \Query
     */
    public function limit($limit = 1) {
        $this->limit = (int) $limit; // LIMIT Limit the number of records selected or deleted.
        return $this;
    }

    /**
     * Function Query offset
     * to use also requires using the limit
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * <b>LIMIT
     *           1</b>, 10
     * </code>
     * </pre>
     * 
     * @access public
     * @param integer $offset Used to get starting at offset, number of items to get
     * @return \Query
     */
    public function offset($offset) {
        $this->offset = (int) $offset;
        return $this;
    }

    /**
     * Function Query order by
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * <b>ORDER BY</b>
     *           `Value ASC`
     * </code>
     * </pre>
     * 
     * @access public
     * @param String $order_by Used 'value ASC' or DESC.
     * @return \Query
     */
    public function order_by($order_by) {
        $this->order_by = $order_by;
        return $this;
    }
    
    /**
     * Function to define page used in paginations of registry
     * 
     * @access public
     * @param integer $page
     * @return \Query
     */
    public function page($page) {
        $this->page = (int) $page;
        return $this;
    }

    /**
     * alias instead of using both limit() && offset()
     * 
     * @access public
     * @param Integer $limit Limit page
     * @param Integer $offset Limit to show
     * @return \Query
     */
    public function range($limit, $offset) {
        self::limit($limit);
        self::offset($offset);
        return $this;
    }

    /**
     *  Displaying SQL
     * 
     * @access public
     * @param boolean $echo Use false to return string or true to print
     * @version 0.2
     * @return \Query|String
     */
    public function show($echo = true) {
        if ($echo) {
            echo self::get(true);
            return $this;
        }
        return self::get(true);
    }

    /**
     * alias show() 
     * 
     * @access public
     * @param boolean $echo Use false to return string or true to print
     * @version 0.2
     * @return Object
     */
    public function display($echo = true) {
        return self::show($echo);
    }

}
