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
            return $res['Units'] ?? 0;
        }

        static function AddProduct($OrderID, $ProductID, $Units) {
            include('connectDB.php');
            $sql = mysqli_query($connection, "INSERT INTO `order details` (OrderID, ProductID, Units) VALUES('$OrderID', '$ProductID', '$Units') ");
        }

        static function SetTotal($OrderID, $Total) {
            include('connectDB.php');
            $sql = mysqli_query($connection, "UPDATE orders SET Total='$Total' WHERE OrderID='$OrderID'");
        }

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

        static function ProductExists($OrderID, $ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM `order details` WHERE OrderID='$OrderID' AND ProductID='$ProductID'");
            return mysqli_num_rows($sql);
        }
        static function ModQuantity($OrderID, $ProductID, $x) {
            global $connection;
            $sql = mysqli_query($connection, "UPDATE `order details` SET Units=Units+'$x' WHERE OrderID='$OrderID' AND ProductID='$ProductID'");
        }
        static function RemoveProduct($OrderID, $ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "DELETE FROM `order details` WHERE OrderID='$OrderID' AND ProductID='$ProductID'");
        }

        static function GetAllID() {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM orders o JOIN account a ON o.AccountID=a.AccountID ORDER BY OrderID");
            $orders = array();
            while($res = mysqli_fetch_assoc($sql)) {
                array_push($orders, $res['OrderID']);
            }
            return $orders;
        }
        static function GetCustomer($OrderID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT AccountID FROM orders WHERE OrderID='$OrderID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['AccountID'];
        }

        static function GetDate($OrderID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT OrderDate FROM orders WHERE OrderID='$OrderID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['OrderDate'];
        }
        static function GetTotal($OrderID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT Total FROM orders WHERE OrderID='$OrderID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Total'];
        }
        
        static function RemoveOrder($OrderID) {
            global $connection;
            $sql = mysqli_query($connection, "DELETE FROM orders WHERE OrderID='$OrderID'");
        }
    }
?>