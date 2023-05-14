<?php

// INSERT INTO `register` (`id`, `login`, `pass`, `d_reg`, `Email`, `sex`) VALUES (NULL, 'test', MD5('test'), UTC_TIMESTAMP(), '123@mail.ru', 'male');

session_start();
$bd_gr2 = new mysqli("localhost","root","","basegr2");
$bd_gr2 -> query("SET NAME * 'UTF8'");
$error_message = "";
if (isset ($_POST["send"])) {
    if ($_POST["login"] && $_POST["pass1"] && $_POST["pass2"] && $_POST["email"]) {
        if (filter_var ($_POST ["email"], FILTER_VALIDATE_EMAIL)) {
            if($_POST["pass1"] == $_POST["pass2"]) {
                $login = $_POST["login"];
                $query = $bd_gr2 -> query("SELECT * FROM `register` WHERE `login` = '$login';");
                if(mysqli_num_rows($query) == 0) {
                    $email = $_POST["email"];
                    $query2 = $bd_gr2 -> query("SELECT * FROM `register` WHERE `Email` = '$email';");
                    if(mysqli_num_rows($query2) == 0) {
                        $pass = $_POST["pass1"];
                        $sex = $_POST["sex"];
                        $bd_gr2 -> query("INSERT INTO `register`  (`login`, `pass`, `Email`, `sex`)
                        VALUES ('$login', MD5('$pass'), '$email', '$sex');");
                        header( ("LOCATION: index.php"));
                    }
                    else $error_message = "Эта электронная почта уже используется";
                }
                else $error_message = "Данный логин уже зарегистрирован";
            }
            else $error_message = "Пароли не совпадают";
        }
        else $error_message = "Вы указали неверный формат электронной почты";
    }
    else $error_message = "Заполнены не все поля";
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
    <form name="registration"  method ="post">
        <fieldset>
            <legend>Регистрация</legend>
    <label><input type="text" name="login" placeholder="login"></label><br>
    <label><input type="password" name="pass1" placeholder="Введите пароль"></label><br>
    <label><input type="password" name="pass2" placeholder="Повторите пароль"></label><br>
    <label><input type="email" name="email" placeholder="Email@"></label><br>
    <label>Укажите ваш пол:</label><br>
    <div><input type="radio" name="pol" id="male" value="male"><label>Мужчина</label><br>
    <input type="radio" name="sex" id="male" value="male"><label>Женщина</label>
    </div>
    </fieldset>
    <input type="submit" name="send" value="Зарегистрироваться"><br>
    <a href="http://localhost/gr2/avtorizacia.php">Авторизоваться</a><br>
    <span style="color:red;"><?=$error_message?></span><br>
    </form>
</body>
</html>





<!-- <!DOCTYPE html>
<html>
<head>
    <title>Обратная связь</title>
</head>
<body>
    <h2>Форма обратной связи</h2>
    <form name="feedback" action="" method="post">
        <label>От кого: </label><br />
        <input type="text" name="from" value="<?=$_SESSION["from"]?>" />
        <span style="color:red;"><?=$error_from?></span> <br/>
        <label>Кому </label><br />
        <input type="text" name="to" value="<?=$_SESSION["to"]?>" />
        <span style="color:red;"><?=$error_to?></span> <br/>
        <label>Тема </label><br />
        <input type="text" name="subject" value="<?=$_SESSION["subject"]?>"  />
        <span style="color:red;"><?=$error_subject?></span> <br/>
        <label>Сообщение </label><br />
        <textarea name="message"  cols="10" rows="20"> <?=$_SESSION["message"]?> </textarea>
        <span style="color:red;"><?=$error_message?> </span> <br/>
        <input type="submit" name="send" value="Отправить" />
    </form>
    
</body>
</html> -->