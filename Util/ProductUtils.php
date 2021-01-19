<?php
    include('connectDB.php');
if(!class_exists("ProductUtils")) {
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

        static function GetAllID() {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product");
            $products = array();
            while($res = mysqli_fetch_assoc($sql)) {
                array_push($products, $res['ProductID']);
            }
            return $products;
        }
        
        static function GetAllIDFromCategory($category) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product WHERE Category='$category'");
            $products = array();
            while($res = mysqli_fetch_assoc($sql)) {
                array_push($products, $res['ProductID']);
            }
            return $products;
        }

        static function SetStock($ProductID, $x) {
            include('connectDB.php');
            $sql = mysqli_query($connection, "UPDATE product SET UnitsInStock='$x' WHERE ProductID='$ProductID'");
        }

        static function ModStock($ProductID, $x) {
            include('connectDB.php');
            $currentStock = ProductUtils::GetStock($ProductID);
            $newStock = $currentStock + $x;
            $sql = mysqli_query($connection, "UPDATE product SET UnitsInStock='$newStock' WHERE ProductID='$ProductID'");
        }
    }
}
?>