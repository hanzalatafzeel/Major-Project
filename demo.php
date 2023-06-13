<?php
require_once 'config.php';
session_start();
if(isset($_SESSION['logtype'])){
if(isset($_POST['submit'])){
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$cid = $_POST['c_id'];
  if (!empty($_FILES["imgf"]["name"])) {
    $filename = basename($_FILES["imgf"]["name"]);
    $filetype = pathinfo($filename, PATHINFO_EXTENSION);
    $allowtypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($filetype, $allowtypes)) {
      $imgi = $_FILES["imgf"]["tmp_name"];
      $imgf = addslashes(file_get_contents($imgi));
    }else{
 
      $statusMsg = "Sorry only specific files are allowed";
      }
  }else{
  $imgf_err = "Please select an gst file to upload";
      header("location:fileerr.html");
  }
  if (!empty($imgf)) {
    $sqli = "INSERT INTO `item` (`id`, `name`, `price`,`image`, `c_id` ) VALUES ('$id','$name','$price','" . $imgf . "','$cid')";
    $result = mysqli_query($db, $sqli);
    if ($result) {
      header("location:canteen_page.php");
    } else {
      header("location:simple.html");
    }
  }
}
}
echo "here";
?>
