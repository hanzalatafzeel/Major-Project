<?php 
@include 'config.php';
session_start();




if(isset($_SESSION['oid'])){
    if(isset($_POST['set'])){
        $oid = $_SESSION['oid'];
        $price = $_POST['set'];
        $qty = $_POST['qty'];
        $item = $_POST['item'];
        echo $oid;
        echo "||";
        echo $price;
        echo "||";
        echo $qty;
        $price = $price*$qty;
        echo "||";
        echo $price;
        $sql = "UPDATE `orders` SET qty = '$qty' , amount = '$price' WHERE order_id = '$oid' && item_id = '$item'";
        if($db->query($sql)){
            echo $sql;
            $update = "UPDATE `order-list` SET amount = (SELECT SUM(amount) FROM orders WHERE order_id = '$oid') WHERE order_id = '$oid' ";
            try{
               
                    if($db->query($update)){
                        header('location: checkout.php');
                        
                     

                    }
            }
            finally{
                header('location: checkout.php');
            }
        }
    }
}
?>