<?php 
session_start();
@include 'config.php';
$api = "rzp_test_p7ybnNwbmYx6B3";
$oid = $_SESSION['oid'];
$sql = "SELECT `amount` from `order-list` where order_id = '$oid'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $orders = $result->fetch_assoc();
    

}else{
    header("location: ./");
}
?>

<form action="" method="POST">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $api; ?>" 
    data-amount="<?php echo $orders['amount']; ?>" 
    data-currency="INR"
    data-order_id="<?php echo $oid; ?>"
    data-buttontext="Pay with Razorpay"
    data-name="Campus Crave"
    data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
    data-prefill.name="<?php echo $_SESSION['name']; ?>"
    data-prefill.email="<?php echo $_SESSION['email']; ?>"
    data-theme.color="#F37254"
></script>
<input type="hidden" custom="Hidden Element" name="hidden"/>
</form>