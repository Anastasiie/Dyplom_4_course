<?php 
    include('../includes/connect.php');
    include_once('../functions/function.php');
    @session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
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
    <style>body{overflow-x: hidden;}</style>
    <!--css file-->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Вхід до акаунту</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data"><!-- enctype - for img in database -->
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Ім’я користувача: </label>
                        <input type="text" id="username" class="form-control" placeholder="Введіть своє ім'я" autocomplete="off" required="required" name="username"><!-- required - check for fill all inputs --> 
                    </div>
                    <!-- password -->
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Пароль: </label>
                        <input type="password" id="password" class="form-control" placeholder="Введіть пароль" autocomplete="off" required="required" name="password">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Увійти" class="btn btn-outline-success py-2 px-3" name="login">
                        <p class="small fw-light mt-2 pt-1">Немає акаунту? <a href="user_registration.php" class="text-success text-decoration-none"> Реєстрація</a></p>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $select_query="select * from `Користувач` where `Ім’я користувача`='$username'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    $data_row=mysqli_fetch_assoc($result); // take from db only 1 record 
    $ip=getIPAddress();
    //умови товарів кошика
    $select_q_cart="select * from `Деталі замовлення` where `IP_адреса`='$ip'";
    $select_cart=mysqli_query($con,$select_q_cart);
    $rows_cart=mysqli_num_rows($select_cart);
    if($rows_count>0){ //якщо користвач існує
        $_SESSION['username']=$username;
        if(password_verify($password,$data_row['Пароль'])){
            //echo '<script>alert("Вхід виконано успішно")</script>';
            if($rows_count==1 and $rows_cart==0){//якщо користувач увійшов та кошик пустий
                $_SESSION['username']=$username;
                echo '<script>alert("Вхід виконано успішно")</script>';
                echo "<script>window.open('profile.php','_self')</script>";
            }
            else{
                $_SESSION['username']=$username;
                echo '<script>alert("Вхід виконано успішно")</script>';
                echo "<script>window.open('payment.php','_self')</script>";
            }
        }
        else{
            echo '<script>alert("Недійсні облікові дані!")</script>';
        }
    }
    else{
        echo '<script>alert("Такого користувача не існує!")</script>';
    }
}
?>