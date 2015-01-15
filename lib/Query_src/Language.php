<?php

//namespace to organize

namespace Query_src;

/**
 * Text used in class Query
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * 
 * @version 0.2
 * @access public
 * @package text_class
 */
class Language {

    /**
     * Error connect database
     * 
     * @static
     * @access protected
     * @var String
     */
    protected static $TEXT_DB_NAME = 'Unable to connect to database: ';

    /**
     * Error invalid execute Query
     * 
     * @static
     * @access protected
     * @var String
     */
    protected static $TEXT_ERRO_QUERY = 'Error: bad query type: ';

    /**
     * Error query syntax
     * 
     * @static
     * @access protected
     * @var String
     */
    protected static $TEXT_ERRO_TYPE_QUERY = 'Error in query: ';

    /**
     * Text debugger  to show SQL executed
     * 
     * @static
     * @access protected
     * @var String
     */
    protected static $TEXT_OUTPUT_QUERY = 'SQL executed: ';

    /**
     * Text pagination before page
     * 
     * @static
     * @access protected
     * @var String
     */
    protected static $PAGINATION_TEXT_BEFORE = 'Before';

    /**
     * Text pagination after page
     * 
     * @static
     * @access protected
     * @var String
     */
    protected static $PAGINATION_TEXT_AFTER = 'After';

}
