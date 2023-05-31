<!-- connect files -->
<?php
  include('includes/connect.php');
  include('functions/function.php');
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zhongguocha - Пошук</title>
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg bg-body-white">
    <div class="container-fluid">
      <img src="./img/logotea.jpg" alt="" class="logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Головна сторінка</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Чай
            </a>
            <ul class="dropdown-menu">
            <?php
              getcategory();
            ?>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Блог</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Про нас</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Контакти</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./users_panel/checkout.php"><i class="fa-solid fa-user"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php num_cart_items(); ?></sup></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Загальна сума: <?php total_price();?> </a>
          </li>
          
          <form class="frm" action="search.php" method="get" role="search">
              <input class="form-control me-2" type="search" placeholder="Пошук товарів" aria-label="Search" name="seach_data">
              <!-- <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button> -->
              <input type="submit"  value="Пошук" class="btn btn-outline-success" name="seach_btm">
          </form>
      </ul>
      </div>
    </div>
  </nav>
  
  <!-- Кошик  -->
  <?php
    add_to_cart();
  ?>
  
  <!--second, log area-->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <ul class="navbar-nav me-auto">
      <?php 
        if(!isset($_SESSION['username']))
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
            <a class='nav-link' href='#'>Вітаємо, " .$_SESSION['username']."</a>
          </li>
          ";
        }
        if(!isset($_SESSION['username'])) //не активна
        {
          echo"<li class='nav-item'>
          <a class='nav-link' href='./users_panel/user_login.php'>Вхід</a>
        </li>";
        }
        else{
          echo"
          <li class='nav-item'>
          <a class='nav-link' href='./users_panel/user_logout.php'>Вихід</a>
          </li>";
        }
      ?>
    </ul>
  </nav>
  <!--third, заголовок-->
  <div class="bd-light">
    <h3 class="text-center">Акції</h3>
  </div>
  <!--fourth-->
  <div class="row px-1">
      <!-- sidenav -->
    <div class="col-md-2">
      <!-- brands -->
        <ul class="navbar-nav me-auto p-0">
          <li class="nav-item  bg-light">
            <a href="#" class="nav-link"><h5>Бренд</h5></a>
          </li>
          <?php
            getbrands();
          ?>
        </ul>
        <!-- categories -->
        <ul class="navbar-nav me-auto p-0">
          <li class="nav-item  bg-light">
            <a href="#" class="nav-link"><h5>Категорії</h5></a>
          </li>
          <?php
            getcategory();
          ?>
        </ul>
    </div>
    <div class="col-md-10">
      <!-- товари гол сторінки -->
      <div class="row">
        <?php
          search();
          get_unique_category();
          get_unique_brand();
        ?>
      </div>
      <!-- row end -->
    </div>
   <!-- column -->
  </div>

  <!--footer-->
  <div class="footer bg-light p-3"> 
    <p>©2023 Інтернет - магазин чаю "Zhongguoсha".</p>
  </div>

  <!-- bootstrap js посилання -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" 
  crossorigin="anonymous"></script>
</body>
</html>