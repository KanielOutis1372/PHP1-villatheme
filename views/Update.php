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
                <h1>UPDATE PRODUCT</h1>
            </div>
            <div class="column">
                <button class="ui primary button pull-right">Cancel</button>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <form class="ui form">
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
                        <label>FEAETURED IMAGE</label>
                        <input type="image" name="featuredimg">
                    </div>

                    <div class="field">
                        <label>GALLARIES</label>
                        <input type="image" name="featuredimg">
                        <input type="image" name="featuredimg">
                        <input type="image" name="featuredimg">
                    </div>
                    <div class="field">
                        <label for="descId">DESCRIPTION</label>
                        <textarea name="desc" id="descId" cols="30" rows="10"></textarea>
                    </div>

                    <div class="field">
                        <label for="skuId">TAGS</label>
                        <button class="ui button pull-right">&#10009;</button>
                        <div class="checkbox-group">
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>

                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>

                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>

                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
                        </div>

                        
                    </div>

                    <hr>
                    <div class="field">
                        <label for="titleId">CATEGORIES</label>
                        <button class="ui button pull-right">&#10009;</button>
                        <div class="checkbox-group">
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>

                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>

                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
    
                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>

                            <div class="ui checkbox">
                                <input type="checkbox" name="example">
                                <label>Make my profile visible</label>
                            </div>
                        </div>
                    </div>


                    <div class="field">
                        <label for="createddateId">CREADTED DATE</label>
                        <input type="date" id="createddateId" name="createddate">
                    </div>
                    <div class="field">
                        <label for="modifieddateId">MODIFIED DATE</label>
                        <input type="date" id="modifieddateId" name="modifieddate">
                    </div>
                    
                    
                    <button class="ui button" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>