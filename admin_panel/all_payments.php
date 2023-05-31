<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All payments</title>
</head>
<body>
    <h2 class="text-center">Всі платежі</h2>
    <table class="table table-bordered mt-2 text-center">
        <thead class="bg-light">
            <?php 
                $get_payments="select * from `Платежі користувачів`";
                $result_payments=mysqli_query($con,$get_payments);
                $row_payments=mysqli_num_rows($result_payments);
                
                if($row_payments==0){
                    echo"<h2 class='text-danger text-center mt-2'>Платежів поки що немає</h2>";
                }
                else{
                echo "
                <tr>
                    <th>№ з/п</th>
                    <th>Номер накладної</th>
                    <th>Сума</th>
                    <th>Спосіб оплати</th>
                    <th>Дата</th>
                    <th>Видалити</th>
                </tr>
        </thead>
        <tbody>
                ";
                    $number=0;
                    while($row_pay=mysqli_fetch_assoc($result_payments)){ 
                        $pay_id=$row_pay['ID_платежів'];
                        $ord_id=$row_pay['ID_замовлення'];
                        $payment_invoice=$row_pay['Номер накладної'];
                        $payment_amount=$row_pay['Сума'];
                        $payment_method=$row_pay['Спосіб оплати'];
                        $payment_date=$row_pay['Дата'];
                        $number++;

                        echo "
                        <tr>
                            <td>$number</td>
                            <td>$payment_invoice</td>
                            <td>$payment_amount</td>
                            <td>$payment_method</td>
                            <td>$payment_date</td>
                            <td><a href='#' type='button' data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>
                        ";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>