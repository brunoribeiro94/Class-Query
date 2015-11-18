<?php

//namespace to organize

namespace Query_src;

/**
 * Class Query Where
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 1.2
 * @access public
 * @package Where
 * @subpackage Replace
 */
class Where extends Replace {

    /**
     * Function Query where between
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `columnA` <b> BETWEEN </b> `min` AND `max`
     * </code>
     * </pre>
     * @param Array $where_between Used to compare strings, the second element have another array indicating the minimum and maximum.
     * @access public
     * @return \Query_src\Where
     */
    public function where_between($where_between) {
        $this->where_between = $where_between;
        return $this;
    }

    /**
     * Function Query where between
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `value` <b> BETWEEN </b> `columnA` AND `columnB`
     * </code>
     * </pre>
     * @param Array $where_between Used to compare strings, the second element have another array indicating the minimum and maximum.
     * @access public
     * @return \Query_src\Where
     */
    public function where_between_columns($where_between) {
        $this->where_between_columns = $where_between;
        return $this;
    }

    /**
     * Function Query where equal
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `columnA` <b> = </b> `valueA`
     * </code>
     * </pre>
     * @param Array $where_equal Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_equal($where_equal) {
        // alias for where_equal_to()
        return self::where_equal_to($where_equal);
    }

    /**
     * Function Query where equal or
     * 
     * Note: This function is diferrent of where_equal_or()
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           <b>(</b>`columnA` <b> = </b> `valueA` AND
     *           `columnB` <b> = </b> `valueB` <b>)</b> <b>OR</b>
     *           <b>(</b>`columnC` <b> = </b> `valueC` AND
     *           `columnD` <b> = </b> `valueD` <b>)</b>
     * </code>
     * </pre>
     * @param array $equal Collection array data in column name and value
     * @param array $orEqual Collection array data in column name and value to compare or
     * @access public
     * @return \Query_src\Where_src\Where
     */
    public function where_equal_to_and_or(array $equal, array $orEqual) {
        $this->where_equal_to_and_or = array($equal, $orEqual);
        return $this;
    }

    /**
     * Function Query where equal or
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *        (
     *           `columnA` <b> = </b> `valueA` OR
     *           `columnB` <b> = </b> `valueB`
     *        )
     * </code>
     * </pre>
     * @param Array $where_equal_or Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_equal_or($where_equal_or) {
        $this->where_equal_or = $where_equal_or;
        return $this;
    }

    /**
     * Function Query where equal to
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> = </b> `value`
     * </code>
     * </pre>
     * @param Array $where_equal_to Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_equal_to($where_equal_to) {
        $this->where_equal_to = $where_equal_to;
        return $this;
    }

    /**
     * Function Query where greater than
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> > </b> `value`
     * </code>
     * </pre>
     * @param Array $where_greater_than Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_greater_than($where_greater_than) {
        $this->where_greater_than = $where_greater_than;
        return $this;
    }

    /**
     * Function Query where greater than or equal to
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> >= </b> `value`
     * </code>
     * </pre>
     * @param Array $where_greater_than_or_equal_to Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_greater_than_or_equal_to($where_greater_than_or_equal_to) {
        $this->where_greater_than_or_equal_to = $where_greater_than_or_equal_to;
        return $this;
    }

    /**
     * Function Query where in
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> IN</b>(value)
     * </code>
     * </pre>
     * @param Array $where_in Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_in($where_in) {
        $this->where_in = $where_in;
        return $this;
    }

    /**
     * Function Query where less than
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> < </b> `value`
     * </code>
     * </pre>
     * @param Array $where_less_than Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_less_than($where_less_than) {
        $this->where_less_than = $where_less_than;
        return $this;
    }

    /**
     * Function Query where less than or equal to
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> <= </b> `value`
     * </code>
     * </pre>
     * @param Array $where_less_than_or_equal_to Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_less_than_or_equal_to($where_less_than_or_equal_to) {
        $this->where_less_than_or_equal_to = $where_less_than_or_equal_to;
        return $this;
    }

    /**
     * Function Query where like
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> LIKE </b> `%value%`
     * </code>
     * </pre>
     * @param Array $where_like Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_like($where_like) {
        return self::where_like_both($where_like);
    }

    /**
     * Function Query where like after
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> LIKE </b> `value%`
     * </code>
     * </pre>
     * @param Array $where_like_after Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_like_after($where_like_after) {
        $this->where_like_after = $where_like_after;
        return $this;
    }

    /**
     * Function Query where like before
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> LIKE </b> `%value`
     * </code>
     * </pre>
     * @param Array $where_like_before Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_like_before($where_like_before) {
        $this->where_like_before = $where_like_before;
        return $this;
    }

    /**
     * Function Query where like both
     *
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `columnA` <b> LIKE </b> "%valueA%" AND
     *           `columnB` <b> LIKE </b> "%valueB%"
     * </code>
     * </pre>
     * @param Array $where_like_both Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_like_both($where_like_both) {
        $this->where_like_both = $where_like_both;
        return $this;
    }

    /**
     * Function Query where like binary
     *
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> LIKE BINARY </b> `value`
     * </code>
     * </pre>
     * @param Array $where_like_binary Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_like_binary($where_like_binary) {
        $this->where_like_binary = $where_like_binary;
        return $this;
    }

    /**
     * Function Query where like or
     *
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     * 
     *  (
     *           `column` <b> LIKE </b> `%value%` OR
     *           `id` <b> LIKE  </b> "%1%"
     *  )
     * </code>
     * </pre>
     * @param Array $where_like_or Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_like_or($where_like_or) {
        $this->where_like_or = $where_like_or;
        return $this;
    }

    /**
     * Function Query where <> Not equal to
     *
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     * 
     *  (
     *           `column` <b> <> </b> `%value%` OR
     *           `id` <b> <> </b> "%1%"
     *  )
     * </code>
     * </pre>
     * @param Array $where_not_equal_or Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_not_equal_or($where_not_equal_or) {
        $this->where_not_equal_or = $where_not_equal_or;
        return $this;
    }

    /**
     * Function Query where != Not equal to
     *
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     * 
     *  (
     *           `column` <b> != </b> `value`
     *  )
     * </code>
     * </pre>
     * @param Array $where_not_equal_to Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_not_equal_to($where_not_equal_to) {
        $this->where_not_equal_to = $where_not_equal_to;
        return $this;
    }

    /**
     * Function Query where not in
     * 
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b> NOT IN</b>(value)
     * </code>
     * </pre>
     * @param Array $where_in Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_not_in($where_not_in) {
        $this->where_not_in = $where_not_in;
        return $this;
    }

    /**
     * Function Query where not like
     *
     * Example Query output :
     * 
     * <pre>
     * <code>
     * SELECT 
     *          *
     * FROM
     *          `table`
     * WHERE
     *           `column` <b>NOT LIKE</b> `%value%` 
     * </code>
     * </pre>
     * @param Array $where_not_like Used to compare strings.
     * @access public
     * @return \Query_src\Where
     */
    public function where_not_like($where_not_like) {
        $this->where_not_like = $where_not_like;
        return $this;
    }

}
