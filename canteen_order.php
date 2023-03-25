<?php


session_start();

function get(){
    @include 'config.php';
    $sql = "SELECT `order-list`.`order_id`,`order-list`.`time`,`order-list`.`amount` FROM `order-list` INNER JOIN `order-stack` ON `order-list`.`order_id` = `order-stack`.`order_id` order by `order-stack`.`log` desc";
    $result = $db->query($sql);
return $result;
}

function view($oid){
    @include 'config.php';
$sql = "SELECT `orders`.`qty`, `item`.`name` FROM orders INNER join item ON `orders`.`item_id` = `item`.`id` where order_id = '$oid'";
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

    <title>Canteen Page</title>

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

                <!-- login button -->
                <li class="nav-item">
                    <a class="nav-link" href="canteen_page.php">Items</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- itemlsit -->
    <div class="middle">
        <div class="item-list" id="orderlist">
                <?php $result = get();
                if ($result->num_rows > 0){?>
            <table>
                <tr>
                    <th>Order Id</th>
                    <th>Amount</th>
                    <th>Time</th>
                   
                    <th>View Order</th>
                    
                </tr>
                <?php while ($row = $result->fetch_assoc()) {?>
                <tr>
                    <td><?php echo $row['order_id'];?></td>
                    <td><?php echo $row['amount'];?></td>
                    <td><?php echo $row['time'];?></td>
                   
                    
                    <td><button  onclick="vieworder('<?php echo $row['order_id'];?>')">View</button></td>
                    
                </tr>
                <?php } ?>
            </table>
            <?php } else{?>

            <h4>No Order &#9785;</h4>
            <?php }?>
           
        </div>


    </div>
    <?php 
     $result = get();
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
           
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
                    <form action="" method="post">

                        <button class="order-ready" name="mrk">Mark as Ready</button>
                    </form>
            </div>
        </div>
        <?php
        }
    }
    
    ?>

<button class="open-button" onclick="refresh()"><i class="fa fa-refresh" aria-hidden="true"></i></button>


    <!-- Footer -->

    <?php @include 'templates/footer.php'?>
    <script>
         
        function refresh(){
            location.reload();
        }
        function vieworder(id) {
            document.getElementById(id).style.display="block";

            clearTimeout(myTimeout);

        }
        function closeorder(id) {
            document.getElementById(id).style.display="none";
            refresh();
        }

        
    </script>


</body>

</html>