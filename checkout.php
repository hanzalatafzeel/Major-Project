<?php
@include 'config.php';
@include 'event.php';

session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
$uid = $_SESSION['id'];
$sql = "SELECT `order_id`,`amount` from `order-list` where s_id = '$uid' && status = false";
$result = $db->query($sql);


if(isset($_POST['del'])){
    $it_id = $_POST['del'];
    $sql = "DELETE FROM `orders` WHERE item_id = '$it_id' && order_id = '$oid'";
    $result = $db->query($sql);
    if($result){
        unset($_POST['del']);
        header("location: checkout.php");

    }

}
$count = -1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheets/footer.css">
    <link rel="stylesheet" href="Stylesheets/style.css">
    <link rel="stylesheet" href="Stylesheets/checkout.css">
    <!--Bootstrap-css-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <!--Stylesheet-->
    <link rel="stylesheet" href="Stylesheets/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <script src="checkout.js" defer></script>
    <title>Home Page</title>
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
                    <a class="nav-link" id="signup" href="login.php" value="signup">sign Up</a>
                </li>
                <!-- login button -->
                <li class="nav-item">
                    <a class="nav-link" href="help.html">Help</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- checkout -->
    <div class="check">
        <?php if ($result->num_rows > 0) {
   
        $orders = $result->fetch_assoc();
    $oid = $orders['order_id'];
    $_SESSION['oid'] = $oid;
    $sql = "SELECT `item_id`,`qty`,`amount` from orders where order_id = '$oid'";
    $get = $db->query($sql);

?>
        <div class="check-container">
            <?php if ($get->num_rows > 0) {
                while ($list = $get->fetch_assoc()) {
                    $id = $list['item_id'];
                    $sql = "SELECT `name`,`price` from item where id='$id'";
                    $fetch = $db->query($sql);
                    $item = $fetch->fetch_assoc();

                    ?>
                    <div class="item">

                        <div class="item-box" id="itemName">
                            <?php echo $item['name'] ?>
                        </div>

                        <div class="item-box incre">
                            <button class="cart-btn" onclick="dec('<?php echo $id ?>')"><i class="fa fa-minus"
                                    aria-hidden="true"></i></button>
                            <input type="number" value="<?php echo $list['qty'] ?>" id="<?php echo $id ?>">
                            <button class="cart-btn" onclick="inc('<?php echo $id ?>')"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                        </div>

                        <div class="item-box" id="itemPrice">&#8377; </span><span id="<?php echo "tot" . $id; ?>">
                                <?php echo $list['amount']; ?>
                            </span><span id="<?php echo "bsc" . $id ?>" style="display:none">
                            <?php echo $item['price'] ?>
                        </div>
                        <div class="item-box" id="deleteItem">
                            <form action="" method="post">
                                <button class="deletebtn cart-btn" name="del" id="del" value="<?php echo $list['item_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </div>

                        <form action="set.php" method="post" style="display:none">
                            <input type="text" name="item" value="<?php echo $id ?>">
                            <input type="number" name="qty" value="" id="<?php echo "qty" . $id ?>">
                            <input type="submit" name="set" id="<?php echo "set" . $id; ?>" value="<?php echo $item['price'] ?>"
                                style="display:none">
                        </form>
                    </div>
                    <?php
                } ?>


                <hr>
                <div class="checkout">
                    <h4>Bill Details</h4>
                    <p>Item Total &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&#8377;
                        <?php echo $orders['amount'] ?>
                    </p>
                    <form action="payment.php" method="POST">
                    <button type="submit" class="checkout-btn box-btn" name="oid"  value="<?php echo $oid; ?>"><i class="fa fa-shopping-cart"
                            aria-hidden="true"></i>Proceed to checkout</button>
            </form>
                    <!-- <button href="payment.html" class="checkout-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Proceed to checkout</button> -->
                </div>
            <?php } ?>
                
            

        </div>
            <?php } else {?>
            <div class="check-container">
            <div class="emptymsg">
                    <h1>Oops! Your cart is empty !</h1>
                    <p>Looks like you haven't added anything to your cart yet</p>
                    <a href="index.php" class="box-btn">Go to Home</a>
                </div>
            </div>
            <?php } ?>
    </div>



    <!-- Footer -->

    <?php @include 'templates/footer.php'?>
    <script>
        function inc(id) {
            let quantity = document.getElementById(id);
            let idt = "tot" + id;
            let bst = "bsc" + id;
            let q = "qty" + id;
            let set = "set" + id;
            let amount = document.getElementById(idt);
            let basic = document.getElementById(bst);
            let qty = Number(quantity.value);
            let amt = Number(amount.innerHTML);
            let bsc = Number(basic.innerHTML);
            qty++;
            let tot = 0;
            if (qty >= 0) {
                tot = bsc * qty;
            }
            quantity.value = String(qty);
            amount.innerHTML = String(tot);
            basic.innerHTML = String(bsc);
            document.getElementById(q).value = String(qty);
            document.getElementById(set).click();

        }

        function dec(id) {
            let quantity = document.getElementById(id);
            let idt = "tot" + id;
            let bst = "bsc" + id;
            let q = "qty" + id;
            let set = "set" + id;
            let amount = document.getElementById(idt);
            let basic = document.getElementById(bst);
            let qty = Number(quantity.value);
            let amt = Number(amount.innerHTML);
            let bsc = Number(basic.innerHTML);
            let tot = 0;
            qty--;
            if (qty >= 0) {
                tot = bsc * qty;
            }
            else {
                qty = 0;
            }

            quantity.value = String(qty);
            amount.innerHTML = String(tot);
            basic.innerHTML = String(bsc);
            document.getElementById(q).value = String(qty);
            document.getElementById(set).click();

        }

    </script>

</body>

</html>
