<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){ // button name - insert_product
    $product_title=$_POST['product_title']; // введена назва товару
    $product_description=$_POST['product_description']; // введений в поле опис товару
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];
    $product_status='Є в наявності';
    // images
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];
    //image tmp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];
    // перевірка пустих
    if($product_title=='' or $product_description=='' or $product_keywords=='' or $product_category==''
    or $product_brands=='' or $product_price=='' or $product_image1=='' or $product_image2=='' or $product_image3==''){
        echo "<script>alert('Заповніть всі доступні поля')</script>";
        exit();
    }
    else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1"); //додавання завантаж. img в папку
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");
        // echo"'$product_title','$product_description,'$product_keywords','$product_category','$product_brands',
        // '$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status'";
        //insert query
        $insert_products="INSERT INTO `Товари`(`Назва товару`, `Опис товару`, `Атрибути товару`, `ID_категорії`, `ID_бренду`, `Зображення товару 1`, `Зображення товару 2`, `Зображення товару 3`, `Ціна товару`, `Дата`, `Статус`) values ('$product_title','$product_description','$product_keywords','$product_category','$product_brands','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
        echo "<script>alert('Товари додано успішно')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати товар - Панель Адміністратора</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
    crossorigin="anonymous">
</html>
    <!-- font awesome link, icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <!--css file-->
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Додати товар</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- назва товару -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Назва товару</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Введіть ім'я товару" autocomplete="off" required="required"> 
                <!--requier for input in db-->
            </div>
            <!-- опис товару -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Опис товару</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Введіть опис товару" autocomplete="off" required="required">
            </div>
            <!-- ключові слова -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Атрибути товару</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Введіть атрибути товару" autocomplete="off" required="required">
            </div>
            <!-- категорії -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Оберіть категорію</option>
                    <?php
                        $select_query="select * from `Категорії`";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query))
                        {
                            $category_title=$row['Назва категорії'];
                            $category_id=$row['ІD_категорії'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>
            </div>
            <!-- бренди -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="form-select">
                    <option value="">Оберіть бренд</option>
                    <?php
                        $select_query="select * from `Бренди`";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query))
                        {
                            $brand_title=$row['Назва бренду'];
                            $brand_id=$row['ІD_бренду'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </select>
            </div>
            <!-- зображення 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Зображення товару 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>
            <!-- зображення 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Зображення товару 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
            </div>
            <!-- зображення 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Зображення товару 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
            </div>
            <!-- ціна -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Ціна товару</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Введіть ціну товару" autocomplete="off" required="required">
            </div>
            <!-- кнопка -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-outline-success btn-sm mb-3 px-3" value="Зберегти">
            </div>
        </form>
    </div>
    
</body>
</html>