<?php

Class StringHelpers {
    static function remove_multiple_spaces($string) {
        return preg_replace('/\s\s+/', ' ', $string);
    }

    static function tidy_string($string, &$pass) {
        if (empty(trim($string))) {
            echo "Please write something";
            return;
        }
        $string = self::remove_multiple_spaces($string);
        $string = ltrim($string);

        $pass = true;
        return $string;
    }
}