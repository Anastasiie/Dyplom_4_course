<?php
//підключення з'єдн файлу
//include('./includes/connect.php');

// вивести товарu від 0 до 9
function getproducts(){
    global $con;
    //перевірка isset or not
    if(!isset($_GET['category'])){
    if(!isset($_GET['brand'])){
            $select_query="select * from `Товари` order by rand() limit 0,9";
            $result_query=mysqli_query($con,$select_query); //виконати запит
            while($row=mysqli_fetch_assoc($result_query)){  //отримання даних з бази даних
                $product_id=$row['ІD_товару'];
                $product_name=$row['Назва товару'];
                $product_description=$row['Опис товару'];
                // $product_keywords=$row['Атрибути товару'];
                $product_category=$row['ID_категорії'];
                $product_brands=$row['ID_бренду'];
                $product_image1=$row['Зображення товару 1'];
                //$product_image2=$row['Зображення товару 2'];
                // $product_image3=$row['Зображення товару3'];
                $product_price=$row['Ціна товару'];
                echo "<div class='col-md-2 mb-2 w-25'>
                        <div class='card'>
                            <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                            <div class='card-body'>
                                <h6 class='card-title'>$product_name</h6>
                                <!-- <p class='card-text'>$product_description</p> -->
                                <p class='card-text'>$product_price грн.</p>
                                <a href='index.php?to_cart=$product_id' class='btn btn-dark'>До кошика</a>
                                <a href='view_details.php?product_id=$product_id' class='btn btn-dark'>Переглянути більше</a>
                            </div>
                        </div>
                       </div>";
            }
        }
     }
 }

