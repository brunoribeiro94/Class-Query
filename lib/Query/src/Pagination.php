<?php

/**
 *
 * Class query - Pagination
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * 
 * @version 1.3
 * @access public
 * @package Language
 * */
class Pagination extends Language
  {
    
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
     * @var Boolean 
     */
    var $message = true;
    
    /**
     * Message before buttom
     * if false symbol inserts the symbol, remember to leave $message as false
     * @var mixed 
     */
    var $message_before = false;

    /**
     * Message after buttom
     * if false symbol inserts the symbol, remember to leave $message as false
     * @var mixed 
     */
    var $message_after = false;
    
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
     * show page numbers?
     * @var boolean 
     */
    var $show_numbering = true;
    

    public function get_page()
      {
        return $this->page;
      }
    
    public function get_pages()
      {
        return $this->pages;
      }
    
    public function get_perpage()
      {
        return $this->perpage;
      }
    
    public function get_total()
      {
        return $this->total;
      }
    
    /**
     * check to see if the parameter is equal to the selected mark as if the class as active
     * @access private
     * @param String $value Asset value of the pagination loop function
     * @param Integer $param Page parameter
     * @return string
     */
    private function verify_current($value, $param)
      {
        switch (true)
        {
            case (isset($this->class_active, $this->class_inative)):
                if ($value == $param)
                  {
                    $result = ' class="' . $this->class_active . '"';
                  }
                else
                  {
                    $result = ' class="' . $this->class_inative . '"';
                  }
                break;
            case (isset($this->class_active)):
                if ($value == $param)
                  {
                    $result = ' class="' . $this->class_active . '"';
                  }
                break;
            case (isset($this->class_inative)):
                if ($value == $param)
                  {
                    $result = ' class="' . $this->class_inative . '"';
                  }
                break;
            default:
                $result = NULL;
        }
        return $result;
      }
    
    /**
     * checks if the first page if not showing "Previous" and linked up with - 1
     * @access private
     * @param String $URL Full URL to the point of parameter pages
     * @param Iteger $value Asset value of the pagination loop function
     * @return string
     */
    function make_button_before($URL, $value)
      {
        $return = $value - 1;
        $class_last = isset($this->class_after) ? ' class="' . $this->class_before . '"' : NULL;
        if ($value > 1) 
        {
            // check message
            if ($this->message == true) 
            {
                $msg = $this->PAGINATION_TEXT_BEFORE;
            } 
            else 
            {
                $msg = $this->message_before == false ? '&#171;' : $this->message_before;
            }
            // check li tag
            if ($this->li == true) 
            {
                $result = '<li' . $class_last . '><a href="' . $URL . $return . '"> ' . $msg . ' </a></li>';
            } 
            else 
            {
                $result = '<a' . $class_last . ' href="' . $URL . $return . '"> ' . $msg . ' </a>';
            }
        }
        return isset($result) ? $result : false;
      }
    
    /**
     * checks if it is the last page if it does not show "Next" and linked up with + 1
     * added rules configuration class
     * @access private
     * @param String $URL Full URL to the point of parameter pages
     * @param $value Value of the asset page for pagination
     * @param $total Asset value of the pagination loop function
     * @return String
     */
    function make_button_after($URL, $value, $total)
      {
        $return = $value + 1;
        $class_before = isset($this->class_after) ? ' class="' . $this->class_after . '"' : NULL;
        if ($value < $total) 
        {
            // check message
            if ($this->message == true) 
            {
                $msg = $this->PAGINATION_TEXT_AFTER;
            } 
            else 
            {
                $msg = $this->message_after == false ? '&#187;' : $this->message_after;
            }
            // check li tag
            if ($this->li == true) 
            {
                $result = '<li' . $class_before . '><a href="' . $URL . $return . '"> ' . $msg . ' </a></li>';
            } 
            else 
            {
                $result = '<a' . $class_before . ' href="' . $URL . $return . '"> ' . $msg . ' </a>';
            }
        }
        return isset($result) ? $result : false;
      }
    
    /**
     * checks whether the page border is greater than or equal to paramentro pages
     * this function is not to show the page if the set limit is less
     * @access private
     * @param String $URL Full URL to the point of parameter pages
     * @return Object
     * */
    private function verify_limit($page_param)
      {
        return ($this->get_pages() >= $page_param) ? true : false;
      }
    
    /**
     * create a loop with the numbering and put the link
     * @access private
     * @param String $URL Full URL to the point of parameter pages
     * @param Integer $page_param ID of the page
     * @return Object
     */
    private function loop($URL, $page_param)
      {
        if ($this->show_numbering == false) 
        {
            return NULL;
        }
        $result = '';
        if ($this->li == true)
          {
            for ($i = 1; $i <= $this->get_pages(); $i++)
              {
                $result .= '<li' . $this->verify_current($i, $page_param) . '><a href="' . $URL . $i . '">' . $i . '</a></li>';
              }
          }
        else
          {
            for ($i = 1; $i <= $this->get_pages(); $i++)
              {
                $result .= '<a' . $this->verify_current($i, $page_param) . ' href="' . $URL . $i . '">' . $i . '</a>';
              }
          }
        return $result;
      }
    
    /**
     * call objects for pagination
     * @access private
     * @param String $URL Full URL to the point of parameter pages
     * @param Integer $page_param ID of the page
     * @return Object
     */
    private function call_all_object_pagination($URL, $page_param)
      {
        return $this->make_button_before($URL, $page_param) . $this->loop($URL, $page_param) . $this->make_button_after($URL, $page_param, $this->get_pages());
      }
    
    /**
     * check limit page
     * @access private
     * @param String $URL Full URL to the point of parameter pages
     * @param Integer $page_param ID of the page
     * @return string
     */
    private function check_limit($URL, $page_param)
      {
        if ($this->verify_limit($page_param) == true)
          {
            return $this->call_all_object_pagination($URL, $page_param);
          }
      }
    
    /**
     * create the new paging-numbered
     * bug fix. if the last page shows the pagination, now the query has the lowest records than the limit
     * does not show pagination
     * @access public
     * @param String $URL Full URL to the point of parameter pages
     * @param Integer $page_param ID of the page
     * @return Object
     */
    public function make_pages($URL, $page_param)
      {
        if ($this->get_pages() == 1)
          {
            return false;
          }
        else
          {
            return isset($page_param) ? $this->check_limit($URL, $page_param) : $this->check_limit($URL, 1);
          }
      }
    
  }
