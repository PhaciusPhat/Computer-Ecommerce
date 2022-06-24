<?php
session_start();
include('./models/Category.php');
$id = $_GET['id'];
// $name = $_POST['name'];
$_SESSION['update_cate_id'] = $id;
// $_SESSION['update_cate_name'] = $name;
echo $id;
?>


