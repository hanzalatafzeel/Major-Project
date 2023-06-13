<?php
@include 'config.php';
@include 'event.php';

session_start();

if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
$oid = $_SESSION['oid'];
$sql = "SELECT `amount` ,`date`,`time`,`pay_id`from `order-list` where order_id = '$oid'";
$result = $db->query($sql);
$fetch = "";
if ($result->num_rows > 0) {
    $orders = $result->fetch_assoc();
    $oid = $_SESSION['oid'];

    $sql = "SELECT `item`.`name` as `name`,`orders`.`qty` as `qty`,`orders`.`amount`as `amt` from orders INNER JOIN item ON `item`.`id`= `orders`.`item_id`where order_id = '$oid'";
    $fetch = $db->query($sql);

}

$count = -1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $event ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<link rel="stylesheet" href="Stylesheets/invoice.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="receipt" id="myDiv">
            <h1>Jamia Millia Islamia </h1>
            <p>Central Canteen</p>
            <?php if($orders['pay_id'])
                    $cls = "paid";
                    else
                    $cls = "notpaid";
            
            ?>
                <div class="<?php echo $cls;?>"></div>
            <div class="time-date">
                
                <div class="date" id="dt"><?php echo $orders['date']?></div>
                <div class="time" id="tm"><?php echo $orders['time']?></div>
            </div>
            <hr>
            <!-- <div class=" "> -->
                <div class="description">
                    <div class="qty">Qty</div>
                    <div class="item">Item</div>
                    <div class="itemtotal">Amount</div>
                </div>
                <hr>
                <?php if ($fetch->num_rows > 0) {
                    while ($list = $fetch->fetch_assoc()) {
                        
                        
                        ?>

<div class="item-container">
    <div class="qty">
        <?php echo $list['qty'] ?>
    </div>
    <div class="item">
        <?php echo $list['name'] ?>
    </div>
    <div class="itemtotal">
        <?php echo $list['amt']; ?>
                        </div>
                    </div>
                    <?php
                } ?>
                <hr>
                <div class="total-container">
                    <div class="subtotal">
                        Subtotal 
                        <span class="left">
                            <?php echo $orders['amount'] ?>
                        </span>
                        
                    </div>
                    <div class="tax">Tax <span class="left">5%</span></div>
                    
                    <div class="total">Total <span class="left">
                        <?php echo $orders['amount'] + (0.05 * $orders['amount']) ?>
                    </span></div>
                </div>
            <!-- </diV> -->
                <span id="orderid" style="display:none" ><?php echo $oid; ?></span>
            <?php } else {
                ?>
                <div>
                    <h1>Your cart is empty !</h1>
                </div>
            <?php } ?>


            <h3>Thanks for using <br> Canteen pre-ordering System</h3>
            <button onclick="printDiv()">Download Receipt to PDF</button>
        </div>
    </div>


    <script>
        const d = new Date();
        const t = new Date();
        // var get = document.getElementById('dt').innerHTML = d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();
        // document.getElementById('tm').innerHTML = t.getHours() + ":" + t.getMinutes() + ":" + t.getSeconds();

        function printDiv() {
            // Get the div element by its ID
            var divToPrint = document.getElementById("myDiv");

            const name = document.getElementById('orderid').innerHTML;
            console.log(name);
            // Set the options for the PDF
            var options = {
                filename: name,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            // Use html2pdf to generate the PDF
            html2pdf().from(divToPrint).set(options).save();
        }
    </script>
</body>

</html>