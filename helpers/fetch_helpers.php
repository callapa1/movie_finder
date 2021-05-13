<?php

Class FetchHelpers {
    static function find_by_id($id, $array) {
        foreach($array as $item) {
            if($item['id'] == $id) {
                return $item;
            }
        }
        echo "ID did not match";
    }
}