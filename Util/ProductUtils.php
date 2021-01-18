<?php
    include('connectDB.php');

    class ProductUtils {
        static function GetPrice($ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product WHERE ProductID='$ProductID' ");
            $res = mysqli_fetch_assoc($sql);
            return $res['UnitPrice'];
        }
        static function GetStock($ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product WHERE ProductID='$ProductID' ");
            $res = mysqli_fetch_assoc($sql);
            return $res['UnitsInStock'];
        }
        static function GetCategory($ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product WHERE ProductID='$ProductID' ");
            $res = mysqli_fetch_assoc($sql);
            return $res['Category'];
        }
        static function GetName($ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product WHERE ProductID='$ProductID' ");
            $res = mysqli_fetch_assoc($sql);
            return $res['Name'];
        }
    }
?>