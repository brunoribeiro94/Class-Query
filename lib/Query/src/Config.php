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
    protected $Conections_Settings = array(
        'Data1' => array(
            'DB_HOST' => '127.0.0.1',
            'DB_NAME' => 'class_Query',
            'DB_USER' => 'root',
            'DB_PASS' => ''
        ),
        'Data2' => array(
            'DB_HOST' => '127.0.0.1',
            'DB_NAME' => 'class_Query_dev',
            'DB_USER' => 'root',
            'DB_PASS' => ''
        )
    );

    /**
     * Link mysqli please no put nothing here
     * @var array 
     */
    protected $link_mysqi = array();

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
        foreach ($this->Conections_Settings as $key => $value) {
            try {
                $mysqli = new mysqli($value['DB_HOST'], $value['DB_USER'], $value['DB_PASS'], $value['DB_NAME']);
            } catch (Exception $e) {
                exit($this->PAGINATION_TEXT_DB_NAME . $e->message);
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
