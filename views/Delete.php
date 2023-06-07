<?php 
    include_once '../models/MProduct.php';
    if(!empty($_GET)) {
        MProduct::delete($_GET['id']);
    }
    header('location: ../Home.php');
?>