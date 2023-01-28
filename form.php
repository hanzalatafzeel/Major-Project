<?php
require_once 'config.php';

session_start();

if(isset($_POST['submit'])){
    if($_POST['submit'] == 'register' && $_POST['type'] != 'null'){
        $type = $_POST['type'];
        $id = $_POST[$who];
        $name = $_POST['name'];
        $number = $_POST['phone'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $sql = "INSERT INTO `$who` (`id`,`name`,`email`,`contact`,`password`) VALUE ('$id','$name','$email','$number','$pass')";
        $insert = $db->query($sql);
        if($insert){
            if($_POST['type'] == 'admin'){
                // header("location:admin.html");
            }
            else if($_POST['type'] == 'canteen'){
                // header("location:admin.html");
            }
            else{
                // header("location:index.html");
            }
        }
    }
    else if($_POST['submit'] == 'login'){
        $who = $_POST['who'];
        // $id = $_POST[$_POST['who']];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $sql = "SELECT `id`,`name`,`contact` FROM `$who` WHERE email = '$email' && password = '$pass'";
        $result = $db->query($sql);
        // if($insert){
        // header("location:index.html");
        // }
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_array($result);
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['mobile'] = $row['mobile'];
            $_SESSION['uname'] = $uname;
            header('location:index.php');
    
        } 
    }
    else{
        header("location:login.html"); 
    }    



}
echo "location:http://". $_SERVER['SERVER_NAME'];
header("location:index.html");


?>