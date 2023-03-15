<?php
@include 'config.php';

session_start();

if(isset($_POST['srch'])){
    $search = $_POST['srch']; 
    $srch = '%'.$_POST['srch'].'%';
    $sql = "SELECT `id`,`name`,`price`, `image`  FROM `item` WHERE `name` LIKE '$srch'";
    $result = $db->query($sql);
    $text = 'Search Result for '. '"'.$search.'"';

    
}
else{
    $sql = "SELECT `id`,`name`,`price`, `image`  FROM `item` ";
    $result = $db->query($sql);
    $text = 'Top Recommended Dishes';
}


$count = -1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="style.css">
    
    <!--Bootstrap-css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="navbar.css">
    <!--Stylesheet-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sono&display=swap');
    </style>

    <title>Home Page</title>
</head>

<body>

    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand pageName" href="index.php"><span class="yellow">C</span>ampus<span
                class="yellow">C</span>rave </a>
        <!-- <img src="img/campuscrave.png" alt="" width="80"> -->
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
                <?php if (isset($_SESSION['logged'])) { ?>
                    <li class="nav-item">
                        <!-- <a class="nav-link" id="signup" href="login.html" value="signup">sign Up</a> -->
                        <a class="nav-link" href="logout.php" value="LogOut">LogOut</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="help.html">Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" value="Login">Login</a>
                    </li>
                <?php } ?>
            </ul>
            <!-- login button -->
        </div>
    </nav>


    <div class="logo">
        <img src="img/campuscrave.png" alt="" width="450">

        <form action="" method="post" >
            <div class="search">
                <input type="search" name="srch" id="srch" class="searchTerm" placeholder="What are you looking for?">
                <button class="fa fa-search searchButton"></button>
            </div>
        </form>
        <script>
            if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
            </script>
    </div>
    <?php
    // Include Hero-carousel
    include('_hero-carousel.php');
    ?>



    <div class="containers">
        <div class="sidebar">
            <h3>Categories</h3>
            <hr style="height:3px;border-width:0;width:55%;background-color:crimson">
            <form action="#">
                <label for="fastfood">Meal</label>
                <input type="checkbox" name="fastfood" id="fastfood"> <br>
                <label for="fastfood">Fast Food</label>
                <input type="checkbox" name="fastfood" id="fastfood"><br>
                <label for="fastfood">Snacks</label>
                <input type="checkbox" name="fastfood" id="fastfood"><br>
                <label for="fastfood">Deserts</label>
                <input type="checkbox" name="fastfood" id="fastfood"><br>
                <label for="fastfood">Beverages</label>
                <input type="checkbox" name="fastfood" id="fastfood">

            </form>
        </div>

        <?php if ($result->num_rows > 0) { ?>
            <div class="main">
                <div class="first">
                    <h3><?php echo $text ?></h3>
                </div>

                <?php while ($row = $result->fetch_assoc()) {
                    $count++; ?>
                    <div class="box">
                        <div class="image">

                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="">
                        </div>

                        <div class="namePrice">
                            <div class="name">
                                <?php echo $row['name'] ?>
                                <span class="right">
                                    &#8377;
                                    <?php echo $row['price']; ?>
                                </span>

                            </div>
                            <div class="price">
                                <button class="box-btn">Buy Now</button>
                                <form action="cart.php" method="POST">
                                    <button type="submit" name="add" class="box-btn" value="<?php echo $row['id']; ?>">Add
                                        to Cart</button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php } ?>


            </div>
        <?php } ?>
    </div>


    <!-- </div> -->

    <!-- Footer -->

    <footer class="footer-distributed" id="footer">

        <div class="footer-left">
            <img src="img/campuscrave.png" alt="" width="300">
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
            <p class="footer-links">
                <a href="#" class="link-1">Home</a>

                <!-- <a href="#">Blog</a> -->

                <a href="#">Pricing</a>

                <a href="#">About</a>

                <a href="#">Faq</a>

                <a href="#">Contact</a>
            </p>

        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>About the Canteen</span>
                We understand that university life can be busy and stressful, and that finding time to get a good meal
                can be a challenge. That's why we created this website to make it easier for you to order and enjoy
                delicious food without the hassle of waiting in long lines or worrying about running out of time between
                classes.
            </p>

            <div class="footer-icons">

                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>

            </div>

        </div>
        <script src="cart.js"></script>
        <?php if (isset($_SESSION['logged'])) { ?>
            <div id="work"></div>
        <?php } ?>


    </footer>

</body>

</html>