
<?php
@include 'event.php';
@include 'config.php';
session_start();
$front = "flip-card-front";
$back = "flip-card-back";
if(isset($_SESSION['regerr'])){
    $temp = $front;
    $front = $back;
    $back = $temp;
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
    <!-- <link rel="stylesheet" href="login.css"> -->
    <link rel="stylesheet" href="Stylesheets/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Stylesheets/footer.css">
    <link rel="stylesheet" href="Stylesheets/navbar.css">
    <!--font-icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Bootstrap-js-->
    <?php echo $event ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
 <!-- Owl-carousel CDN -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
    <!-- font poppins -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
    </style>

    <script src="login.js"></script>
    <script src="validation.js"></script>

    <title>Canteen</title>

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
                </ul>
            </div>
        </nav>


    <div>

    </div>

    <!-- Login Page (START)-->
    <div class="upper-login" id="upperLogin">
        <!-- <div class="err-banner">
                Wrong password
        </div> -->
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="form.php" method="POST"  enctype="multipart/form-data">
                    <h1>Create Account</h1>
                    <div class="formError"></div>
                    <select name="type" id="type" onchange="who('type')" >
                        <option value="null">I am a </option>
                        <option value="student">Bonafide Student</option>
                        <option value="canteen">Canteen Staff</option>
                    </select>
                    <input type="text" id="student" name="student" class="hide" placeholder="Student Id ">
                    <input type="text" id="canteen" name="canteen" class="hide" placeholder="Canteen Id ">
                    <input type="text" id="name" name="name" placeholder="Name">
                    <input type="email" id="email" name="email" onchange="validateEmail('email','emailerr')" placeholder="Email">
                    <!-- <p id="emailerr" style="color:red;"></p> -->
                    <input type="number" id="phone" name="phone"  placeholder="Contact Number">
                    <input type="password" name="password" id="password"  placeholder="Enter your password">
                    <input type="password" placeholder="confirm password">
                    <button type="submit" id="register-s" name="register-s" >SignUp</button>
                    
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="form.php" method="post" >
                    <h1>Sign In</h1>
                    <div class="social-container">
                        <a href="#" class="food_icon" onClick="return false;"><i class="fas fa-hamburger"></i></a>
                        <a href="#" class="food_icon" onClick="return false;"><i class="fas fa-ice-cream"></i></a>
                        <a href="#" class="food_icon" onClick="return false;"><i class="fas fa-pizza-slice"></i></a>
                    </div>
                    <span>use your account</span>
                    <select name="who" id="who" >
                        <option value="null">I am a </option>
                        <option value="student">Bonafide Student</option>
                        <option value="canteen">Canteen Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="email" name="email" required placeholder="Enter your email">
                    <input type="password" name="password" required placeholder="Enter your password">
                    <button type="submit" id="login-s" name="login-s">Sign In</button>

                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        
                    <h1>Welcome Back!</h1>
                        <p>Login with your personal info and pre-order food now</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>HUNGRY !</h1>
                        <p>Enter your details and pre-order food now</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- flip  -->
    <!-- <div class="flip-card-3D-wrapper">
        <div id="flip-card">
            <div class="flip-card-front">
            <form action="form.php" method="POST"  enctype="multipart/form-data">
                    <div class="image">
                       <img src="userprofile.png" alt="">
                    </div>
                    <div class="formError"></div>
                    <select name="type" id="type">
                        <option value="null">I am a </option>
                        <option value="student">Bonafide Student</option>
                        <option value="alumni">Graduate Student(Alumni)</option>
                        <option value="faculty">Faculty Member</option>
                    </select>
                    <input type="email" name="email" placeholder="enter your email">
                    <input type="password" name="password" placeholder="enter your password">
                    <input type="submit" name="submit" value="Login now" class="form-btn">
                    <p>don't have an account? <a id="flip-card-btn-turn-to-back" href="#">Register</a></p>
                </form>
            </div>

            signup flip 
            <div class="flip-card-back">
                <form action="http://localhost:8000/createAccount" method="POST" id="register">
                    <div class="image">
                        <img src="userprofile.png" alt="">
                    </div>
                    <div class="formError"></div>
                    <select name="type" id="type">
                        <option value="null">I am a </option>
                        <option value="student">Bonafide Student</option>
                        <option value="alumni">Graduate Student(Alumni)</option>
                        <option value="faculty">Faculty Member</option>
                    </select>
                    <input type="text" id="name" name="name" placeholder="Name">
                    <input type="text" id="userId" name="userId" placeholder="Student Id/ Faculty Id ">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <input placeholder="Year of Joining" id="yoj" name="yoj" type="text" onfocus="(this.type='date')">
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                    <input type="submit" name="submit" value="Register" class="form-btn">
                    <p>Already have an account? <a id="flip-card-btn-turn-to-front" href="#">Login</a></p>

                </form>
            </div>
        </div>
    </div> -->
    <!-- Footer -->
    
    <?php @include 'templates/footer.php'?>

<script>
    const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	// const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
</script>

</body>

</html>
