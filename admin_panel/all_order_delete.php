<?php
    if(isset($_GET['delete_orders'])){
        $id_delete_brand=$_GET['delete_brand'];

        $delete_query="delete from `Бренди` where `ІD_бренду`='$id_delete_brand'";
        $result_delete=mysqli_query($con,$delete_query);
        
        if($result_delete){
            echo "<script>alert('Бренд видалений успішно')</script>";
            echo "<script>window.open('./index.php?view_brands','_self')</script>";
        }
    }
?>