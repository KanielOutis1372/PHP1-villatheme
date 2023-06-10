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

        
        public static function getProductByID($id) {
            $conn = ConnectDB::getConnection();
            $ps = $conn->prepare("
                SELECT P.ID, P.SKU, P.Title, P.Price, P.SalePrice, P.FeaturedImage, P.Description, P.CreatedDate, P.ModifiedDate,
                GROUP_CONCAT(DISTINCT C.CategoryName) AS Categories,
                GROUP_CONCAT(DISTINCT T.TagName) AS Tags,
                GROUP_CONCAT(DISTINCT G.ImageURL) AS ImageURLs
                FROM Products P
                LEFT JOIN ProductCategories PC ON P.ID = PC.ProductID
                LEFT JOIN Categories C ON PC.CategoryID = C.CategoryID
                LEFT JOIN ProductTags PT ON P.ID = PT.ProductID
                LEFT JOIN Tags T ON PT.TagID = T.TagID
                LEFT JOIN Gallery G ON P.ID = G.ProductID
                WHERE P.ID = ?
                GROUP BY P.ID;
            ");
            $ps->bind_param('s', $id);
            $ps->execute();
            $result = $ps->get_result();
            $product = new Product();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
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
                }
            }
            return $product;

        }

        public static function delete($id) {
            $conn = ConnectDB::getConnection();
            
            $psProTag = $conn->prepare("
            DELETE FROM ProductTags WHERE ProductID = ?;
            ");
            $psProTag->bind_param('s', $id);
            $psProTag->execute();
            
            $psProCate = $conn->prepare("
            DELETE FROM ProductCategories WHERE ProductID = ?;
            ");
            $psProCate->bind_param('s', $id);
            $psProCate->execute();

            $psProGaller = $conn->prepare("
            DELETE FROM Gallery WHERE ProductID = ?;
            ");
            $psProGaller->bind_param('s', $id);
            $psProGaller->execute();

            $psPro = $conn->prepare("
                DELETE FROM Products WHERE ID = ?;
            ");
            $psPro->bind_param('s', $id);
            $psPro->execute();
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

        public static function getIdFromTag($tagName) {
            $conn = ConnectDB::getConnection();
            
            $qr = 'SELECT TagId FROM TAGS WHERE TagName = ?';
            $ps = $conn->prepare($qr);
            $ps->bind_param('s', $tagName);
            $ps->execute();
            $rs = $ps->get_result();
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_assoc()) {
                    return $row['TagId'];
                }
            }
        }

        public static function getIdFromCate($categoryName) {
            $conn = ConnectDB::getConnection();
            $qr = 'SELECT CategoryId FROM CATEGORIES WHERE CategoryName = ?';
            $ps = $conn->prepare($qr);
            $ps->bind_param('s', $categoryName);
            $ps->execute();
            $rs = $ps->get_result();
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_assoc()) {
                    return $row['CategoryId'];
                }
            }
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

        public static function getLastProductId() {
            $conn = ConnectDB::getConnection();
            $qrt = 'SELECT MAX(ID) AS ID FROM Products';
            $rst = $conn->query($qrt);
            $product = new Product();
            if ($rst->num_rows > 0) {
                while ($row = $rst->fetch_assoc()) {
                    $product->setId($row['ID']);
                }
            }
            return $product->getId();
        }

        public static function addProductTags($tagId) {
            $conn = ConnectDB::getConnection();
            $lastProductId = MProduct::getLastProductId();
            $qr = 'INSERT INTO PRODUCTTAGS (ProductID, TagID) VALUES (?, ?)';
            $ps = $conn->prepare($qr);
            $ps->bind_param('ii', $lastProductId, $tagId);
            $ps->execute();
        }

        public static function addProductCategories($categoryId) {
            $conn = ConnectDB::getConnection();
            $lastProductId = MProduct::getLastProductId();
            $qr = 'INSERT INTO PRODUCTCATEGORIES (ProductID, CategoryID) VALUES (?, ?)';
            $ps = $conn->prepare($qr);
            $ps->bind_param('ii', $lastProductId, $categoryId);
            $ps->execute();
        }

        public static function addGallery($imageName) {
            $conn = ConnectDB::getConnection();
            $lastProductId = MProduct::getLastProductId();
            $qr = 'INSERT INTO GALLERY (ProductID, ImageURL) VALUES (?, ?)';
            $ps = $conn->prepare($qr);
            $ps->bind_param('is', $lastProductId, $imageName);
            $ps->execute();
        }

        public static function addNewTag($tagName) {
            $conn = ConnectDB::getConnection();
            $qr = 'INSERT INTO TAGS (TagName) VALUES (?)';
            $ps = $conn->prepare($qr);
            $ps->bind_param('s', $tagName);
            $ps->execute();
        }

        public static function addNewCategory($categoryName) {
            $conn = ConnectDB::getConnection();
            $qr = 'INSERT INTO CATEGORIES (CategoryName) VALUES (?)';
            $ps = $conn->prepare($qr);
            $ps->bind_param('s', $categoryName);
            $ps->execute();
        }
        

        public static function updateProduct($id, $product) {
            $sku = $product->getSku();
            $title = $product->getTitle();
            $price = $product->getPrice();
            $salePrice = $product->getSalePrice();
            $featuredImg = $product->getFeaturedImage();
            $desc = $product->getDescription();
            $modifedDate = $product->getModifiedDate();

            $conn = ConnectDB::getConnection();
            $qr = 'UPDATE PRODUCTS SET SKU = ?, TITLE = ?, PRICE = ?, SALEPRICE = ?, FEATUREDIMAGE = ?, DESCRIPTION = ?, MODIFIEDDATE = ?  WHERE ID = ?';
            $ps = $conn->prepare($qr);
            $ps->bind_param('ssiisssi', $sku, $title, $price, $salePrice, $featuredImg, $desc, $modifedDate, $id);  
            $ps->execute();
        }

        public static function updateProductTags($id, $tagId) {
            $conn = ConnectDB::getConnection();
            $qr = 'UPDATE PRODUCTTAGS SET TAGID = ? WHERE PRODUCTID = ?';
            $ps = $conn->prepare($qr);
            $ps->bind_param('ii', $tagId, $id);  
            $ps->execute();
        }

        public static function updateProductCategories($id, $categoryId) {
            $conn = ConnectDB::getConnection();
            $qr = 'UPDATE PRODUCTCATEGORIES SET CATEGORYID = ? WHERE PRODUCTID = ?';
            $ps = $conn->prepare($qr);
            $ps->bind_param('ii', $categoryId, $id);  
            $ps->execute();
        }

        public static function updateGallery($id, $imageName) {
            $conn = ConnectDB::getConnection();
            $qr = 'UPDATE GALLERY SET ImageURL = ? WHERE ProductID =?';
            $ps = $conn->prepare($qr);
            $ps->bind_param('si', $imageName, $id);
            $ps->execute();
        }

    }
    // print_r(MProduct::getIdFromTag($tagName = 'Tag 2'));
    // print_r(MProduct::getLastProductId());
    // print_r(MProduct::getProductByID(19));
    // print_r(MProduct::getAllCates());
