<?php
    class Util {
        static function ArrayToURL($array) {
            $encodedArray = urlencode(serialize($array));
            return $encodedArray;
        }
        static function ArrayFromURL($encodedArray) {
            $decodedArray = unserialize(urldecode($encodedArray));
            return $decodedArray;
        }
    }
?>