//вивести абсолютно всі товари
function get_all_products(){
    global $con;
    //перевірка isset or not
    if(!isset($_GET['category'])){
    if(!isset($_GET['brand'])){
            $select_query="select * from `Товари` order by rand()";
            $result_query=mysqli_query($con,$select_query);
            while($row=mysqli_fetch_assoc($result_query)){
                $product_id=$row['ІD_товару'];
                $product_name=$row['Назва товару'];
                $product_description=$row['Опис товару'];
                // $product_keywords=$row['Атрибути товару'];
                $product_category=$row['ID_категорії'];
                $product_brands=$row['ID_бренду'];
                $product_image1=$row['Зображення товару 1'];
                // $product_image2=$row['Зображення товару 2'];
                // $product_image3=$row['Зображення товару3'];
                $product_price=$row['Ціна товару'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                            <div class='card-body'>
                                <h6 class='card-title'>$product_name</h6>
                                <!-- <p class='card-text'>$product_description</p> -->
                                <p class='card-text'>$product_price грн.</p>
                                <a href='index.php?to_cart=$product_id' class='btn btn-dark'>До кошика</a>
                                <a href='view_details.php?product_id=$product_id' class='btn btn-secondary'>Переглянути більше</a>
                            </div>
                        </div>
                       </div>";
            }
        }
     }
 }
// унікальна категорія
function get_unique_category(){
    global $con;
    //перевірка isset or not
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
        $select_query="select * from `Товари` where `ID_категорії`='$category_id'";
        $result_query=mysqli_query($con,$select_query);
        //перевірка чи є такі категорії
        $num_rows=mysqli_num_rows($result_query);
        if($num_rows==0){
            echo "<h4 class='text-start m-auto'>Не існує товарів з такою категорією</h4>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['ІD_товару'];
                $product_name=$row['Назва товару'];
                $product_description=$row['Опис товару'];
                // $product_keywords=$row['Атрибути товару'];
                $product_category=$row['ID_категорії'];
                $product_brands=$row['ID_бренду'];
                $product_image1=$row['Зображення товару 1'];
                // $product_image2=$row['Зображення товару 2'];
                // $product_image3=$row['Зображення товару3'];
                $product_price=$row['Ціна товару'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                            <div class='card-body'>
                                <h6 class='card-title'>$product_name</h6>
                                <!-- <p class='card-text'>$product_description</p> -->
                                <p class='card-text'>$product_price грн.</p>
                                <a href='index.php?to_cart=$product_id' class='btn btn-dark'>До кошика</a>
                                <a href='view_details.php?product_id=$product_id' class='btn btn-secondary'>Переглянути більше</a>
                            </div>
                        </div>
                       </div>";
        }
    }
}

// унікальний ід для бренду
function get_unique_brand(){
    global $con;
    //перевірка isset or not
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
        $select_query="select * from `Товари` where `ID_бренду`='$brand_id'";
        $result_query=mysqli_query($con,$select_query);
        //перевірка чи є такі категорії
        $num_rows=mysqli_num_rows($result_query);
        if($num_rows==0){
            echo "<h4 class='text-start m-auto'>Не існує товарів з таким брендом</h4>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['ІD_товару'];
                $product_name=$row['Назва товару'];
                $product_description=$row['Опис товару'];
                // $product_keywords=$row['Атрибути товару'];
                $product_category=$row['ID_категорії'];
                $product_brands=$row['ID_бренду'];
                $product_image1=$row['Зображення товару 1'];
                // $product_image2=$row['Зображення товару 2'];
                // $product_image3=$row['Зображення товару3'];
                $product_price=$row['Ціна товару'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                            <div class='card-body'>
                                <h6 class='card-title'>$product_name</h6>
                                <!-- <p class='card-text'>$product_description</p> -->
                                <p class='card-text'>$product_price грн.</p>
                                <a href='index.php?to_cart=$product_id' class='btn btn-dark'>До кошика</a>
                                <a href='view_details.php?product_id=$product_id' class='btn btn-secondary'>Переглянути більше</a>
                            </div>
                        </div>
                       </div>";
        }
    }
}

//display brands in sidenav
function getbrands(){
    global $con;
    $select_brands="select * from `Бренди`";
    $result_brands=mysqli_query($con,$select_brands);
    while($row_data=mysqli_fetch_assoc($result_brands)){
        $brand_name=$row_data['Назва бренду'];
        $brand_id=$row_data['ІD_бренду'];
        echo " <li class='nav-item'>
                    <a href='index.php?brand=$brand_id' class='nav-link'>$brand_name</a>
                </li>";
    }
}
//display category in sidenav
function getcategory(){
    global $con;
    $select_category="select * from `Категорії`";
    $result_category=mysqli_query($con,$select_category);
    while($row_data=mysqli_fetch_assoc($result_category)){
        $category_name=$row_data['Назва категорії'];
        $category_id=$row_data['ІD_категорії'];
        echo " <li class='nav-item'>
                    <a href='index.php?category=$category_id' class='nav-link'>$category_name</a>
                </li>";
    }
}

//пошук
function search(){
    global $con;
    //перевірка isset or not
    if(isset($_GET['seach_btm'])){
        $search_text=$_GET['seach_data'];
        $search_query="select * from `Товари` where concat(`Назва товару`,`Опис товару`,`Атрибути товару`) like '%$search_text%'";
        //SELECT * FROM `Товари` WHERE `Назва товару` LIKE '%ф%' OR `Опис товару` LIKE '%ф%' OR `Атрибути товару` LIKE '%ф%'; //або так
        $result_query=mysqli_query($con,$search_query);
        //перевірка чи є такий запит
        $num_rows=mysqli_num_rows($result_query);
        if($num_rows==0){
            echo "<h4 class='text-start m-auto'>За вашим запитом нічого не знайдено.</h4>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['ІD_товару'];
                $product_name=$row['Назва товару'];
                $product_description=$row['Опис товару'];
                // $product_keywords=$row['Атрибути товару'];
                $product_category=$row['ID_категорії'];
                $product_brands=$row['ID_бренду'];
                $product_image1=$row['Зображення товару 1'];
                // $product_image2=$row['Зображення товару 2'];
                // $product_image3=$row['Зображення товару3'];
                $product_price=$row['Ціна товару'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                            <div class='card-body'>
                                <h6 class='card-title'>$product_name</h6>
                                <!-- <p class='card-text'>$product_description</p> -->
                                <p class='card-text'>$product_price грн.</p>
                                <a href='index.php?to_cart=$product_id' class='btn btn-dark'>До кошика</a>
                                <a href='view_details.php?product_id=$product_id' class='btn btn-secondary'>Переглянути більше</a>
                            </div>
                        </div>
                       </div>";
        }
    }
}

// view more func (вивід карточки одного товару)
function view_one_product(){
    global $con;
    //перевірка isset or not
    if(isset($_GET['product_id'])){
        if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
            $product_id=$_GET['product_id'];
                $select_query="select * from `Товари` where `ІD_товару` = '$product_id'";
                $result_query=mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $product_id=$row['ІD_товару'];
                    $product_name=$row['Назва товару'];
                    $product_description=$row['Опис товару'];
                    // $product_keywords=$row['Атрибути товару'];
                    $product_category=$row['ID_категорії'];
                    $product_brands=$row['ID_бренду'];
                    $product_image1=$row['Зображення товару 1'];
                    $product_image2=$row['Зображення товару 2'];
                    $product_image3=$row['Зображення товару 3'];
                    $product_price=$row['Ціна товару'];
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                                <div class='card-body'>
                                    <h6 class='card-title'>$product_name</h6>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>$product_price грн.</p>
                                    <a href='index.php?to_cart=$product_id' class='btn btn-dark'>До кошика</a>
                                    <!--<a href='view_details.php?product_id=$product_id' class='btn btn-secondary'>Переглянути більше</a>-->
                                </div>
                            </div>
                        </div>
                        <div class='col-md-8'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <h5 class='text-center mb-5'>Споріднені картинки</h5>
                                    </div>
                                    <div class='col-md-6'>
                                        <img src='./admin_panel/product_images/$product_image2' class='card-img-top' alt='$product_name'>
                                    </div>
                                    <div class='col-md-6'>
                                        <img src='./admin_panel/product_images/$product_image3' class='card-img-top' alt='$product_name'>
                                    </div>
                                </div>
                        </div>";
                }
            }
        }
        }
 }

 // ip -адреса
 function getIPAddress() {
    //whether ip is from the share internet
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    //whether ip is from the proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     }
//whether ip is from the remote address
    else{
             $ip = $_SERVER['REMOTE_ADDR'];
     }
     return $ip;
}

