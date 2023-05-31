<?php
include('../includes/connect.php');
if(isset($_POST['brands_insert'])) //if click btn - txt from placeholder - in БД 
{
    $name_brand=$_POST['brands_title'];
    //select даних з бд, перевірка чи існує
    $select_query="select * from `Бренди` where `Назва бренду`='$name_brand'";
    $r_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($r_select);
    if($number>0){
        echo "<script>alert('Такий бренд вже існує в базі даних!')</script>";
    } // якщо не існує - додати
    else{
        $insert_query="insert into `Бренди` (`Назва бренду`) values ('$name_brand')";
        $result=mysqli_query($con,$insert_query);
        if($result){
            echo "<script>alert('Бренд доданий успішно.')</script>";
        }
    }
}
?>
<h2 class="text-center">Додати бренд</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-file"></i></span>
        <input type="text" class="form-control" name="brands_title" 
        placeholder="Додати бренди" aria-label="Brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="b-light btn btn-outline-success" name="brands_insert" 
        value="OK">
    </div> 
</form>