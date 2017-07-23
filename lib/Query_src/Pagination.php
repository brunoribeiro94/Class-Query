<?php

//namespace to organize

namespace Query_src;

/**
 *
 * Class query - Pagination
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * 
 * @version 1.7.1
 * @access public
 * @package Language
 * */
class Pagination extends Language {

    /**
     * Set this variable to false if you don't using tag <li>
     * 
     * @access public
     * @var Boolean 
     */
    var $li = false;

    /**
     * Set this variable to false if you don't want the pagination button after
     * 
     * @access public
     * @var Boolean 
     */
    var $after = true;

    /**
     * Set custom HTML item of page
     * 
     * Use <b>%1$d</b> to replace for pagination number.
     * 
     * Use <b>%2$s</b> to replace for link of pagination.
     * 
     * Use <b>%3$s</b> to replace for <b>$class_active</b>.
     * 
     * Example using DIV : <div><a%3$s href="%2$s">%1$d</a></div>
     * 
     * Set FALSE to using <b>$li</b> option.
     * 
     * @access public
     * @var Boolean 
     */
    var $custom_format = false;

    /**
     * Set this variable to false if you don't want the pagination button before 
     * 
     * @access public
     * @var Boolean 
     */
    var $before = true;

    /**
     * Set this variable to true if you don't want the button before and after receive text messages.
     * Set this variable to false if you want show symbols.
     * 
     * @access public
     * @var Boolean 
     */
    var $message = true;

    /**
     * Set this variable to true if  you don't want inserts the symbol, remember to leave $message as false
     * 
     * @see $message
     * @access public
     * @var mixed 
     */
    var $message_before = false;

    /**
     * Message after buttom
     * if false symbol inserts the symbol, remember to leave $message as false
     * 
     * @access public
     * @var mixed 
     */
    var $message_after = false;

    /**
     * Class name for element active, use NULL if you want not put nothing
     * 
     * @access public
     * @var string 
     */
    var $class_active = NULL;

    /**
     * Class name for element inactive, use NULL if you want not put nothing
     * @var string 
     */
    var $class_inactive = NULL;

    /**
     * Class name for element before, use NULL if you want not put nothing
     * 
     * @access public
     * @var string 
     */
    var $class_before = NULL;

    /**
     * Class name for element after, use NULL if you want not put nothing
     * 
     * @access public
     * @var string 
     */
    var $class_after = NULL;

    /**
     * Set this variable to false if  you don't want show page numbers.
     * 
     * @access public
     * @var boolean 
     */
    var $pagination_show_numbering = true;

    /**
     * Set max amount to listing the pages
     * 
     * Set false to disable this limit
     * 
     * @access public
     * @var boolean 
     */
    var $max = 10;

    /**
     * Set the number of previous pages
     * when current page is <b>$max</b>
     * 
     * Remember the amount from next pages respect <b>$max</b> value.
     * 
     * This that next pages is  <$max> - <b>$max_previous</b>
     *  
     * Set 0 to don't show previous pages
     * 
     * @access public
     * @var boolean 
     */
    var $max_previous = 3;

    /**
     * HTML to separate to last pagination
     * 
     * @var string 
     */
    var $max_more = '<span class="page-numbers">[...]</span>';

    /**
     * Set custom HTML for current item
     * 
     * Use <b>%1$d</b> to replace for pagination number and <b>%2$s</b> to replace by link
     * 
     * Set FALSE to use default
     * 
     * @var string 
     */
    var $custom_current = false;

    /**
     * Alias page()
     * 
     * @access public 
     * @return integer
     */
    public function get_page() {
        return $this->page;
    }

    /**
     * Alias pages()
     * 
     * @access public 
     * @return integer
     */
    public function get_pages() {
        return $this->pages;
    }

    /**
     * Alias perpage()
     * 
     * @access public 
     * @return integer
     */
    public function get_perpage() {
        return $this->perpage;
    }

    /**
     * Alias total()
     * 
     * @access public 
     * @return integer
     */
    public function get_total() {
        return $this->total;
    }

    /**
     * check to see if the parameter is equal to the selected mark as if the class as active
     * 
     * @access private
     * @param string $value Asset value of the pagination loop function
     * @param int $param Page parameter
     * @return string
     */
    private function verify_current($value, $param) {
        switch (true) {
            case (isset($this->class_active, $this->class_inative)):
                if ($value == $param) {
                    $result = ' class="' . $this->class_active . '"';
                } else {
                    $result = ' class="' . $this->class_inative . '"';
                }
                break;
            case (isset($this->class_active)):
                if ($value == $param) {
                    $result = ' class="' . $this->class_active . '"';
                } else {
                    $result = false;
                }
                break;
            case (isset($this->class_inative)):
                if ($value == $param) {
                    $result = ' class="' . $this->class_inative . '"';
                } else {
                    $result = false;
                }
                break;
            default:
                $result = NULL;
                break;
        }
        return $result;
    }

    /**
     * checks if the first page if not showing "Previous" and linked up with - 1
     * 
     * @access private
     * @param string $URL Full URL to the point of parameter pages
     * @param int $value Asset value of the pagination loop function
     * @return string
     */
    function make_button_before($URL, $value) {
        $return = $value - 1;
        $class_last = isset($this->class_after) ? ' class="' . $this->class_before . '"' : NULL;
        if ($value > 1) {
            // check message
            if ($this->message) {
                $msg = self::$PAGINATION_TEXT_BEFORE;
            } else {
                $msg = !$this->message_before ? '&#171;' : $this->message_before;
            }
            // check li tag
            if ($this->li) {
                $result = '<li' . $class_last . '><a href="' . $URL . $return . '"> ' . $msg . ' </a></li>';
            } else {
                $result = '<a' . $class_last . ' href="' . $URL . $return . '"> ' . $msg . ' </a>';
            }
        }
        return isset($result) ? $result : false;
    }

