<?php
require_once 'config.php';

require_once 'session.php';

if(isset($_POST['register-s'])){
    if($_POST['type'] != 'null'){
        $type = $_POST['type'];
        $id = $_POST[$_POST['type']];
        echo $id;
        $name = $_POST['name'];
        $number = $_POST['phone'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $sql = "INSERT INTO `$type` (`id`,`name`,`email`,`contact`,`password`) VALUE ('$id','$name','$email','$number','$pass')";
       try {
        $insert = $db->query($sql);
       } catch (Throwable $th) {
        $_SESSION['regerr'] = true;
        header("location:login.php");
       }
        if($insert){
            // $_SESSION['regerr'] = false;
            // if($_POST['type'] == 'admin'){
            //     header("location:admin.html");
            // }
            // else if($_POST['type'] == 'canteen'){
            //     echo $id;
            //     header("location:canteen.html");
            // }
            // else{
            //     header("location:index.php");
            // }
            // header("location:login.php");
        }
    }
    else{
        $_SESSION['regerr'] = true;
        header("location:login.php");
    }
}
if(isset($_POST['login-s'])){
    if($_POST['who'] != 'null'){
        $who = $_POST['who'];
        // $id = $_POST[$_POST['who']];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $sql = "SELECT `id`,`name`,`contact` FROM `$who` WHERE email = '$email' && password = '$pass'";

        try {
            $result = $db->query($sql);
        } catch (Throwable $th) {
            $_SESSION['logerr'] = true;
            header('location:login.php');
        }
        // if($insert){
        // header("location:index.html");
        // }
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_array($result);
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $row['name'];
            $_SESSION['contact'] = $row['contact'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $email;
            $_SESSION['logtype'] = $who;
            if($who == 'student'){
                header('location: ./');
            }
            else if($who == 'canteen'){
                header('location: canteen_page.php');
            }
            else if($who == 'student'){
                header('location: index.php');
            }
        }
    }
    
}
else{
// echo "location:http://". $_SERVER['SERVER_NAME'];
// header("location:index.html");

    $_SESSION['regerr'] = false;
    $_SESSION['logged'] = false;
    header("location:login.php");
} 
?>