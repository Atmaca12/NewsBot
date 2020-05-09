<?php include_once "fonk.php";
$sinif= new botumuz;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<title>HABER BOTU YAPIMI</title>

</head>

<body>
 <script>
 
 $(document).ready(function(){

$('form input[type=button]').click(function(){

var gelenbuton=$(this);
var bilgiyiyakala=gelenbuton.prev();
var iskeletiyakala=gelenbuton.parents('.yazilariskelet');
var checkboxyakala=gelenbuton.next();

$.ajax({
    type:'POST',
    url:'islem.php?islemtipi=ajaxteklipost',
    data: gelenbuton.parents('#vericek').serialize(),
    beforeSend:function(){
bilgiyiyakala.html('BASLADİ <BR>');
gelenbuton.replaceWith("<img src='res/ekleload.gif' class='mt-3'> ");
checkboxyakala.hide();
    },
    success : function(){
        bilgiyiyakala.html('YAPILIYOR <BR>');
    },
    complete: function(){
        iskeletiyakala.fadeOut();
    },
    error: function(){
        
    }


});

});

$('#tumekle').click(function(){

    $('form input[type=button]').trigger('click');

var gelenbuton=$(this);
var tumbilgiyiyakala=gelenbuton.prev();


$.ajax({
    type:'POST',
    url:'islem.php?islemtipi=ajaxteklipost',
    data: gelenbuton.parents('#vericek').serialize(),
    beforeSend:function(){
        tumbilgiyiyakala.html('BASLADİ <BR>');
gelenbuton.replaceWith("<img src='res/sayfa.gif' id='load' class='mt-3'> ");
    },
    success : function(){
        tumbilgiyiyakala.html('YAPILIYOR <BR>');
    },
    complete: function(){
        tumbilgiyiyakala.html('EKLENDİ <BR>');
        $('#load').hide();
       
    },
    error: function(){
        
    }


});

});

$('#secekle').click(function(){

    $('form input[type=checkbox]:checked').each(function(){
$(this).prev().trigger('click');

    });



var gelenbuton=$(this);
var tumbilgiyiyakala=gelenbuton.prev();



$.ajax({
type:'POST',
url:'islem.php?islemtipi=ajaxteklipost',
data: gelenbuton.parents('#vericek').serialize(),
beforeSend:function(){
    tumbilgiyiyakala.html('BASLADİ <BR>');
gelenbuton.replaceWith("<img src='res/sayfa.gif' id='load' class='mt-3'> ");
},
success : function(){
    tumbilgiyiyakala.html('YAPILIYOR <BR>');
},
complete: function(){
    tumbilgiyiyakala.html('EKLENDİ <BR>');
    $('#load').hide();
   
},
error: function(){
    
}


});

});

$('#sec').click(function(){

$('form input[type=checkbox]').prop('checked',true);

});

$('#kaldir').click(function(){

$('form input[type=checkbox]').prop('checked',false);

});

});
 
 </script>


</body>

</html>


<div class="container-fluid h-100">



    <div class="row h-100">
        <div class="col-lg-2 border-right  colrenklendir">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h4>HABER BOTU</h4>
                </div>

                <div class="col-lg-12 linkarkaplan mt-2 mb-1 pt-2 pb-2"><a href="index.php?islem=tumunucek">Tüm verileri Çek</a></div>
                <div class="col-lg-12 linkarkaplan mt-2 mb-1 pt-2 pb-2"><a href="index.php?islem=katcek">Kategoriye Göre Çek</a></div>
                <div class="col-lg-12 linkarkaplan mt-2 mb-1 pt-2 pb-2"><a href="#">## Başka linkler gelecek</a></div>
            </div>


        </div>

        <div class="col-lg-10">
        <?php
