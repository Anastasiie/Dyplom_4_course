<?php
    if(isset($_GET['edit_category'])){
        $id_edit_category=$_GET['edit_category'];
        $select_edit_query="select * from `Категорії` where `ІD_категорії`='$id_edit_category'";
        $result_select_edit=mysqli_query($con,$select_edit_query);
        $row_edit=mysqli_fetch_assoc($result_select_edit);
        $edit_category_name=$row_edit['Назва категорії'];
    }
    if(isset($_POST['categ_edit'])){
        $cat_name=$_POST['category_name'];
        //update
        $update_category="update `Категорії` set `Назва категорії`='$cat_name' where `ІD_категорії`='$id_edit_category'";
        $result_cat=mysqli_query($con,$update_category);
        if($result_cat){
            echo "<script>alert('Категорія змінена успішно')</script>";
            echo "<script>window.open('./index.php?view_categories','_self')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категорія</title>
</head>
<body>
    <div class="container mt-2"></div>
        <h2 class="text-center">Категорія</h2>
        <form action="" method="post" class="text-center">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="categore_name" class="form-label">Назва категорії</label>
                <input type="text" name="category_name" id="categore_name" class="form-control" required="required" autocomplete="off" value="<?php echo $edit_category_name; ?>">
            </div>
            <input type="submit" class="btn btn-outline-success px-3 mb-3" name="categ_edit" value="Зберегти">
        </form>
    </div>
</body>
</html>