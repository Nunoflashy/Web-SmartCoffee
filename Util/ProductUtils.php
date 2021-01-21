<?php
    include(dirname(__DIR__).'/connectDB.php');
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
            return $res['Category'] ?? "";
        }
        static function GetName($ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product WHERE ProductID='$ProductID' ");
            $res = mysqli_fetch_assoc($sql);
            return $res['Name'] ?? "";
        }
        static function GetID($name) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product WHERE Name='$name'");
            $res = mysqli_fetch_assoc($sql);
            return $res['ProductID'];
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
            global $connection;
            $sql = mysqli_query($connection, "UPDATE product SET UnitsInStock='$x' WHERE ProductID='$ProductID'");
        }

        static function ModStock($ProductID, $x) {
            global $connection;
            $currentStock = ProductUtils::GetStock($ProductID);
            $newStock = $currentStock + $x;
            $sql = mysqli_query($connection, "UPDATE product SET UnitsInStock='$newStock' WHERE ProductID='$ProductID'");
        }

        static function RemoveProduct($ProductID) {
            global $connection;
            $sql = mysqli_query($connection, "DELETE FROM product WHERE ProductID='$ProductID'");
        }

        static function Exists($name) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM product WHERE Name='$name'");
            return mysqli_num_rows($sql);
        }
        static function GetCategoryImage($ProductID) {
            switch(self::GetCategory($ProductID)) {
                case "Cafetaria":  return 'img/category/coffeeIconCircle.png';
                case "Pastelaria": return 'img/category/breadIconCircle.png';
                case "Salgados":   return 'img/category/savoriesIconCircle.png';
                case "Bebidas":    return 'img/category/drinksIconCircle.png';
                case "Tecnologia": return 'img/category/technologyIconCircle.png';
            }
        }
    }
}
?>