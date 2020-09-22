<?php
session_start ();
header('Content-Type: text/html; charset=utf-8');
define ( 'ROOT_DIR', dirname ( __FILE__ ) ); true;// true;//mysql_connect("std-mysql", "std_395", "kiro3693") or die( mysqli_error(DB::$link));
class DB
{
    static $link;
    static $count = 0; 
    
    public static function connect()
    {// @TODO Change the data connection
        @self::$link = mysqli_connect('std-mysql', 'std_395', 'kiro3693', 'std_395') 
                       or die('No connect (' . mysqli_connect_errno() . ') '
                                             . mysqli_connect_error()); 
     // @TODO Change the encoding   
        mysqli_set_charset(self::$link, 'utf8');    
    }

    
    public static function escape($data)   
    {
        if(is_array($data))
            $data = array_map('self::escape', $data);
        else              
            $data = mysqli_real_escape_string(self::$link, $data);
        
        return $data;
    }     
    
    
    public static function Query($sql, $print = false) 
    {
        self::$count++;
        
        $result = mysqli_query(self::$link, $sql); 
// @TODO Remove the following lines when in production mode 
// ..............................................     
        if($result === false || $print === 1) 
        { 
            $error =  mysqli_error(self::$link);
            $trace =  debug_backtrace(); 
            $out   = array(1 => '');
            
            if(!empty($error))
                preg_match("#'(.+?)'#is", $error, $out);
          
            $head = $error ? '<b style="color:red">MySQL error: </b><br> 
            <b style="color:green">'. $error .'</b><br><br>':NULL;     
          
            $error_log = date("Y-m-d h:i:s") .' '. $head .' 
            <b>Query: </b><br> 
            <pre><span style="color:#990099">'
            . str_replace($out[1], '<b style="color:red">'. $out[1] .'</b>', $trace[0]['args'][0])
            .'</pre></span><br><br>
            <b>File: </b><b style="color:#660099">'. $trace[0]['file'] .'</b><br> 
            <b>Line: </b><b style="color:#660099">'. $trace[0]['line'] .'</b>'; 
            die($error_log); 
        } 
        else 
// ..............................................
            return $result; 
    }  
	
    static public function result($res, $row, $column = 0)
    {
	    $i = 0;
		
        while($data = mysqli_fetch_array($res, MYSQLI_BOTH))
		{
		    if($row == $i++)
			    return $data[$column];
		}
    }
	
    function deprecated($function)
    {
       $trace =  debug_backtrace(); 
     
       exit('<strong style="color:red">Fatal error:</strong><br>'
           .'Function <a href="http://php.net/'. $function .'">'. $function .'</a>'
           .' is deprecated and has no analog in <br>'
           .'<strong>'. $trace[0]['file'] .'</strong>'            
           .' on line <strong>'. $trace[0]['line'] .'</strong>'
           );
    }   
} 

    DB::connect();
?>
<!DOCTYPE html>
<html>
<head>
<title>Мебель "Париж"</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" href = "site.css">
</head>
<body>
<div id = "main">
<div id = "header">
<div id = "title">
<div class="cssload-loader">Мебель Париж</a>
</div>
</div>
<ul id = "about">
<h2><p>8 800 555 3535</p><h2>
<h2><p>Часы работы:</p></h2>
<h2><p>10:00-20:00</p></h2>
</ul>
</div>
<table bgcolor="pink" width="100%" align="center">
  
<tr>
    <td> <a href="?">Главная</a><a href="?act=magazy">Магазины</a><a href="?act=cat">Продукция</a><a href = "?act=onas">О нашей фирме</a><a href="?act=galereya">Галерея</a><a href = "?act=cart">Корзина</a></td>
  </tr>
</table>




<?php

if($_REQUEST[act]=="cat" or $_REQUEST[act]=="cart" ){
echo '<table>
<tr >
<td width="400" valign="top">
<div id = "sidebar">
<ul class = "menu">
';
$catsql= DB::Query("SELECT * FROM kod_kategorii ");
while ($catlist=mysqli_fetch_array($catsql)) 
{
echo '<h2><li><a href = "?act=cat&cat='.$catlist[kod_kategorii].'" >'.$catlist[nazvanie_kategorii].'</a></li><h2>';
}

echo '
</ul>
</div></td><td valign="top">
';
}
?>
<div id = "content">
<?php
if(!$_REQUEST[act])
require_once ROOT_DIR . '/glavnaya.php';
if($_REQUEST[act]=="onas")
require_once ROOT_DIR . '/onas.php';
if($_REQUEST[act]=="cat")
require_once ROOT_DIR . '/cat.php';
if($_REQUEST[act]=="cart")
require_once ROOT_DIR . '/cart.php';
if($_REQUEST[act]=="kupit")
require_once ROOT_DIR . '/kupit.php';
if($_REQUEST[act]=="galereya")
require_once ROOT_DIR . '/galereya.php';


if($_REQUEST[act]=="magazy")
require_once ROOT_DIR . '/magazy.php';

if($_REQUEST[act]=="post")
require_once ROOT_DIR . '/post.php';
?>
</div>
</td></tr>
<table>

<div id = "footer"><center><h4>Тут все права защищены</h4></div>
</div>
</body>
</html>