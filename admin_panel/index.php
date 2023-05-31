<!-- connect files -->
<?php
  include('../includes/connect.php');
  include('../functions/function.php');
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель адміністратора</title>
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
    <!-- navbar -->
    <div class="continer-fluid p-0">
        <!-- fist -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white justify-content-between">
            <div class="continer-fluid">
                <img src="../img/logotea.jpg" alt="" class="logo_adm ms-3">
            </div>
            <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                    <?php 
                        if(!isset($_SESSION['admin_name'])) //не активна
                        {
                        echo"
                        <li class='nav-item'>
                            <a class='nav-link' href='#'>Вітаємо, Гість</a>
                        </li>
                        ";
                        }
                        else{
                        echo"
                        <li class='nav-item'>
                            <a class='nav-link' href='#'>Вітаємо, " .$_SESSION['admin_name']."</a>
                        </li>
                        ";
                        }
                        if(!isset($_SESSION['admin_name'])) //не активна
                        {
                        echo"<li class='nav-item'>
                            <a class='nav-link' href='admin_login.php'>Вхід</a>
                        </li>";
                        }
                        else{
                        echo"
                        <li class='nav-item'>
                            <a class='nav-link me-4' href='admin_logout.php'>Вихід</a>
                        </li>";
                        }
                    ?>
                    </ul>
                </nav>
        </nav>
        <!-- second -->
        <div class="bg-light">
            <h4 class="text-center p-2 my-0">Управління деталями</h4>
        </div>
        <!-- third -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-3 d-flex align-items-center">
                <div class="m-2">
                    <a href="#"><img src="../img/logo.jpg" alt="" class="admin_image"></a>
                    <p class="text-light text-center"><?php echo $_SESSION['admin_name'] ?></p>
                </div>
                <div class="button text-center m-3">
                    <button class="btn btn-outline-light btn-lg "><a href="insert_products.php" class="nav-link p-2">Додати товар</a></button>
                    <button class="btn btn-outline-light btn-lg "><a href="index.php?view_products" class="nav-link p-2">Перегляд товарів</a></button>
                    <button class="btn btn-outline-light btn-lg "><a href="index.php?insert_category" class="nav-link p-2">Додати категорію</a></button>
                    <button class="btn btn-outline-light btn-lg "><a href="index.php?view_categories" class="nav-link p-2">Перегляд категорій</a></button>
                    <button class="btn btn-outline-light btn-lg "><a href="index.php?insert_brand" class="nav-link p-2">Додати бренд</a></button>
                    <button class="btn btn-outline-light btn-lg "><a href="index.php?view_brands" class="nav-link p-2">Перегляд брендів</a></button>
                    <button class="btn btn-outline-light btn-lg "><a href="index.php?all_orders" class="nav-link p-2">Всі замовлення</a></button>
                    <button class="btn btn-outline-light btn-lg "><a href="index.php?all_payments" class="nav-link p-2">Всі платежі</a></button>
                    <button class="btn btn-outline-light btn-lg "><a href="index.php?all_users" class="nav-link p-2">Користувачі</a></button>
                    <button class="btn btn-outline-light btn-lg mt-2"><a href="admin_logout.php" class="nav-link p-2"><i class="fa-solid fa-arrow-right-from-bracket"></i> Вихід </a></button>
                </div>
            </div> 
        </div>
        <!-- fourth, кнопки адміністрування,  підкл форм в index.php(admin) -->
        <div class="container">
            <?php
            if(isset($_GET['insert_category']))
            {
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brand']))
            {
                include('insert_brands.php');
            }
            if(isset($_GET['view_products']))   //Подивитися всі товари
            {
                include('products_view.php');
            }
            if(isset($_GET['edit_products']))   //Іконка змін, в панелі всі товари
            {
                include('products_edit_icon.php');
            }
            if(isset($_GET['delete_products'])) //Іконка видалення, в панелі всі товари
            {
                include('products_delete_icon.php');
            }
            if(isset($_GET['view_categories'])) //всі категорії
            {
                include('view_categories.php');
            }
            if(isset($_GET['view_brands']))     //всі бренди
            {
                include('view_brands.php');
            }
            //edit
            if(isset($_GET['edit_category']))
            {
                include('view_category_edit.php');
            }
            if(isset($_GET['edit_brand']))
            {
                include('view_brand_edit.php');
            }
            //delete
            if(isset($_GET['delete_category']))
            {
                include('view_category_delete.php');
            }
            if(isset($_GET['delete_brand']))
            {
                include('view_brand_delete.php');
            }
            //orders
            if(isset($_GET['all_orders']))
            {
                include('all_orders.php');
            }
            //payments
            if(isset($_GET['all_payments']))
            {
                include('all_payments.php');
            }
            //all users
            if(isset($_GET['all_users']))
            {
                include('all_users.php');
            }
            ?>
        </div>
    </div>
    <!--footer include-->
    <?php
        include("../includes/footer.php")
    ?>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" 
    crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- bootstrap JS link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>