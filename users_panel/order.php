<!-- into bd -->
<!-- connect files -->
<?php
  include('../includes/connect.php');
  include_once('../functions/function.php');
  if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
  }
  // отрим. всі товари та загальна ціна всіх товарів
  $get_ip_adress=getIPAddress();
  $total_price=0;
  $cart_price="select * from `Деталі замовлення` where `IP_адреса`='$get_ip_adress'";
  $result_price=mysqli_query($con,$cart_price);
  $count_products=mysqli_num_rows($result_price);
  $invoice_number=mt_rand(); //випадкові числа накладної
  $status='очікують на розгляд';
  while($row_price=mysqli_fetch_array($result_price)){
    $prod_id=$row_price['ІD_товару'];
    $product="select * from `Товари` where `ІD_товару`=$prod_id";
    $result_products=mysqli_query($con,$product);
    while($row_prod_price=mysqli_fetch_array($result_products)){
        $product_price=array($row_prod_price['Ціна товару']);
        $price=array_sum($product_price);
        $total_price+=$price;
    }
  }
  
  //кількість з кошику
  $get_cart="select * from `Деталі замовлення`";
  $cart=mysqli_query($con,$get_cart);
  $item_quantity=mysqli_fetch_array($cart);
  $quantity=$item_quantity['Кількість'];
  if($quantity==1){
    $subtotal=$total_price;
  }
  else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;
  }
  //insert orders
  $insert_orders="insert into `Замовлення користувача` (`ID_користувача`,`Сума до сплати`,`Номер накладної`,`Всі замовлення`,`Дата замовлення`,`Статус замовлення`)
  values ($user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";
  $result_query=mysqli_query($con,$insert_orders);
  if($result_query){
    echo '<script>alert("Замовлення успішно додані")</script>';
    echo "<script>window.open('profile.php','_self')</script>";
  }
  //insert в розгляді
  $insert_pending_orders="insert into `Замовлення в розгляді` (`ID_користувача`,`Номер накладної`,`ID_товару`,`Кількість`,`Статус замовлення`)
  values ($user_id,$invoice_number,$prod_id,$quantity,'$status')";
  $result_pending_orders=mysqli_query($con,$insert_pending_orders);
  //delete items from cart when it payed
  $empty_cart="delete from `Деталі замовлення` where `IP_адреса`='$get_ip_adress'";
  $result_delete=mysqli_query($con,$empty_cart);
?>