    /**
     * checks if it is the last page if it does not show "Next" and linked up with + 1
     * added rules configuration class
     * 
     * @access private
     * @param string $URL Full URL to the point of parameter pages
     * @param int $value Value of the asset page for pagination
     * @param int $total Asset value of the pagination loop function
     * @return string
     */
    function make_button_after($URL, $value, $total) {
        $return = $value + 1;
        $class_before = isset($this->class_after) ? ' class="' . $this->class_after . '"' : NULL;
        if ($value < $total) {
            // check message
            if ($this->message) {
                $msg = self::$PAGINATION_TEXT_AFTER;
            } else {
                $msg = $this->message_after == false ? '&#187;' : $this->message_after;
            }
            // check li tag
            if ($this->li) {
                $result = '<li' . $class_before . '><a href="' . $URL . $return . '"> ' . $msg . ' </a></li>';
            } else {
                $result = '<a' . $class_before . ' href="' . $URL . $return . '"> ' . $msg . ' </a>';
            }
        }
        return isset($result) ? $result : false;
    }

    /**
     * checks whether the page border is greater than or equal to paramentro pages
     * this function is not to show the page if the set limit is less
     * 
     * @access private
     * @param string $page_param Full URL to the point of parameter pages
     * @return Object
     * */
    private function verify_limit($page_param) {
        return ($this->get_pages() >= $page_param) ? true : false;
    }

    /**
     * Create a loop with the numbering and put the link
     * 
     * @param string $URL Full URL to the point of parameter pages
     * @param int $page_param ID of the page
     * @return stirng
     */
    private function loop($URL, $page_param) {
        if (!$this->pagination_show_numbering) {
            return NULL;
        }
        $result = '';
        $format = '<a%3$s href="%2$s">%1$d</a>';
        // check li format item
        if ($this->li)
            $format = '<li%3$s><a href="%2$s">%1$d</a></li>';
        // check custom format item
        if ($this->custom_format)
            $format = $this->custom_format;
        // check limit of pages is enabled and total pages is greater than or equal the max values of pages
        if ($this->max && $this->get_pages() >= $this->max) {
            $initial = $this->get_page();
            $ending = $this->max + $this->get_page();
            $reverse = false;
            // check current page if is equal or greater than the value max of pages
            if ($this->get_page() >= $this->max) {
                $initial = $this->get_page() - $this->max_previous;
                $ending = $this->max + $initial;
            }
            // check the lasts pages to show first page
            if ($this->get_page() === $this->get_pages() || $this->get_page() > ($this->get_pages() - $this->max)) {
                $initial = $this->get_pages() - $this->max;
                $ending = $this->get_pages();
                $reverse = true;
            }
            if ($reverse) {
                if ($this->get_page() !== $this->get_pages())
                    $ending -= 1;
                else
                    $initial += 1;

                $result .= $this->detect_custom_current(1, $page_param, $URL, sprintf($format, 1, $URL . 1, $this->verify_current(1, $page_param))) . $this->max_more;
            }

            for ($i = $initial; $i <= $ending; $i++) {
                // Show last page if current page is the last of listing and reveser is false
                if (!$reverse && $i === $ending || $i - $i >= $this->max)
                    $result .= $this->detect_custom_current($i, $page_param, $URL, $this->max_more . sprintf($format, $this->get_pages(), $URL . $this->get_pages(), $this->verify_current($this->get_pages(), $page_param)));
                else
                    $result .= $this->detect_custom_current($i, $page_param, $URL, sprintf($format, $i, $URL . $i, $this->verify_current($i, $page_param)));
            }
        } else { // show all pages
            for ($i = 1; $i <= $this->get_pages(); $i++)
                $result .= $this->detect_custom_current($i, $page_param, $URL, sprintf($format, $i, $URL . $i, $this->verify_current($i, $page_param)));
        }

        return $result;
    }

    /**
     * Use custom current HTML if enabled
     * 
     * @param int $index
     * @param string $page_param
     * @param string $URL
     * @param string $item
     * @return string
     */
    private function detect_custom_current($index, $page_param, $URL, $item) {
        if ($this->custom_current) {
            if (preg_match("/{$this->class_active}/", $this->verify_current($index, $page_param))) {
                return sprintf($this->custom_current, (int) $index, $URL . $index);
            }
            return $item;
        }
        return $item;
    }

    /**
     * call objects for pagination
     * @access private
     * @param string $URL Full URL to the point of parameter pages
     * @param int $page_param ID of the page
     * @return Object
     */
    private function call_all_object_pagination($URL, $page_param) {
        return $this->make_button_before($URL, $page_param) . $this->loop($URL, $page_param) . $this->make_button_after($URL, $page_param, $this->get_pages());
    }

    /**
     * check limit page
     * @access private
     * @param string $URL Full URL to the point of parameter pages
     * @param int $page_param ID of the page
     * @return string
     */
    private function check_limit($URL, $page_param) {
        if ($this->verify_limit($page_param)) {
            return $this->call_all_object_pagination($URL, $page_param);
        }
    }

    /**
     * create the new paging-numbered
     * bug fix. if the last page shows the pagination, now the query has the lowest records than the limit
     * does not show pagination
     * 
     * @access public
     * @param string $URL Full URL to the point of parameter pages
     * @param int $page_param ID of the page
     * @return Object
     */
    public function make_pages($URL, $page_param) {
        if ($this->get_pages() == 1) {
            return false;
        } else {
            return isset($page_param) ? $this->check_limit($URL, $page_param) : $this->check_limit($URL, 1);
        }
    }

}
