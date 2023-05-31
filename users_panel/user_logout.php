<?php
    session_start();
    session_unset();//unset all variables inside session
    session_destroy();
    echo "<script>window.open('../index.php','_self')</script>";
?>