<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All orders</title>
</head>
<body>
    <h2 class="text-center">Всі замовлення</h2>
    <table class="table table-bordered mt-2 text-center">
        <thead class="bg-light">
            <?php 
                $get_orders="select * from `Замовлення користувача`";
                $result_orders=mysqli_query($con,$get_orders);
                $row_orders=mysqli_num_rows($result_orders);
                
                if($row_orders==0){
                    echo"<h2 class='text-danger text-center mt-2'>Замовлень поки що немає</h2>";
                }
                else{
                echo "
                <tr>
                    <th>№ з/п</th>
                    <th>Сума до сплати</th>
                    <th>Номер накладної</th>
                    <th>Кількість товарів</th>
                    <th>Дата замовлення</th>
                    <th>Статус замовлення</th>
                    <th>Видалити</th>
                </tr>
        </thead>
        <tbody>
                ";
                    $number=0;
                    while($row_ord=mysqli_fetch_assoc($result_orders)){
                        $order_id=$row_ord['ID_замовлення'];
                        $user_id=$row_ord['ID_користувача'];
                        $order_amount=$row_ord['Сума до сплати'];
                        $order_invoice=$row_ord['Номер накладної'];
                        $order_all=$row_ord['Всі замовлення'];
                        $order_date=$row_ord['Дата замовлення'];
                        $order_status=$row_ord['Статус замовлення'];
                        $number++;

                        echo "
                        <tr>
                            <td>$number</td>
                            <td>$order_amount</td>
                            <td>$order_invoice</td>
                            <td>$order_all</td>
                            <td>$order_date</td>
                            <td>$order_status</td>
                            <td><a href='index.php?delete_orders=<?php echo $order_id?>' type='button' data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>
                        ";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <h4>Ви впевнені що бажаєте видалити це?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal"><a href="./index.php?all_orders" class="text-light">Ні</a></button>
            <button type="button" class="btn btn-danger"><a href="index.php?delete_orders=<?php echo $order_id?>" class="text-light">Так</a></button>
        </div>
    </div>
  </div>
</div>