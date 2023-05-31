<!-- чорний фон (дисплей ОПЛАТИ замовлень), update завершено , сплачено-->


<?php
  include('../includes/connect.php');
  include('../functions/function.php');
  session_start();
  if(isset($_GET['order_id'])) // якщо зверху посилання є order_id
    {
        $order_id=$_GET['order_id'];
        $order_query="select * from `Замовлення користувача` where `ID_замовлення`=$order_id";
        $result_order=mysqli_query($con,$order_query);
        $row_ftch=mysqli_fetch_array($result_order);
        $invoice_number=$row_ftch['Номер накладної'];
        $amount=$row_ftch['Сума до сплати'];
    }
    //`Платежі користувачів` заповнення
 if(isset($_POST['conf_payment'])){
    $inv_number=$_POST['i_number'];
    $amount_due=$_POST['amount_pay'];
    $payment_mode=$_POST['payment_mode'];
    $insrt_query="insert into `Платежі користувачів` (`ID_замовлення`,`Номер накладної`,`Сума`,`Спосіб оплати`,`Дата`) values ($order_id,$inv_number,$amount_due,'$payment_mode',NOW())";
    $rest_query=mysqli_query($con,$insrt_query);
    if($rest_query){
        echo '<script>alert("Платіж виконано успішно")</script>';
        echo "<script>window.open('profile.php?orders','_self')</script>";
    }
    $update="update `Замовлення користувача` set `Статус замовлення`='Завершено' where `ID_замовлення`=$order_id";
    $result=mysqli_query($con,$update);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сторінка - оплати</title>
    <!-- bootstrap CSS посилання -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
    crossorigin="anonymous">
    <!--css file-->
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="bg-dark">
    <div class="container my-5">
        <h1 class="text-center text-white">Підтвердження оплати</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $invoice_number ?>" name="i_number">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-white">Cума:</label>
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $amount ?>" name="amount_pay">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Спосіб оплати:</option>
                    <option>Кредитна/Дебетова карта</option>
                    <option>Інтернет-Банкінг</option>
                    <option>PayPal</option>
                    <option>Готівковий платіж</option>
                    <option>Платити офлайн</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="btn btn-outline-success py-2 px-3" value="Сплатити" name="conf_payment">
            </div>
        </form>
    </div> 
</body>
</html>