switch(@$_GET['islem']){
    case'tumunucek':


        $yazilar=$sinif->tumhaberal("http://localhost/BotTestSistemi/",$db);

echo '<div class="row text-center">
<div class="col-lg-12 p-2 ustbar">
<div class="row">
<div class="col-lg-1"></div>
<div class="col-lg-2"></div>
<div class="col-lg-2"></div>
<div class="col-lg-3">
<input type="button" id="sec" value="Tümünü Sec" class="btn btn-dark mt-2">
<input type="button" id="kaldir" value="Tümünü kaldır" class="btn btn-dark mt-2">
</div>

<div class="col-lg-2"><span class="tumbilgi"></span>
<input type="button" id="secekle" value="Secilenleri Ekle" class="btn btn-dark mt-2"></div>
<div class="col-lg-2"> 
<span class="tumbilgi"></span>
<input type="button" id="tumekle" value="Tumunu Ekle" class="btn btn-dark mt-2"></div>
</div>
</div>
';
foreach($yazilar as $key => $value){ ?>
<form id="vericek">
<div class="col-lg-10 mx-auto yazilariskelet mt-2">
                    <div class="row text-center">
                        <div class="col-lg-3"><img class="card-img-top" src="http://localhost/BotTestSistemi/<?=$yazilar[$key]['yazi_resim']?>" height="200"></div>  
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-12">BAŞLIK</div>
                                <div class="col-lg-12"><input type="text" name="haberbaslik" value="<?=$yazilar[$key]['yazi_baslik']?>"class="form-control"></div>
                                <div class="col-lg-12">İÇERİK</div>
                                <div class="col-lg-12"><textarea name="habericerik" class="form-control" rows="4"><?=$yazilar[$key]['yazi_ozet']?></textarea></div>

                            </div>
                        </div>
                        <div class="col-lg-2">
                        <div class="row">
                        <div class="col-lg-12">
                        <span class="bilgi"></span>
                        <input type="button" name="gonder" value="EKLE" class="btn btn-success mt-2">
                        <input type="checkbox"  class="checkbox mt-3 ml-3 ">
                        </div></div>
                        <input type="hidden" name="res" value="<?=$yazilar[$key]['yazi_resim']?>"class="form-control">
                        </div>
                        



                    </div>
                </div></form>


<?}
echo '</div>';

 

break;
    case'katcek':
        
    break;
    default:
    echo'islemler burda yapılacakw';
  
}

?>


        </div>

    </div>
</div>





<?php
//tüm haberleri alacagız
/*
$kaynak=curlbasla('http://localhost/BotTestSistemi/');
$desen = '@id="karisikhaber">\s*(.*?)\s*<!-- Haberler bitti-->@si';

preg_match_all($desen,$kaynak,$sonuc);





preg_match_all('@<div class="col-lg-4 col-md-4 col-sm-4 mt-2">\s*<div class="card h-100">\s*<a href="(.*?)"><img class="card-img-top" src="(.*?)" height="200"></a>\s*<div class="card-body">\s*<h4 class="card-title">\s*<a id="haberlink" href="(.*?)">(.*?)</a>\s*</h4>\s*<p class="card-text">(.*?)</p>\s*</div>\s*</div>@si',$sonuc[1][0],$detayal);




$yazilar=array();

for($i=0;$i<count($detayal[1]);$i++){
    $yazilar[]=array(
        'yazi_resim'=>$detayal[2][$i],
        'yazi_link'=>$detayal[1][$i],
        'yazi_baslik'=>$detayal[4][$i],
        'yazi_ozet'=>$detayal[5][$i],
        'yazi_id'=>$detayal[3][$i]
    );

}

echo"<pre>";
print_r($yazilar);
echo"</pre>";


//---------------------------------------------------------------------
/*
//kategorileri cekiyoruz
$kaynak=curlbasla('http://localhost/BotTestSistemi/');
$desen = '@<a class="nav-link" href="(.*?)">(.*?)</a>@';

preg_match_all($desen,$kaynak,$sonuc);

echo"<pre>";
print_r($sonuc);
echo"</pre>";
*/
?>