//додати в кошик
function add_to_cart(){
    if(isset($_GET['to_cart'])){
        global $con;
        $ip = getIPAddress();
        $get_prod_id=$_GET['to_cart'];
        $select_query="select * from `Деталі замовлення` where `IP_адреса` = '$ip' and `ІD_товару`=$get_prod_id";
        $result_query=mysqli_query($con,$select_query);
        //перевірка чи є такий запит, якщо є, то
        $num_rows=mysqli_num_rows($result_query);
        if($num_rows>0){
            echo "<script>alert('Цей товар вже існує в кошику')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
        else{
            $insert_query="insert into `Деталі замовлення` (`ІD_товару`,`IP_адреса`,`Кількість`) values ($get_prod_id,'$ip',1)";
            $result_query=mysqli_query($con,$insert_query);
            echo "<script>alert('Товар доданий в кошик')</script>";
            echo "<script>window.open('index.php','_self')</script>";

        }
    }
}
// лічильник товарів в кошику
function num_cart_items(){
    if(isset($_GET['to_cart'])){
        global $con;
        $ip = getIPAddress();
        $select_query="select * from `Деталі замовлення` where `IP_адреса` = '$ip'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
    }
    else{
        global $con;
        $ip = getIPAddress();
        $select_query="select * from `Деталі замовлення` where `IP_адреса` = '$ip'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
    }
    echo "$count_cart_items";
}

// загальна ціна кошика
function total_price(){
    global $con;
    $ip = getIPAddress();
    $total=0;
    $cart_query="select * from `Деталі замовлення` where `IP_адреса`='$ip'"; //беремо ip користувача, дізнаємося ід його замовлень
    $result=mysqli_query($con,$cart_query);
    while($row=mysqli_fetch_array($result)){
        $product_id=$row['ІD_товару'];
        $products="select * from `Товари` where `ІD_товару`='$product_id'"; //по ід товарів, знаходимо товар з табл всіх товарів
        $result_product=mysqli_query($con,$products);
        while($row_prod_price=mysqli_fetch_array($result_product)){
            $product_price=array($row_prod_price['Ціна товару']); //ціна одного (250) при 2 проході циклу 340
            $product_value=array_sum($product_price); //250, при другому 250+340=590
            $total+=$product_value; //0+250=250,
        }
    }
    echo $total;
}
// видалення з кошика
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove'])){
      foreach($_POST['remove_item'] as $remove_id){
        echo $remove_id;
        $delete_query="delete from `Деталі замовлення` where `ІD_товару`=$remove_id";
        $run_delete=mysqli_query($con,$delete_query);
        if($run_delete){
          echo "<script>window.open('cart.php','_self')</script>";
        }
      }
    }
}
// function value(){
//     global $con;
//     $ip = getIPAddress();
//     $s_query="select `Кількість` from `Деталі замовлення` where `IP_адреса`='$ip'"; //беремо ip користувача, дізнаємося ід його замовлень
//     $result=mysqli_query($con,$s_query);
//     while($row=mysqli_fetch_array($result)){
//         //$product_id=$row['ІD_товару'];
//         //$q_value="select `Кількість` from `Деталі замовлення` where `ІD_товару`='$product_id'";
//         $value=$row['Кількість'];
//         // $r_value=mysqli_query($con,$q_value);
//         // while($row=mysqli_fetch_assoc($r_value)){
//         //     $value=$row['Кількість'];
//         //     }
//     }
//     echo $value;

