<?php
session_start();
$bd_gr2 = new mysqli("localhost","root","","basegr2");
$bd_gr2 -> query("SET NAME * 'UTF8'");
$error_message = "";
if (isset($_POST['send'])){
    if($_POST['pass1'] && $_POST['login']!= ''){
                $login = $_POST["login"];
                $query = $bd_gr2-> query("SELECT * FROM `register` WHERE `login`='$login';");
                if(mysqli_num_rows($query) == 0){
                    $error_message = 'Пользователя не существует';
                }else{
                  $pass = $_POST['pass1'];
                  $query2 = $bd_gr2 -> query("SELECT `pass` FROM `register` WHERE `login` = '$login';");
                  $row = mysqli_fetch_assoc($query2);
                  if($row["pass"] != MD5("$pass")){
                    $error_message = 'Неверный пароль!';
                  }else{
                    $error_message = 'uura';
                    
                    header('LOCATION: success.php');
                  }
                }
        
        
    }
}
$bd_gr2 -> close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form name="avtoriz"  method ="post">
        <fieldset>
            <legend>Авторизация</legend>
    <label><input type="text" name="login" placeholder="Введите login"></label><br>
    <label><input type="password" name="pass1" placeholder="Введите пароль"></label><br>
    </fieldset>
    <input type="submit" name="send" value="Войти"><br>
    <span style="color:red;"><?=$error_message?></span><br><br>
     <a href="http://localhost/gr2/registr.php">Зарегистрироваться</a><br>
    
    </form>
</body>
</html>