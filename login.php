<?php
require_once 'config.php';

if(isset($_POST['submit'])){
    // if($_POST['submit'] == 'login'){
        $who = $_POST['who'];
        // $id = $_POST[$_POST['who']];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $sql = "SELECT `id`,`name`,`contact` FROM `$who` WHERE email = '$email' && password = '$pass'";
        $insert = $db->query($sql);
        if($insert){
        header("location:index.html");
        }
    // }
    // else{
    //     header("location:login.html"); 
    // }    
}
?>