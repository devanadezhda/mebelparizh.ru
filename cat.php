<?php
if(!$_REQUEST[cat])
echo '
<center><h2>Пожалуйста, выберите категорию товара в боковом меню.</h2></center>

';
if($_REQUEST[cat])
echo "<center><h1>Товары в категории:</h1></center>";


$tovsql= DB::Query("SELECT * FROM kod_tovar WHERE kod_kategoriya='".$_REQUEST[cat]."' ");
//$tovsql= DB::Query("SELECT * FROM tov WHERE tov_cat_name='".$_REQUEST[cat]."' ");
while ($tovlist=mysqli_fetch_array($tovsql)) 
{
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
<a href = "?act=cart&add='.$tovlist[kod_tovar].'" >В корзину!</a></h2> 
</li></center><br><br>';

}
?>