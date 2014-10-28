<?php

/**
 * Class Query Update Query
 * @author Zachbor       <zachborboa@gmail.com>
 * 
 * @version 0.1
 * @access public
 * @package Update
 * @subpackage Where
 */
class Update extends Where
  {
    
    /**
     * return last get updated
     * @return array
     */
    public function get_updated()
      {
        return self::get_affected();
      }
    
    /**
     * values set for update Query function
     * @param mixed $set
     * @return \Update
     */
    public function set($set)
      {
        $this->set = $set;
        return $this;
      }
    
    /**
     * Function Query update
     * @param string $table Table name
     * @param array $set Array colletion columns and value
     * @return \Update
     */
    public function update($table, $set = array())
      {
        $this->update = $table;
        if (!empty($set))
          {
            self::set($set);
          }
        return $this;
      }
    
  }
