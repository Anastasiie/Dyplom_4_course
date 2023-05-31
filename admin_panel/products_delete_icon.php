<!-- delete one product? by click on trash icon-->
<?php
    if(isset($_GET['delete_products'])){
        $delete_id=$_GET['delete_products'];

        $delete_query="delete from `Товари` where `ІD_товару`=$delete_id";
        $result_delete=mysqli_query($con,$delete_query);
        if($result_delete){
            echo "<script>alert('Товар видалено успішно')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
?>