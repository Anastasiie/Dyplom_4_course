<?php 
    if(isset($_GET['edit_account'])){ //active edit acc
        $session_username=$_SESSION['username'];
        $select_query="select * from `Користувач` where `Ім’я користувача`='$session_username'";
        $result_guery=mysqli_query($con,$select_query);
        $row_fetch=mysqli_fetch_assoc($result_guery);
        $id_user=$row_fetch['ІD_користувача']; 
        $username=$row_fetch['Ім’я користувача'];
        $email=$row_fetch['Пошта'];
        $address=$row_fetch['Адреса користувача'];
        $contact=$row_fetch['Номер телефону'];
    }
    if(isset($_POST['save'])){//btn click
        $update_id=$id_user;
        $username=$_POST['username'];
        $email=$_POST['email'];
        $address=$_POST['adress'];
        $contact=$_POST['telephone'];

        $image_user=$_FILES['image']['name'];
        $image_user_tmp=$_FILES['image']['tmp_name'];
        move_uploaded_file($image_user_tmp,"./users_img/$image_user");
        //update
        //UPDATE `Користувач` SET `Ім’я користувача` = 'admin', `Пошта` = 'admin@dmino.amino', `Адреса користувача` = 'amino', `Номер телефону` = '1234567890' WHERE `Користувач`.`ІD_користувача` = 1;
        $update="update `Користувач` set `Ім’я користувача`='$username',`Пошта`='$email',`Аватарка користувача`='$image_user',`Адреса користувача`='$address',`Номер телефону`='$contact'
        where `ІD_користувача`=$update_id";
        $update_guery=mysqli_query($con,$update);
        if($update_guery){
            echo "<script>alert('Облікові дані змінено')</script>";
            echo "<script>window.open('profile.php','_self')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагувати обліковий запис</title>
</head>
<body>
    <h3 class='mt-2 mb-4'>Редагувати обліковий запис</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50" placeholder="Ім'я" value="<?php echo $username ?>" name="username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50" placeholder="Поштова скринька" value="<?php echo $email ?>" name="email">
        </div>
        <div class="form-outline mb-4 d-flex w-50">
            <input type="file" class="form-control m-auto" name="image">
            <img src="./users_img/<?php echo $image?>" alt="" class="edit_account_img">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50" placeholder="Адреса" value="<?php echo $address ?>" name="adress">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50" placeholder="Номер телефону" value="<?php echo $contact ?>" name="telephone">
        </div>
        <input type="submit" value="Зберегти" class="btn btn-outline-success py-2 px-3" name="save">
    </form>
</body>
</html>