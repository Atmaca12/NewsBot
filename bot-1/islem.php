<?php 
include 'fonk.php';
switch(@$_GET['islemtipi']){
case'normpost':
/*
    foreach($_POST['haberbaslik'] as $key =>$value ){
echo $value;
    }
*/
if($_POST){
$baslik=$_POST['haberbaslik'];
$icerik=$_POST['habericerik'];
$resim=$_POST['res'];

$save=$db->prepare("INSERT INTO localtablo SET 
baslik=:baslik,
icerik=:icerik,
resim=:resim
");

$rescek=file_get_contents("http://localhost/BotTestSistemi/".$resim);
$uzan=explode(".",$resim);
$uzanti=".".end($uzan);
$asama1=str_shuffle("sfasfFASFas".mt_rand(0,212312));
$dosyaad="res/".$asama1.$uzanti;

$indir=fopen($dosyaad,'a+');
fwrite($indir,$rescek);
fclose($indir);

$insert=$save->execute(array(
    'baslik'=>$baslik,
    'icerik'=>$icerik,
    'resim'=>$dosyaad
));
if($insert){
    echo 'ekleme basarılı';
}else{
    echo 'ekleme basarısız';
}
}else{

}
break;
case'ajaxteklipost':
    if($_POST){
        $baslik=$_POST['haberbaslik'];
        $icerik=$_POST['habericerik'];
        $resim=$_POST['res'];
        
        $save=$db->prepare("INSERT INTO localtablo SET 
        baslik=:baslik,
        icerik=:icerik,
        resim=:resim
        ");
        
        $rescek=file_get_contents("http://localhost/BotTestSistemi/".$resim);
        $uzan=explode(".",$resim);
        $uzanti=".".end($uzan);
        $asama1=str_shuffle("sfasfFASFas".mt_rand(0,212312));
        $dosyaad="res/".$asama1.$uzanti;
        
        $indir=fopen($dosyaad,'a+');
        fwrite($indir,$rescek);
        fclose($indir);
        
        $insert=$save->execute(array(
            'baslik'=>$baslik,
            'icerik'=>$icerik,
            'resim'=>$dosyaad
        ));
        if($insert){
            echo 'ekleme basarılı';
        }else{
            echo 'ekleme basarısız';
        }
        }else{
        
        }
break;
}



?>