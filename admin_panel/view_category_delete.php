<?php
    if(isset($_GET['delete_category'])){
        $id_delete_category=$_GET['delete_category'];

        $delete_query="delete from `Категорії` where `ІD_категорії`='$id_delete_category'";
        $result_delete=mysqli_query($con,$delete_query);
        
        if($result_delete){
            echo "<script>alert('Категорія видалена успішно')</script>";
            echo "<script>window.open('./index.php?view_categories','_self')</script>";
        }
    }
?>