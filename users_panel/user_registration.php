<?php 
    include('../includes/connect.php');
    include('../functions/function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
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
        <h2 class="text-center">Реєстрація акаунту</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data"><!-- enctype - for img in database -->
                    <!-- username registration field (заповнення) -->
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Ім’я користувача: </label>
                        <input type="text" id="username" class="form-control" placeholder="Введіть своє ім'я" autocomplete="off" required="required" name="username"><!-- required - check for fill all inputs --> 
                    </div>
                    <!-- email -->
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Електронна пошта: </label>
                        <input type="email" id="email" class="form-control" placeholder="Введіть свою пошту" autocomplete="off" required="required" name="email">
                    </div>
                    <!-- image -->
                    <div class="form-outline mb-4">
                        <label for="image" class="form-label">Аватарка користувача:</label>
                        <input type="file" id="image" class="form-control" required="required" name="image">
                    </div>
                    <!-- password -->
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Пароль: </label>
                        <input type="password" id="password" class="form-control" placeholder="Введіть пароль" autocomplete="off" required="required" name="password">
                    </div>
                    <!-- confirm password -->
                    <div class="form-outline mb-4">
                        <label for="conf_password" class="form-label">Підтвердіть пароль: </label>
                        <input type="password" id="conf_password" class="form-control" placeholder="Підтвердження паролю" autocomplete="off" required="required" name="conf_password">
                    </div>
                    <!-- address -->
                    <div class="form-outline mb-4">
                        <label for="address" class="form-label">Адреса: </label>
                        <input type="text" id="address" class="form-control" placeholder="Введіть свою адресу" autocomplete="off" required="required" name="address">
                    </div>
                    <!-- contact -->
                    <div class="form-outline mb-4">
                        <label for="contact" class="form-label">Номер телефону: </label>
                        <input type="text" id="contact" class="form-control" placeholder="Введіть свій номер телефону" autocomplete="off" required="required" name="contact">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Зберегти" class="btn btn-outline-success py-2 px-3" name="registration">
                        <p class="small fw-light mt-2 pt-1">Існує акаунт? <a href="user_login.php" class="text-success text-decoration-none"> Вхід</a></p>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['registration'])){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $hash_password=password_hash($password,PASSWORD_DEFAULT);
        $conf_password=$_POST['conf_password'];
        $address=$_POST['address'];
        $contact=$_POST['contact'];
        $image=$_FILES['image']['name'];
        $image_tmp=$_FILES['image']['tmp_name'];
        $ip=getIPAddress();
        //$ip++;

        $select_query="select * from `Користувач` where `Ім’я користувача`='$username' or `Пошта`='$email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
            echo '<script>alert("Таке ім`я або пошта вже існує!")</script>';
        }
        else if($password!=$conf_password){
            echo '<script>alert("Паролі не збігаються!")</script>';
        }
        else{
            move_uploaded_file($image_tmp,"./users_img/$image");
            $insert_query ="insert into `Користувач`(`Ім’я користувача`,`Пошта`,`Пароль`,`Аватарка користувача`,`IP_користувача`,`Адреса користувача`,`Номер телефону`)
            values ('$username','$email','$hash_password','$image','$ip','$address','$contact')";
            $sql_execute=mysqli_query($con,$insert_query);
            if($sql_execute){
                echo "<script>alert('Акаунт створено')</script>";
            }
            else{    
                die(mysqli_error($con));
            }
        }
        //SELECT CART ITEMS
        $select_cart_items="select * from `Деталі замовлення` where `IP_адреса`='$ip'";
        $resuult_cart_items=mysqli_query($con,$select_cart_items);
        $coun_trows=mysqli_num_rows($resuult_cart_items);
        if($coun_trows>0){// user not login, and add items in cart
            $_SESSION['username']=$username;
            echo "<script>alert('Ви маєте товари в кошику')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
        else{
            echo "<script>window.open('../index.php','_self')</script>";
        }
    }
?>