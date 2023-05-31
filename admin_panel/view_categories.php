<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Всі категорії</title>
</head>
<body>
    <h2 class="text-center">Категорії</h2>
    <table class="table table-bordered mt-2 text-center">
        <thead class="bg-light">
                <tr>
                    <th>№ з/п</th>
                    <th>Назва категорії</th>
                    <th>Змінити</th>
                    <th>Видалити</th>
                </tr>
        </thead>
        <?php 
            $select_category="select * from `Категорії`";
            $result_select_category=mysqli_query($con,$select_category);
            $number=0;
            while($row=mysqli_fetch_assoc($result_select_category)){
                $category_id=$row['ІD_категорії'];
                $category_name=$row['Назва категорії'];
                $number++;
        ?>
        <tbody>
            <tr>
                <td><?php echo $number;?></td>
                <td><?php echo $category_name;?></td>
                <td><a href='index.php?edit_category=<?php echo $category_id?>'><i class='fa-regular fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_category=<?php echo $category_id?>'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
        <?php 
            }
        ?>
        </tbody>
    </table>
</body>
</html>