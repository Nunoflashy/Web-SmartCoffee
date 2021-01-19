<?php
    include(dirname(__DIR__).'/connectDB.php');

    class OrderUtils {
        static function GetProducts($OrderID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM `order details` WHERE OrderID='$OrderID' ");
            $products = array();
            while($res = mysqli_fetch_assoc($sql)) {
                array_push($products, $res['ProductID']);
            }
            return $products;
        }

        static function GetUnits($OrderID, $ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM `order details` WHERE OrderID='$OrderID' AND ProductID='$ProductID' ");
            $res = mysqli_fetch_assoc($sql);
            return $res['Units'];
        }

        static function AddProduct($OrderID, $ProductID, $Units) {
            include('connectDB.php');
            $sql = mysqli_query($connection, "INSERT INTO `order details` (OrderID, ProductID, Units) VALUES('$OrderID', '$ProductID', '$Units') ");
            mysqli_close($connection);
        }

        static function SetTotal($OrderID, $Total) {
            include('connectDB.php');
            $sql = mysqli_query($connection, "UPDATE orders SET Total='$Total' WHERE OrderID='$OrderID'");
            mysqli_close($connection);
        }
        // static function GetTotal($OrderID, $ProductIDList) : float {
        //     $total = 0;
        //     foreach($ProductIDList as &$p) {
        //         $total += (OrderUtils::GetUnits($OrderID, $p) * ProductUtils::GetPrice($p));
        //     }
        //     return $total;
        // }
        static function AddOrder($OrderID, $AccountID, $OrderDate) {
            include('connectDB.php');
            mysqli_query($connection, "INSERT INTO orders (OrderID, AccountID, EmployeeID, OrderDate) VALUES('$OrderID', '$AccountID', '1', '$OrderDate')");
            //mysqli_close($connection);
        }

        static function GetLastID() {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM orders");
            $lastOrderId = 0;
            while($res = mysqli_fetch_assoc($sql)) {
                $lastOrderId = $res['OrderID'];
            }
            return $lastOrderId;
        }
    }
?>