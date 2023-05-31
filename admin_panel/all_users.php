<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All users</title>
</head>
<body>
    <h2 class="text-center">Користувачі</h2>
    <table class="table table-bordered mt-2 text-center">
        <thead class="bg-light">
            <?php 
                $get_users="select * from `Користувач`";
                $result_users=mysqli_query($con,$get_users);
                $row_users=mysqli_num_rows($result_users);
                
                if($row_users==0){
                    echo"<h2 class='text-danger text-center mt-2'>Користувачів поки що немає</h2>";
                }
                else{
                echo "
                <tr>
                    <th>№ з/п</th>
                    <th>Ім’я користувача</th>
                    <th>Пошта</th>
                    <th>Аватарка користувача</th>
                    <th>Адреса користувача</th>
                    <th>Номер телефону</th>
                    <th>Видалити</th>
                </tr>
        </thead>
        <tbody>
                ";
                    $number=0;
                    while($row_ord=mysqli_fetch_assoc($result_users)){
                        $user_name=$row_ord['Ім’я користувача'];
                        $user_email=$row_ord['Пошта'];
                        $user_img=$row_ord['Аватарка користувача'];
                        $user_adress=$row_ord['Адреса користувача'];
                        $user_telephone=$row_ord['Номер телефону'];
                        $number++;

                        echo "
                        <tr>
                            <td>$number</td>
                            <td>$user_name</td>
                            <td>$user_email</td>
                            <td><img src='../users_panel/users_img/$user_img' alt='$user_name' class='edit_account_img'></td>
                            <td>$user_adress</td>
                            <td>$user_telephone</td>
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