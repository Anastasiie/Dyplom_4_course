<?php 
     include('../includes/connect.php');
     include_once('../functions/function.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
    crossorigin="anonymous">

    <!-- font awesome link, icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <!--css file-->
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mt-5 mb-3">Вхід Адміністратора</h2>
        <div class="row d-flex justify-content-center"><!--align-items-center  -->
            <div class="col-lg-6 col-xl-5">
                <img src="../img/grl_green_tea_cup_nw.jpg" alt="Admin login" class="img-fluid admin_regist_img">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4 mt-5">
                        <label for="admin_name" class="form-label">Ім'я адміністратора:</label>
                        <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Введіть ім'я" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Пароль:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Введіть пароль" required="required">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-outline-success py-2 px-3" value="Вхід" name="admin_login">
                        <p class="small ms-1 mt-2 pt-2 fw-bold">Немає акаунту? <a href="admin_registration.php">Реєстрація</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['admin_login'])){
    $admin_name=$_POST['admin_name'];
    $admin_password=$_POST['password'];
    $select_query="select * from `Адміністратори` where `Ім’я адміністратора`='$admin_name'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    $admin_row=mysqli_fetch_assoc($result); // take from db only 1 record 
    
    if($rows_count>0){ //якщо існує
        $_SESSION['admin_name']=$admin_name;
        if(password_verify($admin_password,$admin_row['Пароль'])){
            $_SESSION['admin_name']=$admin_name;
            echo '<script>alert("Вхід виконано успішно")</script>';
            echo "<script>window.open('index.php','_self')</script>";
        }
        else{
            echo '<script>alert("Недійсні облікові дані!")</script>';
        }
    }
    else{
        echo '<script>alert("Такого адміністратора не існує!")</script>';
    }
}
?>