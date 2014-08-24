<?php

/**
 * Configuration for: Database Connection
 * This is the place where your database constants are saved
 *
 */
class Config extends Run {

    /**
     * Multiple Database Conection
     * @var Array 
     */
    public $Conections_Settings = array(
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
     * @var array 
    */
    protected $link_mysqi = array();
    
    /**
     * set charset
     * @deprecated since version 2.2
     * @var string 
    */
    protected $charset = 'UTF8';

    /**
     * Make Conection Mysqi (recommended)
     * @access Private
     * @return Void
     */
    private function mysqli_connection() {
        foreach ($this->Conections_Settings as $key => $value) {
            try {
                $mysqli = new mysqli($value['DB_HOST'], $value['DB_USER'], $value['DB_PASS'], $value['DB_NAME']);
            } catch (Exception $e) {
                exit($this->TEXT_DB_NAME . $e->message);
            }
            $mysqli->set_charset($this->charset);
            $this->link_mysqi[$key] = $mysqli;
        }
    }

    /**
     * Make Conection
     * @return void
     */
    public function __construct() {
        $this->mysqli_connection();
    }

}
