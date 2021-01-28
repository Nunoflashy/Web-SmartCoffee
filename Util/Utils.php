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

        static function IsProductAvailableToOrder($OrderID, $ProductID) {
            if(!isset($OrderID)) {
                return ProductUtils::GetStock($ProductID) > 0;
                //die(sprintf("Called %s without an order!", __METHOD__));
            }
            
            $totalStock = ProductUtils::GetStock($ProductID);
            $orderUnits = OrderUtils::GetUnits($OrderID, $ProductID);
            return ($totalStock - $orderUnits) > 0;
        }

        static function GetOrderID() {
            return $_SESSION['OrderID'] ?? -1;
        }
    }
?>