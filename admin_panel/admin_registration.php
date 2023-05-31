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
    <title>Admin registration</title>
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
        <h2 class="text-center mt-5 mb-3">Реєстрація Адміністратора</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../img/registr_green.jpg" alt="Admin registration" class="img-fluid admin_regist_img">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4 mt-4">
                        <label for="admin_name" class="form-label">Ім'я адміністратора:</label>
                        <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Введіть ім'я" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Електронна пошта:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Введіть електронну пошту" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Пароль:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Введіть пароль" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="conf_password" class="form-label">Підтвердіть пароль:</label>
                        <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Підтвердіть пароль" required="required">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-outline-success py-2 px-3" value="Реєстрація" name="admin_registration">
                        <p class="small ms-1 pt-2 fw-bold">Є акаунт? <a href="admin_login.php">Вхід</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['admin_registration'])){
        $admin_name=$_POST['admin_name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $hash_password=password_hash($password,PASSWORD_DEFAULT);
        $conf_password=$_POST['conf_password'];
        //$ip++;

        $select_query="select * from `Адміністратори` where `Ім’я адміністратора`='$admin_name' or `Електронна пошта`='$email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
            echo '<script>alert("Таке ім`я або пошта вже існує!")</script>';
        }
        else if($password!=$conf_password){
            echo '<script>alert("Паролі не збігаються!")</script>';
        }
        else{
            $insert_query ="insert into `Адміністратори`(`Ім’я адміністратора`,`Електронна пошта`,`Пароль`) values ('$admin_name','$email','$hash_password')";
            $sql_execute=mysqli_query($con,$insert_query);
            if($sql_execute){
                echo "<script>alert('Акаунт адміністратора створено')</script>";
            }
            else{    
                die(mysqli_error($con));
            }
        }
    }
?>