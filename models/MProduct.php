<?php 
    include_once('ConnectDB.php');
    include_once('Product.php');
    include_once('Tag.php');
    include_once('Category.php');

    class MProduct {
        public static function getAllProduct() {
            $productList = array();
            $conn = ConnectDB::getConnection();
            $qr = 'SELECT P.ID, P.SKU, P.Title, P.Price, P.SalePrice, P.FeaturedImage, P.Description, P.CreatedDate, P.ModifiedDate,
                        GROUP_CONCAT(DISTINCT C.CategoryName) AS Categories,
                        GROUP_CONCAT(DISTINCT T.TagName) AS Tags,
                        GROUP_CONCAT(DISTINCT G.ImageURL) AS ImageURLs
                        FROM Products P
                        LEFT JOIN ProductCategories PC ON P.ID = PC.ProductID
                        LEFT JOIN Categories C ON PC.CategoryID = C.CategoryID
                        LEFT JOIN ProductTags PT ON P.ID = PT.ProductID
                        LEFT JOIN Tags T ON PT.TagID = T.TagID
                        LEFT JOIN Gallery G ON P.ID = G.ProductID
                        GROUP BY P.ID;';
        
            // Create connection
            $result = $conn->query($qr);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product = new Product();
                    $product->setId($row['ID']);
                    $product->setSku($row['SKU']);
                    $product->setTitle($row['Title']);
                    $product->setPrice($row['Price']);
                    $product->setSalePrice($row['SalePrice']);
                    $product->setFeaturedImage($row['FeaturedImage']);
                    $product->setGallery($row['ImageURLs']);
                    $product->setDescription($row['Description']);
                    $product->setCreatedDate($row['CreatedDate']);
                    $product->setModifiedDate($row['ModifiedDate']);
                    $product->setCategory($row['Categories']);
                    $product->setTag($row['Tags']);
                    array_push($productList, $product);
                }
            }
            return $productList;
        }

        public static function addProduct($product) {
            $conn = ConnectDB::getConnection();
            $sku = $product->getSku();
            $title = $product->getTitle();
            $price = $product->getPrice();
            $salePrice = $product->getSalePrice();
            $featuredImage = $product->getFeaturedImage();
            $description = $product->getDescription();
            $createdDate = $product->getCreatedDate();
            $ps = $conn->prepare("
                INSERT INTO Products (SKU, Title, Price, SalePrice, FeaturedImage, Description, CreatedDate)
                VALUES (?, ?, ?, ?, ?, ?, ?);
            ");
            $ps->bind_param('ssddsss', $sku, $title, $price, $salePrice, $featuredImage, $description, $createdDate);

            $ps->execute();
        }

        
        // public static function getProductByID($id) {
        //     $conn = ConnectDB::getConnection();
        //     $ps = $conn->prepare("
        //         SELECT P.ID, P.SKU, P.Title, P.Price, P.SalePrice, P.Description, P.CreatedDate, P.ModifiedDate,
        //         GROUP_CONCAT(C.CategoryName) AS Categories,
        //         GROUP_CONCAT(T.TagName) AS Tags,
        //         GROUP_CONCAT(G.ImageURL) AS ImageURLs
        //         FROM Products P
        //         LEFT JOIN ProductCategories PC ON P.ID = PC.ProductID
        //         LEFT JOIN Categories C ON PC.CategoryID = C.CategoryID
        //         LEFT JOIN ProductTags PT ON P.ID = PT.ProductID
        //         LEFT JOIN Tags T ON PT.TagID = T.TagID
        //         LEFT JOIN Gallery G ON P.ID = G.ProductID
        //         WHERE P.ID = ?
        //         GROUP BY P.ID;
        //     ");

        // }

        public static function delete($id) {
            $conn = ConnectDB::getConnection();
            $ps = $conn->prepare("
                DELETE FROM Products WHERE ID = ?;
            ");
            $ps->bind_param('s', $id);
            $ps->execute();
        }



        public static function getAllTags() {
            $conn = ConnectDB::getConnection();
            $qr = 'SELECT * FROM TAGS';
            $tagList = array();
            $rs = $conn->query($qr);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_assoc()) {
                    $tag = new Tag();
                    $tag->setId($row['TagId']);
                    $tag->setTagName($row['TagName']);
                    array_push($tagList, $tag);
                }
            }
            return $tagList; 
        }

        
        public static function getAllCates() {
            $conn = ConnectDB::getConnection();
            $qr = 'SELECT * FROM Categories';
            $cateList = array();
            $rs = $conn->query($qr);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_assoc()) {
                    $cate = new Category();
                    $cate->setCateId($row['CategoryId']);
                    $cate->setCateName($row['CategoryName']);
                    array_push($cateList, $cate);
                }
            }
            return $cateList; 
        }

        public static function addProperty($tag, $property, $gallery) {

        }
    }
    // print_r(MProduct::getAllCates());
?>
