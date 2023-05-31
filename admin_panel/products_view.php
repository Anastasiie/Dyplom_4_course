<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перегляд товарів</title>
</head>
<body>
    <h2 class="text-center">Всі товари: </h2>
    <table class="table table-bordered mt-2 text-center">
        <thead class="bg-light">
            <tr>
                <th>№ з/п</th>
                <th>Назва товару</th>
                <th>Зображення товару</th>
                <th>Ціна товару</th>
                <th>Всього продано</th>
                <th>Статус</th>
                <th>Змінити</th>
                <th>Видалити</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $get_products="select * from `Товари`";
            $result_products=mysqli_query($con,$get_products);
            $number=0;
            while($row=mysqli_fetch_assoc($result_products)){
                $id_product=$row['ІD_товару'];
                $product_name=$row['Назва товару'];
                //$product_description=$row['Опис товару'];
                // $product_keywords=$row['Атрибути товару'];
                //$product_category=$row['ID_категорії'];
                //$product_brands=$row['ID_бренду'];
                $product_image1=$row['Зображення товару 1'];
                //$product_image2=$row['Зображення товару 2'];
                //$product_image3=$row['Зображення товару 3'];
                $product_price=$row['Ціна товару'];
                //$product_date=$row['Дата'];
                $product_status=$row['Статус']; //present- true, else - false class='text-start'
                $number++;
        ?>
                <tr>
                    <td><?php echo $number ?></td>
                    <td><?php echo $product_name ?></td>
                    <td><img src='./product_images/<?php echo $product_image1 ?>' alt='' class='admin_products_images'></td>
                    <td><?php echo $product_price ?></td>
                    <td>
                    <?php //Всього продано
                        $get_sold="select * from `Замовлення в розгляді` where `ID_товару`=$id_product";
                        $result_sold=mysqli_query($con,$get_sold);
                        $rows_count=mysqli_num_rows($result_sold);
                        echo "$rows_count";
                    ?>
                    </td>
                        <td><?php echo $product_status ?></td>
                        <td><a href='index.php?edit_products=<?php echo $id_product ?>'><i class='fa-regular fa-pen-to-square'></i></a></td>
                        <td><a href='index.php?delete_products=<?php echo $id_product ?>'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
        <?php  
            }
        ?>
        </tbody>
    </table>
</body>
</html>