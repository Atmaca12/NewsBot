<?php


$db = new PDO("mysql:host=localhost;dbname=botkayit;charset=utf8","root","annebabq123");




class botumuz{
public $yazilar=array();
public $kayit=array();

function curlbasla($url){
$oturum=curl_init($url);
curl_setopt_array($oturum,array(
CURLOPT_RETURNTRANSFER =>true
));
$sonuc=curl_exec($oturum);
return $sonuc;


}

function kayticek($db){

$sec=$db->prepare("SELECT * FROM localtablo");
$sec->execute();

while($cek=$sec->fetch(PDO::FETCH_ASSOC)){
   
    $this->kayit[]=$cek['baslik'];
}

}


function tumhaberal($url,$db){
  $this->kayticek($db);
$kaynak=$this->curlbasla($url);
$desen = '@id="karisikhaber">\s*(.*?)\s*<!-- Haberler bitti-->@si';

preg_match_all($desen,$kaynak,$sonuc);




preg_match_all('@<div class="col-lg-4 col-md-4 col-sm-4 mt-2">\s*<div class="card h-100">\s*<a href="(.*?)"><img class="card-img-top" src="(.*?)" height="200"></a>\s*<div class="card-body">\s*<h4 class="card-title">\s*<a id="haberlink" href="(.*?)">(.*?)</a>\s*</h4>\s*<p class="card-text">(.*?)</p>\s*</div>\s*</div>@si',$sonuc[1][0],$detayal);




for($i=0;$i<count($detayal[1]);$i++){

    $kaynakk=$this->curlbasla($url.$detayal[1][$i]);

preg_match_all('@id="habericerik">(.*?)</div>@si',$kaynakk,$icerikal);

if(in_array($detayal[4][$i],$this->kayit)){
continue;
}

    $this->yazilar[]=array(
        'yazi_resim'=>$detayal[2][$i],
        'yazi_link'=>$detayal[1][$i],
        'yazi_baslik'=>$detayal[4][$i],
        'yazi_ozet'=>$icerikal[1][0],
        'yazi_id'=>$detayal[3][$i]
    );

}
return $this->yazilar;
}


}




?>
