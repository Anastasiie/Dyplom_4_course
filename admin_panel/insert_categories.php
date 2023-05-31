<?php
include('../includes/connect.php');
if(isset($_POST['insert_categ'])) //if click btn - txt from placeholder - in БД 
{
    $name_category=$_POST['title_categ'];
    //select даних з бд, перевірка чи існує
    $select_query="select * from `Категорії` where `Назва категорії`='$name_category'";
    $r_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($r_select);
    if($number>0){
        echo "<script>alert('Така категорія вже існує в базі даних!')</script>";
    } // якщо не існує - додати
    else{
        $insert_query="insert into `Категорії` (`Назва категорії`) values ('$name_category')";
        $result=mysqli_query($con,$insert_query);
        if($result){
            echo "<script>alert('Категорія додана успішно.')</script>";
        }
    }
}
?>

<h2 class="text-center">Додати категорію</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-mug-saucer"></i></span>
        <input type="text" class="form-control" name="title_categ" 
        placeholder="Додати категорії" aria-label="Categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="btn btn-outline-success" name="insert_categ" 
        value="OK">
        <!-- <button class="  btn-sm btn-block">OK</button>-->
    </div> 
</form>