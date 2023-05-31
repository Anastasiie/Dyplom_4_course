<?php
    if(isset($_GET['edit_brand'])){
        $id_edit_brand=$_GET['edit_brand'];
        $select_edit_query="select * from `Бренди` where `ІD_бренду`='$id_edit_brand'";
        $result_select_edit=mysqli_query($con,$select_edit_query);
        $row_edit=mysqli_fetch_assoc($result_select_edit);
        $edit_brand_name=$row_edit['Назва бренду'];
    }
    if(isset($_POST['brande_edit'])){
        $br_name=$_POST['brand_name'];
        //update
        $update_brand="update `Бренди` set `Назва бренду`='$br_name' where `ІD_бренду`='$id_edit_brand'";
        $result_br=mysqli_query($con,$update_brand);
        if($result_br){
            echo "<script>alert('Бренд змінений успішно')</script>";
            echo "<script>window.open('./index.php?view_brands','_self')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бренд</title>
</head>
<body>
    <div class="container mt-2"></div>
        <h2 class="text-center">Бренд</h2>
        <form action="" method="post" class="text-center">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="brande_name" class="form-label">Назва бренду</label>
                <input type="text" name="brand_name" id="brande_name" class="form-control" required="required" autocomplete="off" value="<?php echo $edit_brand_name; ?>">
            </div>
            <input type="submit" class="btn btn-outline-success px-3 mb-3" name="brande_edit" value="Зберегти">
        </form>
    </div>
</body>
</html>