<!-- <?php 
@include 'config.php';

session_start();
$id =$_SESSION['id'];
$sql = "SELECT `name`,`email`, `contact`  FROM `student` where id = '$id' ";
$result = $db->query($sql);
$count = -1;
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="style.css">
    <!--Bootstrap-css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <!--Stylesheet-->
    <link rel="stylesheet" href="navbar.css">
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

    <title>Profile</title>
</head>

<body>

    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand pageName" href="index.html"><span class="yellow">Can</span>teen</a>
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
                <?php if(isset($_SESSION['logged'])){?>
                <li class="nav-item">
                    <!-- <a class="nav-link" id="signup" href="login.html" value="signup">sign Up</a> -->
                    <a class="nav-link" href="logout.php" value="LogOut">LogOut</a>
                </li>
                <?php }else{?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" value="Login">Login</a>
                </li>
                <?php }?>
                <!-- login button -->
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help.html">Help</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- profile section  -->
    <section class="user-details">

        <div class="user">
        <?php if($result->num_rows>0){
            $list = $result->fetch_assoc();
            ?>
            
            
            <div class="profile">

                <img src="user-icon.png" alt="" width="100px">
                <br>
                <br>
                <p><i class="fas fa-user"></i><span><span><?php echo $list['name'];?></span></span></p>
                <p><i class="fas fa-phone"></i><span> <?php echo $list['contact'];?></span></p>
                <p><i class="fas fa-envelope"></i><span><?php echo $list['email'];?></span></p>
                <button class="box-btn" onclick="openForm()"> Update Info</button>
            </div>
            <?php }?>
        </div>
    </section>
    <!-- popup edit -->
    <div class="form-popup formd " id="myForm">
        <form action="update.php" class="update-form" method="POST">
            <button class="cancel"><i class="fa fa-times" aria-hidden="true" onclick="closeForm()"></i></button>
            <input type="text" name="name" placeholder="Name" value="<?php echo $list['name'];?>">
            <br>
            <input type="number" name="contact" placeholder="Phone Number" value="<?php echo $list['contact'];?>">
            <input type="email" name="email" placeholder="Email" value="<?php echo $list['email'];?>">
            <button type="submit" class="u-submit" name="update" value="<?php echo $id; ?>">Update Now</button>
        </form>
    </div>


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

            <p class="footer-company-name">Canteen Management system ?? 2022</p>
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
        <script src="cart.js"></script>
        <?php if(isset($_SESSION['logged'])){?>
        <div id="work"></div>
        <?php }?>


    </footer>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
</body>

</html>