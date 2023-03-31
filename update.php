<?php


if(isset($_POST['update'])){

    if($_POST['update'] === "profile"){
        profile($_POST);
    }

    if($_POST['update'] === "item"){
        echo "item";
        item($_POST);
    }
}


function profile($profile){
    @include 'config.php';
    $id = $profile['update'];
    $name = $profile['name'];
    $contact = $profile['contact'];
    $email = $profile['email'];

    $sql= "UPDATE `student` SET  name='$name',contact='$contact',email='$email' WHERE id='$id'";
    $return = $db->query($sql);
    if($return){
        header("location: profile.php");
    }
}

function item($item){
    @include 'config.php';

    $id = $item['id'];
    $price = $item['price'];
    $category = $item['category'];
    $sql = "UPDATE `item` SET category = '$category', price='$price' WHERE id='$id'";
    $return = $db->query($sql);
    if($return){
        header("location: canteen_page.php");
    }

}
?>
