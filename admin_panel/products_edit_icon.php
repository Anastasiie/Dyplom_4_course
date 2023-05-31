<!-- edit one product? by click on icon edit-->

<?php 
    //display editing
    if(isset($_GET['edit_products'])){
        $edit_id=$_GET['edit_products'];
        $edit_products="select * from `Товари` where `ІD_товару`=$edit_id";
        $result_edit=mysqli_query($con,$edit_products);
        $row_edit=mysqli_fetch_assoc($result_edit);

        $edit_name=$row_edit['Назва товару']; 
        $edit_description=$row_edit['Опис товару'];
        $edit_keywords=$row_edit['Атрибути товару'];
        $edit_category=$row_edit['ID_категорії'];
        $edit_brands=$row_edit['ID_бренду'];
        $edit_image1=$row_edit['Зображення товару 1'];
        $edit_image2=$row_edit['Зображення товару 2'];
        $edit_image3=$row_edit['Зображення товару 3'];
        $edit_price=$row_edit['Ціна товару'];
        //for display category
        $categore_products="select * from `Категорії` where `ІD_категорії`='$edit_category'";
        $result_categore=mysqli_query($con,$categore_products);
        $row_categore=mysqli_fetch_assoc($result_categore);
        $category_name=$row_categore['Назва категорії'];
        //for display brands
        $brandde_products="select * from `Бренди` where `ІD_бренду`=$edit_brands";
        $result_brande=mysqli_query($con,$brandde_products);
        $row_brande=mysqli_fetch_assoc($result_brande);
        $brand_name=$row_brande['Назва бренду'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування товарів</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-2">Редагування товару</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- назва товару -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Назва товару</label>
                <input type="text" name="product_title" id="product_title" class="form-control" 
                placeholder="Введіть ім'я товару" autocomplete="off" required="required" value="<?php echo $edit_name ?>"> <!--requier for input in db-->
            </div>
            <!-- опис товару -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Опис товару</label>
                <input type="text" name="product_description" id="product_description" class="form-control" 
                placeholder="Введіть опис товару" autocomplete="off" required="required" value="<?php echo $edit_description ?>">
            </div>
            <!-- ключові слова -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Атрибути товару</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" 
                placeholder="Введіть атрибути товару" autocomplete="off" required="required" value="<?php echo $edit_keywords ?>">
            </div>
            <!-- категорії -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_category" class="form-label">Категорії товару</label>
                <select name="product_category" class="form-select">
                    <option><?php echo $category_name ?></option>
                    <?php 
                        $all_categore_products="select * from `Категорії`";
                        $result_categore_all=mysqli_query($con,$all_categore_products);
                        while($row_all_categore=mysqli_fetch_assoc($result_categore_all)){
                            $categores_names=$row_all_categore['Назва категорії'];
                            $categores_id=$row_all_categore['ІD_категорії'];
                            echo "
                                <option value='$categores_id'>$categores_names</option>
                            ";
                        }
                    ?>
                </select>
            </div>
            <!-- бренди -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_brands" class="form-label">Бренди товару</label>
                <select name="product_brands" class="form-select">
                    <option><?php echo $brand_name ?></option>
                    <?php 
                        $all_brandde_products="select * from `Бренди`";
                        $result_brande_all=mysqli_query($con,$all_brandde_products);
                        while($row_all_brande=mysqli_fetch_assoc($result_brande_all)){
                            $brandes_name=$row_all_brande['Назва бренду'];
                            $brandes_id=$row_all_brande['ІD_бренду'];
                            echo "
                                <option value='$brandes_id'>$brandes_name</option>
                            ";
                        }
                    ?>
                </select>
            </div>
            <!-- зображення -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Зображення товару 1</label>
                <div class="d-flex">
                    <input type="file" name="product_image1" id="product_image1" class="form-control w-90 m-auto" required="required">
                    <img src="./product_images/<?php echo $edit_image1 ?>" alt="" class="admin_products_images">
                </div>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Зображення товару 2</label>
                <div class="d-flex">
                    <input type="file" name="product_image2" id="product_image2" class="form-control w-90 m-auto" required="required">
                    <img src="./product_images/<?php echo $edit_image2 ?>" alt="" class="admin_products_images">
                </div>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Зображення товару 3</label>
                <div class="d-flex">
                    <input type="file" name="product_image3" id="product_image3" class="form-control w-90 m-auto" required="required">
                    <img src="./product_images/<?php echo $edit_image3 ?>" alt="" class="admin_products_images">
                </div>
            </div>
            <!-- ціна -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Ціна товару</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Введіть ціну товару" autocomplete="off" required="required" value="<?php echo $edit_price ?>">
            </div>
            <!-- кнопка -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="edit_product" class="btn btn-outline-success btn-sm mb-3 px-3" value="Зберегти">
            </div>
        </form>
    </div>
</body>
</html>

<!-- функціонал edit products (btn update) -->
<?php
    if(isset($_POST['edit_product'])){
        $edit_name=$_POST['product_title']; 
        $edit_description=$_POST['product_description'];
        $edit_keywords=$_POST['product_keywords'];
        $edit_category=$_POST['product_category'];
        $edit_brands=$_POST['product_brands'];
        $edit_price=$_POST['product_price'];
        $edit_status='Є в наявності';

        $edit_img1=$_FILES['product_image1']['name'];
        $edit_img2=$_FILES['product_image2']['name'];
        $edit_img3=$_FILES['product_image3']['name'];

        $temp_edit_img1=$_FILES['product_image1']['tmp_name'];
        $temp_edit_img2=$_FILES['product_image2']['tmp_name'];
        $temp_edit_img3=$_FILES['product_image3']['tmp_name'];
        // перевірка пустих
        if($edit_name=='' or $edit_description=='' or $edit_keywords=='' or $edit_category==''
        or $edit_brands=='' or $edit_price=='' or $edit_img1=='' or $edit_img2=='' or $edit_img3==''){
            echo "<script>alert('Заповніть всі доступні поля')</script>";
            // exit();
        }
        else{
        move_uploaded_file($temp_edit_img1,"./product_images/$edit_img1"); //додавання завантаж. img в папку
        move_uploaded_file($temp_edit_img2,"./product_images/$edit_img2");
        move_uploaded_file($temp_edit_img3,"./product_images/$edit_img3");
        //UPDATE `Товари` SET `Назва товару` = '1Чай Сенча Асамусі', `Опис товару` = '1Найпоширеніший сорт японського чаю, що славиться свіжим, витонченим смаком. Фінальний етап виробництва Сенча – фіксація парою. Листя чаю - світло-зелене з ніжним смаком та ароматом. В ньому дуже багато катехінів, тому підходить для ранкових чаювань.', `Атрибути товару` = '1Зелений чай,Zhongguocha,ніжний смак,тонізуючий', `ID_категорії` = '2', `ID_бренду` = '3', `Зображення товару 1` = 'fruitteacup.jpg', `Зображення товару 2` = 'fruitteacup.jpg', `Зображення товару 3` = 'fruitteacup.jpg', `Ціна товару` = '1237.50', `Дата` = NOW(), `Статус` = 'Є' WHERE `Товари`.`ІD_товару` = 1;
        $update_product="UPDATE `Товари` SET `Назва товару` = '$edit_name', `Опис товару` = '$edit_description', `Атрибути товару` = '$edit_keywords', `ID_категорії` = '$edit_category', `ID_бренду` = '$edit_brands', `Зображення товару 1` = '$edit_img1', `Зображення товару 2` = '$edit_img2', `Зображення товару 3` = '$edit_img3', `Ціна товару` = '$edit_price', `Дата` = NOW(), `Статус` = '$edit_status' WHERE `Товари`.`ІD_товару` = $edit_id";
        $result_update_edit=mysqli_query($con,$update_product);
        if($result_update_edit){
            echo "<script>alert('Товар змінено успішно')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
        }
    }
?>