<?php
  include_once('../models/MProduct.php');
?>

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

  <?php
    $arrProduct = MProduct::getAllProduct();
  ?>
  <div class="ui equal width grid">
    <div class="row">
      <div class="column">
        <a href="AddProduct2.php"><button class="ui primary button">Add product</button></a>
        <a href="AddProperty.php"><button class="ui button">Add property</button></a>
        <a href="#"><button class="ui button">Sync from VillaTheme</button></a>
      </div>
      <div class="column">
        <div class="ui icon input">
          <input type="text" placeholder="Search...">
          <i class="inverted circular search link icon"></i>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="column">
        <div class="ui compact menu">
          <div class="ui simple dropdown item">
            Date
            <i class="dropdown icon"></i>
            <div class="menu">
              <?php
                foreach ($arrProduct as $value) {
                  echo '<div class="item">'. $value->getCreatedDate() .'</div>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui compact menu">
          <div class="ui simple dropdown item">
            ASC
            <i class="dropdown icon"></i>
            <div class="menu">
              <div class="item">Increase</div>
              <div class="item">Decrease</div>
            </div>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui compact menu">
          <div class="ui simple dropdown item">
            Category
            <i class="dropdown icon"></i>
            <div class="menu">
              <?php
                
                foreach (MProduct::getAllCates() as $value) {
                  echo '<div class="item">'. $value->getCateName() .'</div>';
                }
              ?>
              
            </div>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui compact menu">
          <div class="ui simple dropdown item">
            Select tag
            <i class="dropdown icon"></i>
            <div class="menu">
            <?php
                foreach (MProduct::getAllTags() as $value) {
                  echo '<div class="item">'. $value->getTagName() .'</div>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui calendar" id="standard_calendar">
          <div class="ui fluid input">
            <input type="date" id="birthday" name="birthday">
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui calendar" id="standard_calendar">
          <div class="ui fluid input">
            <input type="date" id="birthday" name="birthday">
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui input">
          <input type="number" placeholder="Price from">
        </div>
      </div>

      <div class="column">
        <div class="ui input">
          <input type="number" placeholder="Price to">
        </div>
      </div>

      <div class="column">
        <button class="ui button">Filter</button>
      </div>
    </div>
  </div>

  <table class="ui celled table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Product name</th>
        <th>SKU</th>
        <th>Price</th>
        <th>Feature Image</th>
        <th>Gallery</th>
        <th>Categories</th>
        <th>Tags</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($arrProduct as $value) {
      ?>
        <tr>
          <td><?php echo $value->getCreatedDate() ?></td>
          <td><?php echo $value->getSku() ?></td>
          <td><?php echo $value->getTitle() ?></td>
          <td><?php echo '&#36;' . $value->getPrice() ?></td>
          <td><?php echo '<img width="80px" src="' . '../img/' . $value->getFeaturedImage() . '">' ?></td>
          <td>
            <?php
            $galleryArr = explode(',', $value->getGallery());
            foreach ($galleryArr as $gallery) {
              echo '<img width="80px" src="' . '../img/' . $gallery . '">';
            }
            ?>
          </td>
          <td><?php echo $value->getCategory() ?></td>
          <td><?php echo $value->getTag() ?></td>
          <td>
            <a href="Update2.php?id=<?php echo $value->getId() ?>"><i class="edit icon"></i></a>
            <a href="Delete.php?id=<?php echo $value->getId() ?>"><i class="trash icon"></i></a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

  <div class="center">
    <div class="pagination">
      <a href="#">&laquo;</a>
      <a href="#">1</a>
      <a href="#" class="active">2</a>
      <a href="#">3</a>
      <a href="#">&raquo;</a>
    </div>
  </div>
</body>

</html>