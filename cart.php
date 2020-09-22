<center><h1>Моя корзина</h1></center>

<?php
if($_REQUEST[add]){
DB::Query("INSERT INTO `cart` (`cart_client`,`cart_tov_id`) VALUES ('".session_id()."','".$_REQUEST[add]."')");

}
if($_REQUEST[empt]){
DB::Query("DELETE FROM `cart` WHERE (`cart_client`='".session_id()."')");

}
?>

<?php
$cartsql= DB::Query("SELECT * FROM cart WHERE cart_client='".session_id()."' ");

while ($cartlist=mysqli_fetch_array($cartsql)) 
{
$tovlist=mysqli_fetch_array(DB::Query("SELECT * FROM kod_tovar WHERE kod_tovar='".$cartlist[cart_tov_id]."' "));
	
	
$itog = $itog + $tovlist[cena];


$xstrana= mysqli_fetch_array(DB::Query("SELECT * FROM kod_strani WHERE kod_strani='".$tovlist[kod_strana]."' "));
$xcvet= mysqli_fetch_array(DB::Query("SELECT * FROM kod_cveta WHERE kod_cveta='".$tovlist[kod_cvet]."' "));
$xstil= mysqli_fetch_array(DB::Query("SELECT * FROM kod_stil WHERE kod_stil='".$tovlist[kod_stil]."' "));
$xmaterial= mysqli_fetch_array(DB::Query("SELECT * FROM kod_materiala WHERE kod_materiala='".$tovlist[kod_material]."' "));

echo '<li><img align=left src="img/'.$tovlist[kod_tovar].'.jpg"  width="200" height="200" border="3px" align="left" hspace="50" style="margin-left: 100px;">

<left><H2> '.$tovlist[nazvanie_tovara].'<br><br></H2><h3>
Изготовитель: '.$xstrana[nazvanie_strani].'<br>
Цвет: '.$xcvet[nazvanie_cveta].'<br>
Вес: '.$tovlist[ves].'<br>
Стиль: '.$xstil[naznavie_stil].'<br>
Материал: '.$xmaterial[nazvanie_materiala].'<br>
Цена: '.$tovlist[cena].' Р       <br><br></h3><h2></left><center>
</h2> 
</li></center><br><br>';


$cartfull = 1;
}
if($cartfull)
echo '<center><h2>Общая цена: '.$itog.' р<br><br><br><a href = "?act=kupit" >Заказать!</a></h2> <h2><a href = "?act=cart&empt=1" >Очистить</a></h2><h2><a href = "?act=cat" >В магазин</a></h2></center>';
else
echo ' <center><h2>Тут пусто
<img src="kot.gif">
</center></h2>';
?>