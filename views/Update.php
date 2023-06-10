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
                <h1>UPDATE PRODUCT</h1>
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
                                <input type="text" id="skuId" name="sku" placeholder="SKU..." value="<?php echo MProduct::getProductByID($_GET['id'])->getSku() ?>">
                            </div>
                            <div class="field">
                                <label for="titleId">TITLE</label>
                                <input type="text" id="titleId" name="title" placeholder="title..." value="<?php echo MProduct::getProductByID($_GET['id'])->getTitle() ?>">
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label for="priceId">PRICE</label>
                                <input type="number" id="priceId" name="price" placeholder="price..." value="<?php echo MProduct::getProductByID($_GET['id'])->getPrice() ?>">
                            </div>
                            <div class="field">
                                <label for="salepriceId">SALE PRICE</label>
                                <input type="number" id="salepriceId" name="sale-price" placeholder="sale price..." value="<?php echo MProduct::getProductByID($_GET['id'])->getSalePrice() ?>">
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label for="featuredimgId">FEAETURED IMAGE</label>
                                <input type="file" id="featuredimgId" name="featuredimg">


                            </div>
                            <div class="field">
                                <label for="gallariesId">GALLARIES</label>
                                <input type="file" id="gallariesId" name="gallary[]" multiple>
                                <div class="ui image label">
                                    <img src="/images/avatar/small/ade.jpg">
                                    Adrienne
                                    <i class="delete icon"></i>
                                </div>
                                <div class="ui image label">
                                    <img src="/images/avatar/small/zoe.jpg">
                                    Zoe
                                    <i class="delete icon"></i>
                                </div>
                                <div class="ui image label">
                                    <img src="/images/avatar/small/nan.jpg">
                                    Nan
                                    <i class="delete icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>TAGS</label>
                                <select multiple="" class="ui dropdown" name="mySelectTag[]">
                                    <option value="">Select Tag</option>

                                    <?php
                                    $tags = MProduct::getAllTags();
                                    $tagUpdate = explode(',', MProduct::getProductByID($_GET['id'])->getTag());
                                    foreach ($tags as $tag) {
                                        foreach ($tagUpdate as $tagv) {
                                            if ($tag->getTagName() == $tagv) {
                                                echo '<option value="' . $tag->getTagName() . '" selected>' . $tag->getTagName() . '</option>';
                                                break;
                                            }
                                        }
                                        echo '<option value="' . $tag->getTagName() . '">' . $tag->getTagName() . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class="field">
                                <label>CATEGORIES</label>

                                <select multiple="" class="ui dropdown" name="mySelectCate[]">
                                    <option value="">Select Category</option>
                                    <?php
                                    $cates = MProduct::getAllCates();
                                    $cateUpdate = explode(',', MProduct::getProductByID($_GET['id'])->getCategory());
                                    foreach ($cates as $cate) {
                                        foreach ($cateUpdate as $catev) {
                                            if ($cate->getCateName() == $catev) {
                                                echo '<option value="' . $cate->getCateName() . '" selected>' . $cate->getCateName() . '</option>';
                                                break;
                                            }
                                        }
                                        echo '<option value="' . $cate->getCateName() . '">' . $cate->getCateName() . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label for="descId">DESCRIPTION</label>
                            <textarea name="desc" id="descId" cols="30" rows="10"><?php echo MProduct::getProductByID($_GET['id'])->getDescription() ?></textarea>
                        </div>
                    </div>
                    <button class="ui button" type="submit" name="submit">Update</button>
                </form>
            </div>
        </div>

        <script>
            $('select.dropdown').dropdown();
        </script>

        <?php

        // $a = explode(',',MProduct::getProductByID($_GET['id'])->getTag());
        // foreach ($a as $value) {
        //     echo $value;
        // }

        // $product = new Product();
        // if (isset($_POST['submit']) && isset($_FILES['featuredimg'])) {
        //     $product->setSku($_POST["sku"]);
        //     $product->setTitle($_POST["title"]);
        //     $product->setPrice($_POST["price"]);
        //     $product->setSalePrice($_POST["sale-price"]);
        //     $product->setFeaturedImage($_FILES["featuredimg"]['name']);
        //     $product->setDescription($_POST["desc"]);
        //     $product->setCreatedDate(date('Y-m-d'));
        //     MProduct::addProduct($product);

        //     //upload file
        //     $target_dir = "../img/";
        //     $target_file = $target_dir . basename($_FILES["featuredimg"]["name"]);
        //     move_uploaded_file($_FILES["featuredimg"]["tmp_name"], $target_file);


        //     $selectedOptionTag = $_POST["mySelectTag"];
        //     foreach ($selectedOptionTag as $tag) {
        //         // echo MProduct::getIdFromTag($tag) . "<br>";
        //         MProduct::addProductTags(MProduct::getIdFromTag($tag));
        //     }

        //     $selectedOptionCate = $_POST["mySelectCate"];
        //     foreach ($selectedOptionCate as $cate) {
        //         // echo MProduct::getIdFromCate($cate) . "<br>";
        //         MProduct::addProductCategories(MProduct::getIdFromCate($cate));
        //     }

        //     $selectedFiles = $_FILES['gallary'];

        //     // Lặp qua danh sách các tệp tin được chọn
        //     for ($i = 0; $i < count($selectedFiles['name']); $i++) {
        //         // echo $selectedFiles['name'][$i] . "<br>";
        //         MProduct::addGallery($selectedFiles['name'][$i]);
        //         $target_file = $target_dir . $selectedFiles['name'][$i];
        //         move_uploaded_file($selectedFiles['tmp_name'][$i], $target_file);
        //     }
        // }



        // header('location:  Home.php');

        ?>

    </div>
</body>

</html>