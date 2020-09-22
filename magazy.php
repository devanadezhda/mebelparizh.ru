<center><h1>Наши магазины</h1></center>








<?php
$magsql= DB::Query("SELECT * FROM kod_filiala ");
while ($maglist=mysqli_fetch_array($magsql)) 
{
$xaddr= mysqli_fetch_array(DB::Query("SELECT * FROM kod_adresa_filiala WHERE kod_adresa_filiala='".$maglist[kod_filiala]."' "));
$xgorod= mysqli_fetch_array(DB::Query("SELECT * FROM kod_goroda WHERE kod_goroda='".$xaddr[kod_goroda]."' "));
$xreg= mysqli_fetch_array(DB::Query("SELECT * FROM kod_regiona WHERE kod_regiona='".$xgorod[kod_regiona]."' "));

echo '
<table>
<tr>
<td width="450"><h3><p>Филиал №'.$maglist[kod_filiala].'  '.$xreg[nazvanie_regiona].'</p>
<p>Адрес: '.$xgorod[nazvanie_goroda].', ул. '.$xaddr[ulica].', дом '.$xaddr[dom].'</p>
<p>Номер: 8 800 '.$maglist[telefon].'</p></td>
<td width="400"><script type="text/javascript" charset="utf-8" async src="'.$xaddr[karta_filiala].'"></script></td>
</tr>
</table>
<br>
<br>
';



}



?>