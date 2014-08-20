<?php

/**
 * Configuration for: Database Connection
 * This is the place where your database constants are saved
 *
 */
class Config extends Run {

    /**
     * database host, usually it's "127.0.0.1" or "localhost", some servers also need port info
     * @var mixed 
     */
    protected $DB_HOST = "127.0.0.1";

    /**
     * name of the database. please note: database and database table are not the same thing
     * @var mixed 
     */
    protected $DB_NAME = "class_Query";

    /**
     * user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
     * by the way, it's bad style to use "root", but for development it will work.
     * @var mixed 
     */
    protected $DB_USER = "root";

    /**
     * the password of the above user
     * @var mixed 
     */
    protected $DB_PASS = "";

    /**
     * Link mysqli please no put nothing here
     * @var unknow 
     */
    protected $link_mysqi = NULL;

    /**
     * set charset
     * @var string 
     */
    protected $charset = 'UTF8';

    // pagination configure

    /**
     * put true if you for use tag li also put false
     * @var Boolean 
     */
    var $li = false;

    /**
     * put false if you no want the button after
     * @var Boolean 
     */
    var $after = true;

    /**
     * put false if you no want the button before
     * @var Boolean 
     */
    var $before = true;

    /**
     * put true if you do not want the button before and after receive text messages put false will show symbols.
     * @see <code>lamguage.php</code>
     * @var Boolean 
     */
    var $message = true;

    /**
     * Class name for element active, use NULL if you want not put nothing
     * @var String 
     */
    var $class_active = NULL;

    /**
     * Class name for element inactive, use NULL if you want not put nothing
     * @var String 
     */
    var $class_inactive = NULL;

    /**
     * Class name for element before, use NULL if you want not put nothing
     * @var String 
     */
    var $class_before = NULL;

    /**
     * Class name for element after, use NULL if you want not put nothing
     * @var String 
     */
    var $class_after = NULL;

    /**
     * Make Conection Mysqi (recommended)
     * @access Private
     * @return Void
     */
    private function mysqli_connection() {
        try {
            $mysqli = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
        } catch (Exception $e) {
            exit($this->PAGINATION_TEXT_DB_NAME . $e->message);
        }
        $mysqli->set_charset($this->charset);
        $this->link_mysqi = $mysqli;
    }

    /**
     * Make Conection
     * @return void
     */
    public function __construct() {
        $this->mysqli_connection();
    }

}
