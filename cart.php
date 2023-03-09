<?php
    @include 'config.php';
    @include 'rand.php';

    session_start();
   if(isset($_SESSION['id'])){

       if(isset($_POST['add'])){
           echo "1";
        $item = $_POST['add'];
        $s_id = $_SESSION['id'];
        $fetch = "SELECT `price` FROM `item` WHERE id = '$item' ";
        $get = $db->query($fetch);
        if(mysqli_num_rows($get) > 0){
            
            $data = mysqli_fetch_array($get);
            $fetch = "SELECT `order_id` FROM `order-list` WHERE s_id = '$s_id' && status = 0 ";
            $flag = $db->query($fetch);
            $price = $data['price'];
            if(mysqli_num_rows($flag) > 0){
                $code = mysqli_fetch_array($flag);
                $o_id = $code['order_id'];
                $load = "INSERT INTO `orders` (`order_id`,`item_id`,`qty`,`amount`) VALUE ('$o_id','$item','1','$price')";
                try{
                    $db->query($load);
                }
                finally{
                    header('location: index.php');
                }
                $update = "UPDATE `order-list` SET amount = (SELECT SUM(amount) FROM orders WHERE order_id = '$o_id') WHERE order_id = '$o_id' ";
                try{
                   
                        if($db->query($update)){
                            header('location: index.php');
                         

                        }
                }
                finally{
                    header('location: index.php');
                }
            
            }
            else{
                $id = generateRandomString(6);
                $add = "INSERT INTO `order-list` (`order_id`,`s_id`,`amount`,`status`) VALUE ('$id','$s_id','$price',false)";
                $load = "INSERT INTO `orders` (`order_id`,`item_id`,`qty`,`amount`) VALUE ('$id','$item',1,'$price')";
                $add = $db->query($add);
                $load = $db->query($load); 
                if($add && $load){
                    header('location: index.php');
                }
            }
            
            
            
        }
    }
}
else{
    header('location: index.php');
}
?>