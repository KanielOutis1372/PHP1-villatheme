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
                                <input required type="text" id="skuId" name="sku" placeholder="SKU..." value="<?php echo MProduct::getProductByID($_GET['id'])->getSku() ?>">
                            </div>
                            <div class="field">
                                <label for="titleId">TITLE</label>
                                <input required type="text" id="titleId" name="title" placeholder="title..." value="<?php echo MProduct::getProductByID($_GET['id'])->getTitle() ?>">
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label for="priceId">PRICE</label>
                                <input required type="number" id="priceId" name="price" placeholder="price..." value="<?php echo MProduct::getProductByID($_GET['id'])->getPrice() ?>">
                            </div>
                            <div class="field">
                                <label for="salepriceId">SALE PRICE</label>
                                <input required type="number" id="salepriceId" name="sale-price" placeholder="sale price..." value="<?php echo MProduct::getProductByID($_GET['id'])->getSalePrice() ?>">
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label for="featuredimgId">FEAETURED IMAGE</label>
                                <input type="file" id="featuredimgId" name="featuredimg" value="<?php echo MProduct::getProductByID($_GET['id'])->getFeaturedImage() ?>">
                                <div class="ui small images list-g">
                                    <?php
                                    $featImg = MProduct::getProductByID($_GET['id'])->getFeaturedImage();
                                    echo '<img class="update-img" src="' . '../img/' . $featImg . '">';
                                    ?>
                                </div>

                            </div>
                            <div class="field">
                                <label for="gallariesId">GALLARIES</label>
                                <input type="file" id="gallariesId" name="galleries[]" multiple>
                                <div class="ui small images list-g">
                                    <?php
                                    $galleryArr = explode(',', MProduct::getProductByID($_GET['id'])->getGallery());
                                    foreach ($galleryArr as $gallery) {
                                        echo '<img class="update-img" src="' . '../img/' . $gallery . '">';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>TAGS</label>
                                <select required multiple="" class="ui dropdown" name="mySelectTag[]">
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

                                <select required multiple="" class="ui dropdown" name="mySelectCate[]">
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
                            <textarea required name="desc" id="descId" cols="30" rows="10"><?php echo MProduct::getProductByID($_GET['id'])->getDescription() ?></textarea>
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
        $productIdUpdated = $_GET['id'];

        $product = new Product();
        if (isset($_POST['submit']) && isset($_FILES['featuredimg'])) {
            $product->setSku((preg_replace('/\s+/', '', trim($_POST["sku"]))));
            $product->setTitle(preg_replace('/\s+/', ' ', trim($_POST["title"])));
            $product->setPrice($_POST["price"]);
            $product->setSalePrice($_POST["sale-price"]);
            if (empty($_FILES["featuredimg"]['name'])) {
                $product->setFeaturedImage(trim(MProduct::getProductByID($_GET['id'])->getFeaturedImage()));
            } else {
                $product->setFeaturedImage(trim($_FILES["featuredimg"]['name']));
            }
            $product->setDescription(preg_replace('/\s+/', ' ', trim($_POST["desc"])));
            $product->setModifiedDate(date('Y-m-d'));
            MProduct::updateProduct($productIdUpdated, $product);

            //upload file
            $target_dir = "../img/";
            $target_file = $target_dir . basename($_FILES["featuredimg"]["name"]);
            move_uploaded_file($_FILES["featuredimg"]["tmp_name"], $target_file);


            $selectedOptionTag = $_POST["mySelectTag"];
            foreach ($selectedOptionTag as $tag) {
                MProduct::updateProductTags($productIdUpdated, MProduct::getIdFromTag($tag));
            }

            $selectedOptionCate = $_POST["mySelectCate"];
            foreach ($selectedOptionCate as $cate) {
                MProduct::updateProductCategories($productIdUpdated, MProduct::getIdFromCate($cate));
            }

            // print_r($_FILES['gallery']);
            
            // for ($i = 0; $i < count($selectedFiles['name']); $i++) {
            //     MProduct::updateGallery($selectedFiles['name'][$i], $productIdUpdated);
            //     $target_file = $target_dir . $selectedFiles['name'][$i];
            //     move_uploaded_file($selectedFiles['tmp_name'][$i], $target_file);
            // }

            //error - not fixed
            if (isset($_FILES['galleries']['name']) ) {
                // Có file được chọn, thực hiện cập nhật sản phẩm
                // Các bước xử lý cập nhật sản phẩm ở đây
                echo "Cập nhật sản phẩm thành công.";
                print_r($_FILES['galleries']['name']);
            } else {
                // Không có file nào được chọn, bỏ qua cập nhật sản phẩm
                echo "Không có file nào được chọn.";
            }

        }
        ?>
    </div>
</body>

</html>