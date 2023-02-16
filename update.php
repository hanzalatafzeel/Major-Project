<?php
@include 'config.php';

if(isset($_POST['update'])){
    $id = $_POST['update'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $sql= "UPDATE `student` SET  name='$name',contact='$contact',email='$email' WHERE id='$id'";
    $return = $db->query($sql);
    if($return){
        header("location: profile.php");
    }
}
?>
