<?php





$adminemail="devanadezda@yandex.ru";  // e-mail админа 
 //$adminemail="449@bk.ru";  // e-mail админа 
 
$date=date("d.m.y"); // число.месяц.год 
 
$time=date("H:i"); // часы:минуты:секунды 
 
$backurl="?";  // На какую страничку переходит после отправки письма 
 
//---------------------------------------------------------------------- // 
 
  
 
// Принимаем данные с формы 
 
$name=$_POST['name']; 
 
$email=$_POST['email']; 
$msg="<h3>Заказ с сайта от ".$_POST['name'].".\n 
Телефон: ".$_POST['tele'].". \n
Адрес доставки: ".$_POST['adres']."\n
Заказ:\n\n

"; 
 
  
 
// Проверяем валидность e-mail 
 
//if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is", strtolower($email))) 
 
 //{ 
 
 // echo "<center>Вернитесь <a href='javascript:history.back(1)'><B>назад</B></a>. Вы указали неверные данные!"; 
 
 // } 
 
 //else 
 
 //{ 
 
 

 
$cartsql= DB::Query("SELECT * FROM cart WHERE cart_client='".session_id()."' ") ;
while ($cartlist=mysqli_fetch_array($cartsql) ) 
{
	
$tovlist=	mysqli_fetch_array(DB::Query("SELECT * FROM kod_tovar WHERE kod_tovar='".$cartlist[cart_tov_id]."' "));

$msg .= $tovlist[kod_tovar].' '.$tovlist[nazvanie_tovara]."\n\n

";
#############################++++++++++++++++++++++++++++++++++++++++++++++++++++++
$zakaz = $zakaz.$tovlist[kod_tovar]."-".$tovlist[nazvanie_tovara].',
 ';
#############################++++++++++++++++++++++++++++++++++++++++++++++++++++++
}

 
 // Отправляем письмо админу  
 
 
 $headers = 'From: webmaster@mospolytech.ru' . "\r\n" .
    'Reply-To: webmaster@mospolytech.ru' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//mail($adminemail, "$date $time Сообщение от $name", $msg, $headers);
 

// Сохраняем в базу данных 
#############################++++++++++++++++++++++++++++++++++++++++++++++++++++++
DB::Query("INSERT INTO `zakaz` (`name`,`tele`,`email`,`adres`,`zakaz`) VALUES ('".$name."','".$_POST['tele']."','".$email."','".$_POST['tele']."','".$zakaz."')");
#############################++++++++++++++++++++++++++++++++++++++++++++++++++++++
 
 
 
$f = fopen("message.txt", "a+"); 
 
fwrite($f," \n $date $time Сообщение от $name"); 
 
fwrite($f,"\n $msg "); 
 
fwrite($f,"\n ---------------"); 
 
fclose($f); 
 
  
 
// Выводим сообщение пользователю 
 
print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 10000); 
//--></script> 
 
$msg 
 
<p>Сообщение отправлено! Подождите, сейчас вы будете перенаправлены на главную страницу...</p>";  
//exit; 
 
 //} 
DB::Query("DELETE FROM `cart` WHERE (`cart_client`='".session_id()."')");
?>