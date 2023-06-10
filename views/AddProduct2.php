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
    <link rel="stylesheet" href="../lib/Semantic-UI-CSS-master/semantic.min.css">
    <script src="../lib/code.jquery.com_jquery-3.7.0.min.js"></script>
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
                        <div class="two fields">
                            <div class="field">
                                <label for="skuId">SKU</label>
                                <input required type="text" id="skuId" name="sku" placeholder="SKU...">
                            </div>
                            <div class="field">
                                <label for="titleId">TITLE</label>
                                <input required type="text" id="titleId" name="title" placeholder="title...">
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label for="priceId">PRICE</label>
                                <input required type="number" id="priceId" name="price" placeholder="price...">
                            </div>
                            <div class="field">
                                <label for="salepriceId">SALE PRICE</label>
                                <input required type="number" id="salepriceId" name="sale-price" placeholder="sale price...">
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label for="featuredimgId">FEAETURED IMAGE</label>
                                <input required type="file" id="featuredimgId" name="featuredimg">
                            </div>
                            <div class="field">
                                <label for="gallariesId">GALLARIES</label>
                                <input required type="file" id="gallariesId" name="gallary[]" multiple>
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>TAGS</label>

                                <select required multiple="" class="ui dropdown" name="mySelectTag[]">
                                    <option value="">Select Tag</option>
                                    
                                    <?php
                                        $tags = MProduct::getAllTags();
                                        foreach ($tags as $tag) {
                                            echo '<option value="' . $tag->getTagName() . '">' . $tag->getTagName() . '</option>';
                                        }
                                    ?>
                                </select>

                            </div>

                            <div class="field">
                                <label>CATEGORIES</label>

                                <select required multiple="" class="ui dropdown" name="mySelectCate[]">
                                    <option value="">Select Category</option>
                                    <?php
                                        $cates = MProduct::getAllCates();
                                        foreach ($cates as $cate) {
                                            echo '<option value="' . $cate->getCateName() . '">' . $cate->getCateName() . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label for="descId">DESCRIPTION</label>
                            <textarea required name="desc" id="descId" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <button class="ui button" type="submit" name="submit">Add</button>
                </form>
            </div>
        </div>

        <script>
            $('select.dropdown').dropdown();
        </script>

        <?php
        
        $product = new Product();
        if (isset($_POST['submit']) && isset($_FILES['featuredimg'])) {
            $product->setSku(preg_replace('/\s+/', '', trim($_POST["sku"])));
            $product->setTitle(preg_replace('/\s+/', ' ', trim($_POST["title"])));
            $product->setPrice($_POST["price"]);
            $product->setSalePrice($_POST["sale-price"]);
            $product->setFeaturedImage(trim($_FILES["featuredimg"]['name']));
            $product->setDescription(preg_replace('/\s+/', ' ', trim($_POST["desc"])));
            $product->setCreatedDate(date('Y-m-d'));
            MProduct::addProduct($product);

            //upload file
            $target_dir = "../img/";
            $target_file = $target_dir . basename($_FILES["featuredimg"]["name"]);
            move_uploaded_file($_FILES["featuredimg"]["tmp_name"], $target_file);


            $selectedOptionTag = $_POST["mySelectTag"];
            foreach ($selectedOptionTag as $tag) {
                // echo MProduct::getIdFromTag($tag) . "<br>";
                MProduct::addProductTags(MProduct::getIdFromTag($tag));
            }

            $selectedOptionCate = $_POST["mySelectCate"];
            foreach ($selectedOptionCate as $cate) {
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