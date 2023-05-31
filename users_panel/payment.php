<!-- connect files -->
<?php
  include('../includes/connect.php');
  include_once('../functions/function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата</title>
    <!-- bootstrap CSS посилання -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
    crossorigin="anonymous">
    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <!--css file-->
    <style><?php //include "../styles.css" ?></style>
    <link rel="stylesheet" href="../styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- user id -->
    <?php
    $user_ip=getIPAddress();
    $get_user="select * from `Користувач` where `IP_користувача`='$user_ip'";
    $result=mysqli_query($con,$get_user);
    $run_query=mysqli_fetch_array($result);
    $user_id=$run_query['ІD_користувача'];
    ?>
    <div class="container">
        <h2 class="text-center">Варіанти оплати</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img src="../img/pp.png" alt="" class="imgpp"></a>
            </div>    
            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>" class="text-decoration-none"><h1 class="text-center">Сплата на сайті</h1></a>
            </div> 
        </div>
    </div>
</body>
</html>