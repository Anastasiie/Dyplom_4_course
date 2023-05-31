<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Всі бренди</title>
</head>
<body>
    <h2 class="text-center">Бренди</h2>
    <table class="table table-bordered mt-2 text-center">
        <thead class="bg-light">
                <tr>
                    <th>№ з/п</th>
                    <th>Назва бренду</th>
                    <th>Змінити</th>
                    <th>Видалити</th>
                </tr>
        </thead>
        <?php 
            $select_brand="select * from `Бренди`";
            $result_select_brand=mysqli_query($con,$select_brand);
            $number=0;
            while($row=mysqli_fetch_assoc($result_select_brand)){
                $brand_id=$row['ІD_бренду'];
                $brand_name=$row['Назва бренду'];
                $number++;
        ?>
        <tbody>
            <tr>
                <td><?php echo $number;?></td>
                <td><?php echo $brand_name;?></td>
                <td><a href='index.php?edit_brand=<?php echo $brand_id?>'><i class='fa-regular fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_brand=<?php echo $brand_id?>' type="button" data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
            </tr>
        <?php 
            }
        ?>
        </tbody>
    </table>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <h4>Ви впевнені що бажаєте видалити це?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal"><a href="./index.php?view_brands" class="text-light">Ні</a></button>
            <button type="button" class="btn btn-danger"><a href="index.php?delete_brand=<?php echo $brand_id?>" class="text-light">Так</a></button>
        </div>
    </div>
  </div>
</div>