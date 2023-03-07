<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
$uid = $_SESSION['id'];
$sql = "SELECT `order_id`,`amount` from `order-list` where s_id = '$uid' && status = false";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $orders = $result->fetch_assoc();
    $oid = $orders['order_id'];
    $_SESSION['oid'] = $oid;
    $sql = "SELECT `item_id`,`qty`,`amount` from orders where order_id = '$oid'";
    $result = $db->query($sql);
}

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    
    <title>Document</title>
    <style>
        .container{
            /* display: flex; */
            
            /* background-color: yellow; */
            width: 100vw;
        }
        .receipt{
            padding: 2%;
            width: 40%;
            text-align: center;
            margin: 0 auto 0 auto;
            background-color: #e6efed;
            border-radius: 10px ;
        }
        .time-date{
            display: flex;
            justify-content: flex-end;
            padding-right: 3%;
        }
        .date,.time{
            margin-right: 2%;
        }

       
        .description,.item-container{
            display: grid;
            grid-template-columns: 33.3% 33.3% 33.3%;
            /* width:33% */
        }
        hr{
            border: 1px dashed black;
        }
        .total-container{
            text-align: left;
            padding-left: 15%;
        }

        .left{
            margin-right: 18%;
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="receipt" id="myDiv">
            <h1>Canteen Name </h1>
            <div class="time-date">

                <div class="date">07/03/2023</div>
                <div class="time">11:37:00</div>
            </div>
            <hr>
            <div class="description">
                <div class="qty">Qty</div>
                <div class="item">Item</div>
                <div class="itemtotal">Amount</div>
            </div>
            <hr>
            <?php if ($result->num_rows > 0) {
                while ($list = $result->fetch_assoc()) {
                    $id = $list['item_id'];
                    $sql = "SELECT `name`,`price` from item where id='$id'";
                    $get = $db->query($sql);
                    $item = $get->fetch_assoc();

                    ?>
            
            <div class="item-container">
                <div class="qty"><?php echo $list['qty'] ?></div>
                <div class="item"><?php echo $item['name'] ?></div>
                <div class="itemtotal"><?php echo $list['amount']; ?></div>
            </div>
                <?php
            } ?>
            <hr>
            <div class="total-container">
                <div class="subtotal">
                    Subtotal <span  class="left"><?php echo $orders['amount'] ?></span>

                </div>
                <div class="tax">Tax <span class="left">5</span></div>
                
                <div class="total">TOtal <span class="left">458</span></div>
            </div>
            <?php } else {
                ?>
                <div>
                    <h1>Your cart is empty !</h1>
                </div>
            <?php } ?>
            

            <h3>Thanks for using <br> Canteen pre-ordering System</h3>
        </div>
        <button onclick="printDiv()">Download Receipt to PDF</button>
    </div>
    

    <script>
      function printDiv() {
        // Get the div element by its ID
        var divToPrint = document.getElementById("myDiv");

        // Set the options for the PDF
        var options = {
          filename: 'myDiv.pdf',
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


