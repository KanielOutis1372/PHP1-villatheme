<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../lib/Semantic-UI-CSS-master/semantic.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="ui equal width grid">
        <div class="row">
            <div class="column">
                <h1>ADD NEW PROPERTY</h1>
            </div>
            <div class="column">
                <a href="Home.php">
                    <button class="ui primary button pull-right">Cancel</button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <form class="ui form" method="POST" enctype="multipart/form-data">
                    <hr>
                    <div class="field">
                        <label for="skuId">TAGS</label>
                        <input type="text" id="skuId" name="tagName" placeholder="Tags...">
                    </div>

                    <hr>
                    <div class="field">
                        <label for="titleId">CATEGORIES</label>
                        <input type="text" id="skuId" name="categoryName" placeholder="Categories...">
                    </div>

                    <button class="ui button" type="submit" name="submit">Add</button>
                </form>

                <?php
                include_once('../models/MProduct.php');
                if (isset($_POST['submit'])) {
                    MProduct::addNewTag(trim($_POST['tagName']));
                    MProduct::addNewCategory(trim($_POST['categoryName']));
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>