<?php


session_start();

function get(){
    @include 'config.php';
    $sql = "SELECT `order_id`,`time`,`amount`,`paid`  FROM `order-list` where status = true ";
$result = $db->query($sql);
return $result;
}

function view($oid){
    @include 'config.php';
$sql = "SELECT `orders`.`qty`, `item`.`name` FROM orders INNER join item ON `orders`.`item_id` = `item`.`id` where order_id = '$oid' ";
$result = $db->query($sql);
if ($result->num_rows > 0)
    return $result;

}
$count = -1;
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
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="navbar.css">

    <link rel="stylesheet" href="canteen_page.css">
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

    <title>Canteen Page</title>

</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand pageName" href="index.html">Canteen</a>
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
            </ul>
        </div>
    </nav>

    <!-- itemlsit -->
    <div class="middle">
        <div class="item-list">
                <?php $result = get();
                if ($result->num_rows > 0){?>
            <table>
                <tr>
                    <th>Order Id</th>
                    <th>Amount</th>
                    <th>Time</th>
                    <th>Payment status</th>
                    <th>View Order</th>
                    
                </tr>
                <?php while ($row = $result->fetch_assoc()) {?>
                <tr>
                    <td><?php echo $row['order_id'];?></td>
                    <td><?php echo $row['amount'];?></td>
                    <td><?php echo $row['time'];?></td>
                    <?php if($row['paid']){?>
                    <td>paid</td>
                    <td><button  onclick="vieworder('<?php echo $row['order_id'];?>')">View</button></td>
                    <?php }else{?>
                        <td>Not Paid</td>
                        <td></td>
                        <?php } ?>
                </tr>
                <?php } ?>
            </table>
            <?php } ?>
            

           
        </div>


    </div>
    <?php 
     $result = get();
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if($row['paid']){
                $get = view($row['order_id']);

        ?>
        <div class="order-box" id="<?php echo $row['order_id'];?>">
            <div class="content" id="unblurred" >
                <button class="close-btn" onclick="closeorder('<?php echo $row['order_id'];?>')"><i class="fa fa-close"></i></button>

                <h2>Order Details</h2>
                <table id="order-table">
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        
                    </tr>
                <?php while($list = $get->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $list['name'];?></td>
                        <td><?php echo $list['qty'];?></td>
                    </tr>
                    <?php } ?>
                </table>

                <button class="order-ready" >Mark as Ready</button>
            </div>
        </div>
        <?php
        }
    }
    }
    ?>

       


    <!-- Footer -->

    <footer class="footer-distributed" id="footer">

        <div class="footer-left">

            <h3>Canteen<span>logo</span></h3>

            <p class="footer-links">
                <a href="#" class="link-1">Home</a>

                <!-- <a href="#">Blog</a> -->

                <a href="#">Pricing</a>

                <a href="#">About</a>

                <a href="#">Faq</a>

                <a href="#">Contact</a>
            </p>

            <p class="footer-company-name">Canteen Management system © 2022</p>
        </div>

        <div class="footer-center">

            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Jamia Millia Islamia</span> Jamia Nagar, New Delhi</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>Mob: 6203756460</p>
            </div>

            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:support@company.com">support@company.com</a></p>
            </div>

        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>About the Canteen</span>
                Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus
                vehicula sit amet.
            </p>

            <div class="footer-icons">

                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>

            </div>

        </div>
        

    </footer>
    <script>
        function vieworder(id) {
            document.getElementById(id).style.display="block";
        }
        function closeorder(id) {
            document.getElementById(id).style.display="none";
        }

        
    </script>


</body>

</html>