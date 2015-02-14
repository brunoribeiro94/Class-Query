<?php

//namespace to organize 

namespace Query_src;

// use mysqli connection
use mysqli as mysqli;

/**
 * Configuration for: Database Connection
 * This is the place where your database constants are saved
 * @version 2.4
 */
class Config extends Run {

    /**
     * Multiple Database Conection
     * DB_HOST - database host, usually it's "127.0.0.1" or "localhost", some servers also need port info
     * DB_NAME - for set name of the database. please note: database and database table are not the same thing
     * DB_USER - for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
     * by the way, it's bad style to use "root", but for development it will work.
     * DB_PASS - the password of the above user
     * 
     * @access public
     * @var array 
     */
    public $Connections_Settings = array(
        'Data1' => array(
            'DB_HOST' => '127.0.0.1',
            'DB_NAME' => 'class_Query',
            'DB_USER' => 'root',
            'DB_PASS' => '',
            'DB_CHARSET' => 'utf8'
        ),
        'Data2' => array(
            'DB_HOST' => 'localhost',
            'DB_NAME' => 'class_Query_dev',
            'DB_USER' => 'root',
            'DB_PASS' => '',
            'DB_CHARSET' => 'utf8'
        )
    );

    /**
     * Link mysqli please no put nothing here
     * 
     * @access protected
     * @var array 
     */
    protected $link_mysqi = array();

    /**
     * Make a conection or multiples conections Mysqi (recommended)
     * 
     * @access private
     * @return Void
     */
    private function mysqli_connection($database) {
        if (empty($database)) {
            $value = array_shift($this->Connections_Settings);
        } else {
            $value = $this->Connections_Settings[$database];
        }

        try {
            $mysqli = new mysqli($value['DB_HOST'], $value['DB_USER'], $value['DB_PASS'], $value['DB_NAME']);
            $mysqli->set_charset($value['DB_CHARSET']);
            $this->link_mysqi[] = $mysqli;
        } catch (Exception $e) {
            exit($this->TEXT_DB_NAME . $e->message);
        }
    }

    /**
     * checks which connection is active and returns the correct (no errors)
     * 
     * @access protected
     * @param array $value
     * @param mixed $value
     * @return array
     */
    protected function _check_link_mysqli($value) {
        return mysqli_real_escape_string($this->link_mysqi[0], $value);
    }

    /**
     * Method magic create connection with database
     * 
     * @access public
     * @return void
     */
    public function __construct($database) {
        $this->mysqli_connection($database);
    }

}
