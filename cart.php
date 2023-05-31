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
    <title>Zhongguocha - Кошик</title>
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
    <style>.cart_img{width: 80px; height: 80px; object-fit: contain;}</style>
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
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="display_tea.php">Чай</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ps-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu w-100">
            <?php
              getcategory();
            ?>
              <!--<li><a class="dropdown-item" href="#">Чорний і червоний чай</a></li>
              //<li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Зелений чай</a></li>
              <li><a class="dropdown-item" href="#">Фруктовий чай</a></li>
              <li><a class="dropdown-item" href="#">Квітковий чай</a></li>
              <li><a class="dropdown-item" href="#">Білий чай</a></li>
              <li><a class="dropdown-item" href="#">Пуер</a></li>
              <li><a class="dropdown-item" href="#">Улун</a></li>
              <li><a class="dropdown-item" href="#">Матча</a></li>-->
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
    <h1 class="text-center">Кошик</h1>
  </div>
  <!--fourth-->
  <div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center" style="vertical-align: middle">
            
            <tbody>
                <!-- display cart -->
                <?php 
                    global $con;
                    $ip = getIPAddress();
                    $total=0;
                    $cart_query="select * from `Деталі замовлення` where `IP_адреса`='$ip'"; //беремо ip користувача, дізнаємося ід його замовлень
                    $result=mysqli_query($con,$cart_query);
                    $result_count=mysqli_num_rows($result);
                    if($result_count>0){
                      echo "
                      <thead>
                      <tr>
                          <th></th>
                          <th></th>
                          <th>ТОВАР</th>
                          <th>КІЛЬКІСТЬ</th>
                          <th>ЦІНА</th>
                          <th></th>
                          <!--  colspan='2'ПРОМІЖНИЙ ПІДСУМОК -->
                      </tr>
                  </thead>
                      ";
                    while($row=mysqli_fetch_array($result)){
                        $product_id=$row['ІD_товару'];
                        $products="select * from `Товари` where `ІD_товару`='$product_id'"; //по ід товарів, знаходимо товар з табл всіх товарів
                        $result_product=mysqli_query($con,$products);
                        while($row_prod_price=mysqli_fetch_array($result_product)){
                            $product_price=array($row_prod_price['Ціна товару']); //ціна одного (250) при 2 проході циклу 340
                            $price=$row_prod_price['Ціна товару']; 
                            $product_name=$row_prod_price['Назва товару'];
                            $product_image1=$row_prod_price['Зображення товару 1'];
                            $product_value=array_sum($product_price); //250, при другому 250+340=590
                            $total+=$product_value; //0+250=250, 
                ?>
                <?php 
                    /*
                    $ip = getIPAddress();
                    $quantity = "select `Кількість` from `Деталі замовлення` where `ІD_товару`='$product_id' and `IP_адреса`='$ip'";
                    $resduct=mysqli_query($con,$quantity);
                    while($rw=mysqli_fetch_assoc($resduct)){
                        $quan=$rw['Кількість'];
                        $quan++; 
                      
                        if(isset($_POST['increment'])){
                          $update_cart="update `Деталі замовлення` set `Кількість`='$quan' where `IP_адреса`='$ip'  and `ІD_товару`='$product_id'";
                          $result_quantity=mysqli_query($con,$update_cart);
                          while($row_r=mysqli_fetch_assoc($result_quantity)){
                          $ttl=$ttl*$quantity;
                          $price=$ttl;
                          }
                        }
                   }
                    if(isset($_POST['decrement'])){//127.0.0.1
                      $quantity = $value;
                      if($quantity>1){
                        $update_cart="update `Деталі замовлення` set `Кількість`='$quantity' where `IP_адреса`='$ip'  and `ІD_товару`=$product_id";
                        $result_quantity=mysqli_query($con,$update_cart);
                        $ttl=$ttl*$quantity;
                        $price=$ttl;
                      }
                    }//$quantity = $_POST['qty'];echo "$quan,$quantity";
                    */
                ?>
                <tr>
                    <td><input type="checkbox" name="remove_item[]" value="<?php echo $product_id ?>"></td>
                    <td><img src="./admin_panel/product_images/<?php echo $product_image1 ?>" alt="" class="cart_img"></td>
                    <td><?php echo $product_name ?></td>
                    
                    <td>
                        <div class="input-group m-auto" style="width: 130px;">
                            <button data-decrease class="input-group-text" name="decrement" type="button">-</button>
                            <input data-value type="text" class="form-control text-center bg-white" value=1>
                            <button data-increase class="input-group-text" name="increment" type="button">+</button>
                        </div>
                        
                        <!--   <input type="text" class="form-input w-50 text-center" name="quantity"> -->
                    </td>
                    
                    <td><?php echo $price ?> ₴</td>
                    <td>
                        <!-- <button class="btn border-0 m-2 "><i class="fa-solid fa-arrows-rotate"></i></button> -->
                        <!-- <input type="submit" class="btn border-0 m-2 " value="refresh" > -->
                        <button class="btn border-0 m-2" name="remove"><i class="fa-solid fa-xmark"></i></button>
                    </td>
                </tr>
                <?php 
                        }
                }
                    }
                    else{ echo "
                      <h2>Кошик порожній</h2>
                      <h5>Перш ніж перейти до оформлення замовлення, ви повинні додати деякі товари у кошик. 
                      <br>На нашій головній сторінці ви знайдете багато цікавих продуктів.</h5>
                      ";
                    } 
                ?>
            </tbody>
        </table>
        <!-- ЗАГАЛОМ-->
        <div class="d-flex mb-5">
          <?php
            $ip = getIPAddress();
            $cart_query="select * from `Деталі замовлення` where `IP_адреса`='$ip'"; //беремо ip користувача, дізнаємося ід його замовлень
            $result=mysqli_query($con,$cart_query);
            $result_count=mysqli_num_rows($result);
            if($result_count>0){
              echo "
              <h4 class='px-5 m-2'>ЗАГАЛОМ: <strong class=''>$total</strong></h4>
              <button class='btn'><a href='./users_panel/checkout.php' class='btn m-auto btn-outline-dark text-decoration-none'>ПЕРЕЙТИ ДО ОФОРМЛЕННЯ</a></button>
              ";
            }
            else{
              echo "
              <button class='btn btn-outline-dark m-2' name='on_main_page'>На Головну сторінку</button>
              ";
            }
            if(isset($_POST['on_main_page'])){
              echo "<script>window.open('index.php','_self')</script>";
            }
          ?>
            </div>
    </div>
  </div>
        </form>
        
<?php 
remove_cart_item()
?>
  <!--footer include-->
  <?php
    include("./includes/footer.php")
  ?>
  

  <!-- bootstrap js посилання -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" 
  crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>
</html>