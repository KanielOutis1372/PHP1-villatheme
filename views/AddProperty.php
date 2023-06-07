<?php
    include('../models/MProduct.php');

?>

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
                <form class="ui form">
                    <hr>
                    <div class="field">
                        <label for="skuId">TAGS</label>
                        <button class="ui button pull-right">&#10009;</button>
                        <div class="checkbox-group">
                            <!-- <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div> -->

                            <?php

                            $tags = MProduct::getAllTags();
                            foreach ($tags as $tag) {
                                echo '<div class="ui checkbox">
                                    <input type="checkbox" name="tag_' . $tag->getId() . '">
                                    <label>' . $tag->getTagName() . '</label>
                                </div>';
                            }
                            ?>
                        </div>

                    </div>

                    <hr>
                    <div class="field">
                        <label for="titleId">CATEGORIES</label>
                        <button class="ui button pull-right">&#10009;</button>
                        <div class="checkbox-group">
                            <!-- <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div> -->

                            <?php

                            $cates = MProduct::getAllCates();
                            foreach ($cates as $cate) {
                                echo '<div class="ui checkbox">
                                    <input type="checkbox" name="cate_' . $cate->getCateId() . '">
                                    <label>' . $cate->getCateName() . '</label>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>

                    <hr>
                    <div class="field">
                        <label for="gallariesId">GALLARIES</label>
                        <input type="file" id="gallariesId" name="gallaries" multiple>
                    </div>

                    <button class="ui button" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>