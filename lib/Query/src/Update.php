<?php

class Update extends Where {
    /* UPDATE */

    public function get_updated() {
        return self::get_affected();
    }

    public function set($set) {
        $this->set = $set;
        return $this;
    }

    public function update($update, $set = array()) {
        $this->update = $update;
        if (!empty($set)) {
            self::set($set);
        }
        return $this;
    }

}
