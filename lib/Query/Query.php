<?php

$autoloadManager = new autoloadManager(null, autoloadManager::SCAN_ONCE);
$autoloadManager->addFolder(__DIR__ . '/src/');
$autoloadManager->register();

/**
 *
 * Class query
 * This class works with mysqli onlys, anti-SQL injection techniques were added.
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 2.1
 * @access public
 * @package Config
 * @todo Finish the functions : SUM, DISTINCT.
 * */
class Query extends Config {

    public function __construct() {
        // conect database
        parent::__construct();
        // set charset
        $this->link_mysqi->set_charset($this->charset);
        $this->debug = defined('DEBUG') && DEBUG === true;
        $this->having = '';
    }

    /**
     * Returns the number of records
     * @return Integer
     */
    public function count() {
        // alias for get_selected_count()
        return self::get_selected_count();
    }

    /**
     * Returns the number of records
     * @return Integer
     */
    public function get_selected_count() {
        return $this->results;
    }

    /**
     * returns an array of the SELECT result(s)
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
     * @param String $select
     * @return \Query
     */
    public function select($select = '*') {
        $this->select = $select;
        return $this;
    }

    /**
     * alias for select() instead of using both select() && from()
     * @param String $select
     * @param String $table
     * @return \Query
     */
    public function select_from($select, $table) {
        self::select($select);
        self::from($table);
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
     * @param Array $having The data type can be string
     * @param String $comparison Used for comparison 
     * @param String $boolean_operator Used for operator
     * @access public
     * @return \Query
     */
    public function having($having = '', $comparison = '=', $boolean_operator = 'AND') {
        $mysqli = $this->link_mysqi;

        if (empty($having)) {
            $this->having = '';
        } else {
            if (!is_array($having)) {
                $this->having = 'HAVING' . "\n" .
                        "\t" . $having . "\n" .
                        '';
            } else {
                $array = array();
                foreach ($having as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $key => $value) {
                            $array[] = sprintf($k . ' NOT LIKE "%%%s%%"', mysqli_real_escape_string($mysqli, $value));
                        }
                    } else {
                        $array[] = sprintf($k . ' NOT LIKE "%%%s%%"', mysqli_real_escape_string($mysqli, $v));
                    }
                }

                $this->having = 'HAVING' . "\n" .
                        "\t" . implode(' ' . $boolean_operator . "\n\t", $array) . "\n" .
                        '';
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
     * @param Array $inner_join string can be used
     * @access public
     * @return \Query
     */
    public function inner_join($inner_join) {
        $this->inner_join = $inner_join;
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
     * @param Integer $limit Used to limit the records per page
     * @access public
     * @return \Query
     */
    public function limit($limit) {
        // LIMIT Limit the number of records selected or deleted.
        $this->limit = (int) $limit;
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
     * @param Integer $offset Used to get starting at offset, number of items to get
     * @access public
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
     * @param String $order_by Used 'value ASC' or DESC.
     * @access public
     * @return \Query
     */
    public function order_by($order_by) {
        $this->order_by = $order_by;
        return $this;
    }

    public function page($page) {
        $this->page = (int) $page;
        return $this;
    }

    /**
     * alias instead of using both limit() && offset()
     * @param Integer $limit
     * @param Integer $offset
     * @return \Query
     */
    public function range($limit, $offset) {
        self::limit($limit);
        self::offset($offset);
        return $this;
    }

    private function _key_value($key, $value, $operator = '=') {
        $mysqli = $this->link_mysqi;
        $value = (substr($value, 0, 1) == '!' ? substr($value, 1) : '"' . $value . '"');
        return sprintf($key . $operator . ' %s ', mysqli_real_escape_string($mysqli, $value));
    }

    /**
     * * Displaying SQL
     * * @access public
     * * @return String
     */
    public function show() {
        echo "<pre>" . self::get(true) . "</pre>";
        return $this;
    }

    /**
     * alias show() 
     * @return String
     */
    public function display() {
        return self::show();
    }

}
