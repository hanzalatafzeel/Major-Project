<?php
@include 'config.php';

@include 'rand.php';

session_start();

$sql = "SELECT `id`,`name`,`price`,`c_id`  FROM `item` ";
$result = $db->query($sql);
$count = -1;
$id = $get['name'] = $get['amount'] = $get['id'] = "";
$ro = "";
if(isset($_POST['pay'])){
    if($_POST['pay'] !== $id || $_POST['pay'] === "" ){
        $id = $_POST['id'];
       $sql =  "SELECT `student`.`name`,`order-list`.`amount`,`order-list`.`order_id` as `id` FROM `order-list` INNER JOIN `student` ON `student`.`id` = `order-list`.`s_id` WHERE s_id = '$id' && `order-list`.`pay_id` IS NULL ORDER BY `order-list`.`amount` asc LIMIT 1";
       $result = $db->query($sql);
       if($result->num_rows == 1){
        $get = $result->fetch_assoc();
        $ro = "readonly";
        $get['amount']*=1.05;
        unset($_POST['pay']);
       }
    
    }
    
}

if(isset($_POST['oid']) && $_POST['oid'] !== ""){
    $oid = $_POST['oid'];
    $id = generateRandomString(10);
        $sql = "UPDATE `order-list` SET pay_id = '$id' where order_id = '$oid' ";
        $set = $db->query($sql);
        if($set){
            header("location: index.php");
            $date = date("Y-m-d");
            $time = date("h:m");
            $amount = $_POST['amt'];
            $sql = "INSERT INTO `payment`(`id`, `mode`, `amount`, `date`, `time`) VALUES ('$id','PAC','$amount','$date','$time')";
            $set = $db->query($sql);
            if($set){
                $sql = "INSERT `order-stack` (`order_id`) VALUES ('$oid')";
                $set = $db->query($sql);
                header("location: canteen_pac.php");
            }
        }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap-css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <!--Stylesheet-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Stylesheets/footer.css">
    <link rel="stylesheet" href="Stylesheets/navbar.css">

    <link rel="stylesheet" href="Stylesheets/canteen_page.css">
    <!--font-icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Bootstrap-js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

    <!-- font poppins -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
    </style>

    <title>Canteen PAC</title>

</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand pageName" href="index.php"><span class="yellow">C</span>ampus<span
                class="yellow">C</span>rave </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAvbar buttons collapsable when the screen size is reduced -->
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav ms-auto">
                <!-- Contact button -->
                <li class="nav-item">
                    <a class="nav-link" href="#footer">Contact</a>
                </li>
                <!-- about button -->
                <li class="nav-item">
                    <a class="nav-link" id="signup" href="#signup" value="signup">sign Up</a>
                </li>
                <!-- login button -->
                <li class="nav-item">
                    <a class="nav-link" href="help.html">Help</a>
                </li>
                <!-- Order -->
                <li class="nav-item">
                    <a class="nav-link" href="canteen_order.php">Order</a>
                </li>
            </ul>
        </div>
    </nav>

    <div>

    </div>

    <!-- itemlsit -->
    <div class="middle">
        <div class="paycard" id="">

        <form action="" class="payform" method="post" enctype="plain/text">
                <input type="text" placeholder="Student Id" name="id" value="<?php echo $id;?>" onchange="check()" ><br>
                <input type="password" placeholder="Order Id" id="oid" name="oid" value="<?php echo $get['id'];?>" <?php echo $ro ?>>
                <br>
                <input type="text" placeholder="name" value="<?php echo $get['name'];?>" <?php echo $ro ?>>
                
                <input type="number" placeholder="Amount To Pay" name="amt" id="amt"value="<?php echo $get['amount'];?>" <?php echo $ro ?>>
                
                <button class="qsubmit" name="pay" id="pay" value="<?php echo $id;?>" >Make Paid</button>
            </form>

            <script>
                function check(){
                    document.getElementById('pay').click();
                }
                </script>

        </div>
    </div>



    <!-- <div class="paycard">
        
        <div class="form-popup-pac " id="myForm">
            
            <form action="" class="itemform" method="post" enctype="plain/text">
                <input type="text" placeholder="Student Id" name="id" value="<?php echo $id;?>" onchange="check()" ><br>
                <input type="password" placeholder="Order Id" id="oid" name="oid" value="<?php echo $get['id'];?>" <?php echo $ro ?>>
                <br>
                <input type="text" placeholder="name" value="<?php echo $get['name'];?>" <?php echo $ro ?>>
                
                <input type="number" placeholder="Amount To Pay" name="amt" id="amt"value="<?php echo $get['amount'];?>" <?php echo $ro ?>>
                
                <button class="qsubmit" name="pay" id="pay" value="<?php echo $id;?>" >Make Paid</button>
            </form>

            <script>
                function check(){
                    document.getElementById('pay').click();
                }
                </script>
        </div>        

    </div> -->

    

    <!-- Footer -->

    <?php @include 'templates/footer.php'?>
    


</body>

</html>