<!-- дисплей таблички в профілі "замовлення" -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $name=$_SESSION['username'];
        $userrrrr="select * from `Користувач` where `Ім’я користувача`='$name'";
        $result_user=mysqli_query($con,$userrrrr);
        $row_fetch=mysqli_fetch_assoc($result_user);
        $us_id=$row_fetch['ІD_користувача'];
    ?>
    <h3 class='mt-2 mb-4'>Мої замовлення</h3>
    <table class="table table-bordered mt-5 text-center">
        <thead class="bg-light">
        <tr>
            <th>Серійний №</th>
            <th>Сума до сплати</th>
            <th>Номер накладної</th>
            <th>Кількість товарів</th>
            <th>Дата замовлення</th>
            <th>Завершено/Незавершено</th>
            <th>Статус замовлення</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $order_details="select * from `Замовлення користувача` where `ID_користувача`=$us_id";
            $result_order_details=mysqli_query($con,$order_details);
            $nymber=1;
            while($row_order=mysqli_fetch_assoc($result_order_details)){
                $id_order=$row_order['ID_замовлення'];
                $amount_due=$row_order['Сума до сплати'];
                $invoice_number=$row_order['Номер накладної'];
                $all_prod=$row_order['Всі замовлення'];
                $order_date=$row_order['Дата замовлення'];
                $status_order=$row_order['Статус замовлення'];
                if($status_order=='очікують на розгляд'){
                    $status_order='Незавершено';
                }
                else{
                    $status_order='Завершено';
                }
                echo "
                    <tr>
                        <td>$nymber</td>
                        <td>$amount_due грн.</td>
                        <td>$invoice_number</td>
                        <td>$all_prod</td>
                        <td>$order_date</td>
                        <td>$status_order</td>";
                ?>
                <?php
                    if($status_order=='Завершено'){
                        echo "<td class='text-success'>Сплачено</td>";
                    }
                    else{
                        echo "
                        <td><a href='confirm_payment.php?order_id=$id_order'>Очікує підтвердження</a></td>
                    </tr>";
                    }
                
                $nymber++;
            }
        ?>
            
        </tbody>
    </table>
</body>
</html>
