 <?php
@include 'config.php';
@include 'rand.php';

session_start();

function get(){
    @include 'config.php';
    $sql = "SELECT `id`,`name`,`price`,`c_id`, `category` FROM `item` ";
    $result = $db->query($sql);
    return $result;
}
$msg  = "You can't make any changes until you logged in as canteen staff";
if(isset($_SESSION['logtype'])){
    $msg = "";
if(isset($_POST['del']) && $_SESSION['logtype'] === "canteen"){
    $iid = $_POST['del'];
    $sql = "DELETE FROM `item` where id = '$iid'";
    $del = $db->query($sql);
    if($del){
        header("location: canteen_page.php");
    }
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
                <?php if (isset($_SESSION['logged']) && $_SESSION['logtype'] === "canteen") { $log = false; ?>
                    <li class="nav-item">
                        <!-- <a class="nav-link" id="signup" href="login.html" value="signup">sign Up</a> -->
                        <a class="nav-link" href="logout.php" value="LogOut">LogOut</a>
                    </li>
                   
                <?php } else { $log = true;?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">LogIn</a>
                    </li>
                <?php } ?>
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

    <!-- itemlsit -->
    <div class="middle">
        <div class="item-list">
            <!-- yaha pe krna hai-->
            <p id="msg"><?php echo $msg;?></p>
            <table>
                <tr>
                    <th>Item Id</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <!-- <th>Item Number</th> -->
                </tr>
                <?php
                $result = get();
                if ($result->num_rows > 0)
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td> <button class="updelete  fa fa-pencil" onclick="openForm('<?php echo $row['id'] ?>')"></button> </td>
                        <td>
                            <form action="" method="post">
                            <button class="updelete fa fa-trash" name="del" value="<?php echo $row['id'] ?>"></button>
                    </form>
                        
                        </td>
                    </tr>

            
                <?php 
                }
                ?>
            </table>
        </div>

        <!-- update form  -->
        
    <?php
    $result = get();
    if ($result->num_rows > 0)
        while ($row = $result->fetch_assoc()) {
            ?>
        

        <div class="form-popup " id="<?php echo $row['id'];?>">
                        <button class="cancel"><i class="fa fa-times" aria-hidden="true" onclick="closeForm('<?php echo $row['id'] ?>')"></i></button>
            <form action="update.php" class="itemform" method="post" enctype="multipart/form-data">
                <input type="text" value="<?php echo $row['id'] ?>" name="id" readonly>
                <br>
                <input type="text" value="<?php echo $row['name'] ?>" name="name" readonly>
                <input type="text" value="<?php echo $row['price'] ?>" name="price" placeholder="Price">

                <input type="text" value="<?php echo $row['c_id'] ?>" name="c_id" readonly>

                <select name="category" id="">
                    <option value="#"><?php echo $row['category'] ?> </option>
                    <option value="veg">Veg</option>
                    <option value="nonveg">Non-Veg</option>
                    <option value="beverage">Beverages</option>
                    <option value="fastfood">Fast Foods</option>


                </select>
                <br>

                <button class="qsubmit" name="update" value = "item" >Update</button>
            </form>
        </div> 
        <?php } ?>

        <!-- add item  -->
        <button class="open-button" onclick="openForm('myForm')"><i class="fa fa-plus" aria-hidden="true"></i></button>
        <div class="form-popup " id="myForm">
            <button class="cancel"><i class="fa fa-times" aria-hidden="true" onclick="closeForm('myForm')"></i></button>
            <form action="demo.php" class="itemform" method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Item Id" name="id" value="<?php echo generateRandomString(8); ?>" readonly>
                <br>
                <input type="text" placeholder="Item Name" name="name">
                <input type="text" placeholder="Item Price" name="price">
                <input type="file" name="imgf">
                <input type="text" placeholder="Canteen Id" name="c_id">
                
                <button class="qsubmit" name="submit">Submit</button>
            </form>
        </div>
        
        
        

    </div>

    <!-- Footer -->

    <?php @include 'templates/footer.php'?>
    <script>
       

       if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
        function openForm(id){
            document.getElementById(id).style.display = "block";
        }
        function closeForm(id) {
            document.getElementById(id).style.display = "none";
            // location.reload();
        }
    </script>


</body>

</html>