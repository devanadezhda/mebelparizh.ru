<center><h2>Счастливые обладатели нашей мебели!</h2>
<?php
$xgal= DB::Query("SELECT * FROM galereya ");
while ($xfoto=mysqli_fetch_array($xgal)) 
{
echo '<img src="'.$xfoto[galereya_name].'" width="550" height="300" border="3px" style="margin-top:30px;">';
}
?>
<p><h2>Будьте счастливы вместе с мебелью "Париж"! :) </h2></p>
</center>