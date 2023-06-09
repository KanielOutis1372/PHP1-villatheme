<?php
    include_once '../models/Product.php';
    include_once '../models/MProduct.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css">
    <link rel="stylesheet" href="../lib/Semantic-UI-CSS-master/semantic.min.css">
    <script src="../lib/Semantic-UI-CSS-master/semantic.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>


    <div class="ui equal width grid">
        <div class="row">
            <div class="column">
                <h1>ADD NEW PRODUCT</h1>
            </div>
            <div class="column">
                <a href="Home.php"><button class="ui primary button pull-right">Cancel</button></a>

            </div>
        </div>

        <div class="row">
            <div class="column">
                <form class="ui form" action="" method="POST" enctype="multipart/form-data">
                    <div class="field">
                        <label for="skuId">SKU</label>
                        <input type="text" id="skuId" name="sku" placeholder="SKU...">
                    </div>
                    <div class="field">
                        <label for="titleId">TITLE</label>
                        <input type="text" id="titleId" name="title" placeholder="title...">
                    </div>
                    <div class="field">
                        <label for="priceId">PRICE</label>
                        <input type="number" id="priceId" name="price" placeholder="price...">
                    </div>
                    <div class="field">
                        <label for="salepriceId">SALE PRICE</label>
                        <input type="number" id="salepriceId" name="sale-price" placeholder="sale price...">
                    </div>
                    <div class="field">
                        <label for="featuredimgId">FEAETURED IMAGE</label>
                        <input type="file" id="featuredimgId" name="featuredimg">
                    </div>
                    <div class="field">
                        <label for="descId">DESCRIPTION</label>
                        <textarea name="desc" id="descId" cols="30" rows="10"></textarea>
                    </div>
                    <div class="field">
                        <label for="createddateId">CREADTED DATE</label>
                        <input type="date" id="createddateId" name="createddate">
                    </div>
                    
                    <div class="field">
                        <label>TAGS</label>
                        <div class="checkbox-group">
                            <?php
                            $tags = MProduct::getAllTags();
                            foreach ($tags as $tag) {
                                echo '<div class="ui checkbox">
                                    <input type="checkbox" name="tag[]" value="' . $tag->getTagName() . '">
                                    <label>' . $tag->getTagName() . '</label>
                                </div>';
                            }
                            ?>
                        </div>

                    </div>

                    <div class="field">
                        <label>CATEGORIES</label>
                        <div class="checkbox-group">
                            <?php
                            $cates = MProduct::getAllCates();
                            foreach ($cates as $cate) {
                                echo '<div class="ui checkbox">
                                    <input type="checkbox" name="cate[]" value="' . $cate->getCateName() . '">
                                    <label>' . $cate->getCateName() . '</label>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="field">
                        <label for="gallariesId">GALLARIES</label>
                        <input type="file" id="gallariesId" name="gallary[]" multiple>
                    </div>

                    <button class="ui button" type="submit" name="submit">Add</button>
                </form>
            </div>
        </div>

        <?php
        
        $product = new Product();
        if (isset($_POST['submit']) && isset($_FILES['featuredimg'])) {
            $product->setSku($_POST["sku"]);
            $product->setTitle($_POST["title"]);
            $product->setPrice($_POST["price"]);
            $product->setSalePrice($_POST["sale-price"]);
            $product->setFeaturedImage($_FILES["featuredimg"]['name']);
            $product->setDescription($_POST["desc"]);
            $product->setCreatedDate($_POST["createddate"]);
            MProduct::addProduct($product);

            //upload file
            $target_dir = "../img/";
            $target_file = $target_dir . basename($_FILES["featuredimg"]["name"]);
            move_uploaded_file($_FILES["featuredimg"]["tmp_name"], $target_file);


            $selectedTag = $_POST['tag'];
            foreach ($selectedTag as $tag) {
                // echo MProduct::getIdFromTag($tag) . "<br>";
                MProduct::addProductTags(MProduct::getIdFromTag($tag));
            }

            $selectedCate = $_POST['cate'];
            foreach ($selectedCate as $cate) {
                // echo MProduct::getIdFromCate($cate) . "<br>";
                MProduct::addProductCategories(MProduct::getIdFromCate($cate));
            }

            $selectedFiles = $_FILES['gallary'];
            
            // Lặp qua danh sách các tệp tin được chọn
            for ($i = 0; $i < count($selectedFiles['name']); $i++) {
                // echo $selectedFiles['name'][$i] . "<br>";
                MProduct::addGallery($selectedFiles['name'][$i]);
                $target_file = $target_dir . $selectedFiles['name'][$i];
                move_uploaded_file($selectedFiles['tmp_name'][$i], $target_file);
            }
        }

        // header('location:  Home.php');

        ?>

    </div>
</body>

</html>