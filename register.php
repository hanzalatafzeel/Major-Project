<?php
require_once 'config.php';


if(isset($_POST['submit'])){
    // if($_POST['submit'] == 'register' && $_POST['type'] != 'null'){
        $type = $_POST['type'];
        $id = $_POST[$type];
        $name = $_POST['name'];
        $number = $_POST['phone'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $sql = "INSERT INTO `$type` (`id`,`name`,`email`,`contact`,`password`) VALUE ('$id','$name','$email','$number','$pass')";
        $insert = $db->query($sql);
        if($insert){
            if($_POST['type'] == 'admin'){
                header("location:admin.html");
            }
            else if($_POST['type'] == 'canteen'){
                header("location:admin.html");
            }
            else{
                header("location:index.html");
            }
        }
        
    // }
}

?>