<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення акаунту</title>
</head>
<body>
    <h3 class='mt-2 mb-4'>Видалення облікового запису</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 btn btn-outline-danger text-uppercase " name="delete" value="Видалення акаунту">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 btn btn-outline-warning text-capitalize " name="dont_delete" value="Не видаляти акаунт">
        </div>
    </form>
    <?php 
        $name_session=$_SESSION['username'];
        if(isset($_POST['delete'])){
            $delete_query="delete from `Користувач` where `Ім’я користувача`='$name_session'";
            $result_delete=mysqli_query($con,$delete_query);
            if($result_delete) //запит успішний
            {
                session_destroy();
                echo '<script>alert("Сумно бачити, що ви йдете. Акаунт видалено успішно :(")</script>';
                echo "<script>window.open('../index.php','_self')</script>";
            }
        }
        if(isset($_POST['dont_delete'])){
            echo "<script>window.open('profile.php','_self')</script>";
        }
    ?>
</body>
</html>