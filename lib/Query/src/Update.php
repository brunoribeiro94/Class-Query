<?php

class Update extends Where
  {
    /* UPDATE */
    
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
     * @param string $update
     * @param array $set
     * @return \Update
     */
    public function update($update, $set = array())
      {
        $this->update = $update;
        if (!empty($set))
          {
            self::set($set);
          }
        return $this;
      }
    
  }
