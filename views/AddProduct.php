<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css">
    <script src="./lib/Semantic-UI-CSS-master/semantic.min.js"></script>
    <link rel="stylesheet" href="./styles.css">
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
                    <!-- <div class="field">
                        <label for="modifieddateId">MODIFIED DATE</label>
                        <input type="date" id="modifieddateId" name="modifieddate">
                    </div> -->
                    <button class="ui button" type="submit" name="submit">Add</button>
                </form>
            </div>
        </div>

        <?php
        include_once '../models/Product.php';
        include_once '../models/MProduct.php';
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

            header('location: Home.php');
        }

        ?>

    </div>
</body>

</html>