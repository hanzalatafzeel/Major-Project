<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
if(isset($_SESSION['oid'])){
    $uid = $_SESSION['id'];
$oid = $_SESSION['oid'];
$sql = "SELECT `amount` from `order-list` where order_id = '$oid'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $orders = $result->fetch_assoc();
    
}
}else{
    header("location: ./");
}

if(isset($_POST['pay'])){

    $sql = "UPDATE `order-list` SET `status`= true WHERE order_id = '$oid'";
    $result = $db->query($sql);
    if($result){
        unset($_SESSION['oid']);
        header("location: ./");
        
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="checkout.css">
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
    <script src="checkout.js" defer></script>
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <a class="nav-link" id="signup" href="login.html" value="signup">sign Up</a>
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
        <div class="pay-container">
            <div class="pay-method" id="pay-meth">
                <h4>Payment Methods </h4>
                <!-- <li><a href=""> <i class="fa-solid fa-wallet"></i>  Wallet </a></li> -->
                <li><a href="#" onclick="upishow()" > <img src="icons8-bhim-upi-50.png" alt="" width="20"> UPI </a></li>
                <li><a href="#"  onclick="cardshow()" ><i class="fa fa-credit-card"></i> Credit & Debit cards</a></li>
                <li><a href="#" onclick="pod()" ><i class="fa fa-money" aria-hidden="true"></i> Pay at canteen</a></li>
            </div>
            <div class="vr">
                
            </div>
            <div class="pay-method " id="payupi">
                <h4>We Accept Following UPI</h4>
                <li><a href=""><i class='fab fa-google-pay'></i> Gpay </a></li>
                <li><a href=""><img src="icons8-phone-pe-48.png" alt="" width="22px"> PhonePe</a></li>
                <li><a href=""><i class='fab fa-amazon-pay'></i> Amazon Pay</a></li>
                <li><a href=""><img src="icons8-paytm-48.png" alt="" width="22">  Paytm</a></li>
                
                    <button class="checkout-btn" >&nbsp;<i class="fa fa-money" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;PAY &#8377;XYZ</button>
               
            </div>

            <div class="pay-method " id="paycard">
                <h4>Debit & Credit card Payment</h4>
                <form id="CardForm" action="#" method="post">
                    
                    <div class="row">
                      <div class="col">
                        <input type="password" id="number"  placeholder="Card Number"/>
                      </div>
                    </div>
                    <!-- row -->
                  
                    <div class="row middle">
                      <div class="col">
                        <label for="month">Month</label>
                        <select id="month">
                          <option></option>
                          <option>01</option>
                          <option>02</option>
                          <option>03</option>
                          <option>04</option>
                          <option>05</option>
                          <option>06</option>
                          <option>07</option>
                          <option>08</option>
                          <option>09</option>
                          <option>10</option>
                          <option>11</option>
                          <option>12</option>
                        </select>
                      </div>
                  
                      <div class="col">
                        <label for="year">Year</label>
                        <select id="year">
                          <option></option>
                          <option>2017</option>
                          <option>2018</option>
                          <option>2019</option>
                          <option>2020</option>
                          <option>2021</option>
                          <option>2022</option>
                          <option>2023</option>
                          <option>2024</option>
                          <option>2025</option>
                          <option>2026</option>
                          <option>2027</option>
                          <option>2028</option>
                          <option>2029</option>
                          <option>2030</option>
                          <option>2031</option>
                          <option>2032</option>
                        </select>
                      </div>
                  
                      <div class="col">
                        <label for="cvc">CVC</label>
                        <input type="text" id="cvc"/>
                      </div>
                  
                      <div class="col">
                        <br>
                        <!-- <img src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_logo_2.gif" /> -->
                      </div>
                  
                    </div>
                    <!-- row -->
                  
                    <div class="row">
                      <div class="col">
                        <input type="text" id="name" placeholder="Card Holder Name"/>
                            <i class="fa-brands fa-cc-mastercard" style="font-size:30px"></i>
                            <i class="fa-brands fa-cc-visa" style="font-size:30px"></i>
                    
                       
                        </div>
                    </div>
                    <!-- row -->
                    <button class="checkout-btn" >&nbsp;<i class="fa fa-money" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;PAY &#8377;XYZ</button>
                  </form>
            </div>
            <div class="pay-method " id="pod">
                <h4>Cash on Delivery</h4>
                <form action="" method="post">
                    <button class="checkout-btn" name="pay" id="pay" value="paid" >&nbsp;<i class="fa fa-money" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;PAY &#8377; <?php echo $orders['amount']; ?></button>
                </form>
            </div>
        </div>
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
        function upishow(){
            document.getElementById("payupi").style.display ="block";
            document.getElementById("paycard").style.display ="none";  
            document.getElementById("pod").style.display="none";


        }
        function cardshow(){
            document.getElementById("paycard").style.display ="block";    
            document.getElementById("payupi").style.display ="none";  
            document.getElementById("pod").style.display="none";
        }
        function pod(){
            document.getElementById("pod").style.display="block";
            document.getElementById("paycard").style.display ="none"; 
            document.getElementById("payupi").style.display ="none";  

        }
    </script>
</body>

</html>