<?php

//namespace to organize

namespace Query_src;

/**
 * Class Query Running Query Application
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 1.4
 * @access public
 * @package Run
 * @subpackage Pagination
 */
class Run extends Get {

    /**
     * Execute Query
     * runs query, returns mysql result
     * @return \Query
     */
    public function run() {
        if (self::get()) {
            $function = '_run_' . $this->query_type;
            switch ($this->query_type) {
                case 'delete':
                case 'insert_ignore_into':
                case 'insert_into':
                case 'insert_multiple':
                case 'replace_into':
                case 'update':
                    return self::$function();
                    break;
                case 'select':
                    if (!(isset($this->page) || isset($this->offset))) {
                        // no pagination
                        return self::$function();
                    } else {
                        // with pagination
                        if (self::$function()) {
                            // for pagination:
                            $this->perpage = $this->limit; // for get_perpage()
                            $this->total = $this->results; // for get_total()
                            // calculate pages
                            $this->pages = (int) ceil($this->results / $this->limit);
                            // set offset
                            if (!isset($this->offset)) {
                                $this->offset(($this->page * $this->limit) - $this->limit);
                            } else {
                                // calculate page using offset and perpage
                                // determine on what page the offset would be on
                                for ($page = 1; $page <= $this->pages; $page++) {
                                    if ($this->offset - 1 < $page * $this->perpage) {
                                        $this->page = $page;
                                        break;
                                    }
                                }
                            }
                            // update select query with limit now that pages is set
                            self::_get_select_query(true);
                            // run select query with updated limit and offset
                            return self::_run_select();
                        }
                    }
                    break;
                default:
                    die(self::$TEXT_ERRO_QUERY . $this->query_type);
                    break;
            }
        }
        return false;
    }

    private function _run_delete() {
        return self::_run_query($this->delete_query);
    }

    private function _run_insert_ignore_into() {
        return self::_run_query($this->insert_query);
    }

    private function _run_insert_into() {
        return self::_run_query($this->insert_query);
    }

    private function _run_insert_multiple() {
        return self::_run_query($this->insert_multiple_query);
    }

    private function _run_replace_into() {
        return self::_run_query($this->replace_into);
    }

    private function _run_select() {
        return self::_run_query($this->select_query);
    }

    private function _run_update() {
        return self::_run_query($this->update_query);
    }

    /**
     * checks what action was called
     * @param Unknow $param query type
     * @return Object
     */
    private function _run_query_query_type($param) {
        switch ($param) {
            case 'delete':
                return self::get_affected();
            case 'insert_into':
                return self::get_inserted_id();
            case 'insert_multiple':
                return true;
            case 'replace_into':
                return self::get_affected();
            case 'select':
                self::_get_results();
                if ($this->result && $this->results > 0) {
                    return $this->result;
                }
                return false;
            case 'update':
                return self::get_affected();
        }
    }

    /**
     * Run Query
     * @param type $query
     * @version 1.4
     * @return Object
     */
    private function _run_query($query) {
        $mysqli = $this->link_mysqi[0];
        $this->result = mysqli_query($mysqli, $query);
        if (!$this->result) {
            $this->mysql_error = mysqli_error($mysqli);
            $this->error = self::$TEXT_ERRO_TYPE_QUERY . $this->mysql_error;
            $this->error.= "<br>" . self::$TEXT_OUTPUT_QUERY . "<hr>" . $this->show(false);

            if (function_exists('error')) {
                error($this->error);
            }
            die($this->error);
        }
        return $this->_run_query_query_type($this->query_type);
    }

}