// }
// function increment(){
//     global $con;
//     $ip = getIPAddress();
//     if(isset($_GET['increment'])){
//         $quantity=$_GET['quantity'];
//         $quantity++;
//         $select_query="select `ІD_товару` from `Деталі замовлення` where `IP_адреса`='$ip'";
//         $query=mysqli_query($con,$select_query);
//         while($row=mysqli_fetch_assoc($query)){
//         $product_id=$row['ІD_товару'];
//         $update_cart="update `Деталі замовлення` set `Кількість`=$quantity where `IP_адреса`='$ip' and `ІD_товару`=$product_id"; //update `Деталі замовлення` set `Кількість`=2 where `IP_адреса`='127.0.0.1' and `ІD_товару`=1;
//         $res_quantity=mysqli_query($con,$update_cart);
//         // while($row=mysqli_fetch_array($res_quantity)){

//         // }
//         }
//     }
// }

// function price_one_product(){
//     $price="select `Ціна товару` from `Товари` where `ІD_товару`='$product_id'";
//     $ttal=$price*$quantity;
// }

// деталі замовлення користувача
function user_order_details(){
    global $con;
    $username=$_SESSION['username'];
    $details="select * from `Користувач` where `Ім’я користувача`='$username'";
    $result=mysqli_query($con,$details);        //виконати запит
    while($row=mysqli_fetch_array($result)){    //отримання даних з бази даних
        $user_id=$row['ІD_користувача'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['orders'])){
                if(!isset($_GET['delete_account'])){
                    $orders="select * from `Замовлення користувача` where `ID_користувача`=$user_id and `Статус замовлення`='очікують на розгляд'";
                    $result_orders=mysqli_query($con,$orders);
                    $count_rows=mysqli_num_rows($result_orders);
                    if($count_rows>0){
                        echo "
                            <h3 class='mt-2 mb-2'>Ви маєте <span>$count_rows</span> незавершених замовлення</h3>
                            <a href='profile.php?orders' class='text-success text-decoration-none'>Деталі замовлення</a>
                        ";
                    }
                    else{
                        echo "
                            <h3 class='mt-2 mb-2'>Ви маєте 0 незавершених замовленнь</h3>
                            <a href='../index.php' class='text-success text-decoration-none'>На головну сторінку</a>
                        ";
                    }
                }
            }
        }
    }
}