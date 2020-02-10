<form name="form1" method="post" action="">
	<tr>

		<td><input type="radio" name="secenek" id="radio" value="txt">TXT</td>
		</tr>
	<tr>
		<td><input type="radio" name="secenek" id="radio" value="word">WORD</td>
	</tr>	
	<tr>
		<td align="right"><input type="submit" name="gönder" id="gönder" value="GÖNDER">
			
		</td>
	</tr>
	<pre>
<?php
include 'SimpleXLSX.php';

error_reporting(0);

$db =new mysqli('127.0.0.1','serap','kUR9gEt42QqZTHPT', 'serap');
$hatalar=array();
if(isset($_POST['secenek'])){
	$secenek=$_POST['secenek'];
	
}else
		$hatalar[]="Tip seciniz";
if($secenek=='txt'){

		$dosya=fopen('staj.txt', 'r');
$icerik_txt=fread($dosya, filesize('staj.txt'));
$kelime_txt=explode(" ", $icerik_txt);
echo "Dosya:".'<br>'.'<br>';

for($i=0;$i<20;$i++){
	echo $kelime_txt[$i] ;
	echo " ".'<br>';
}
echo '<br>';
fclose($dosya);
$query="SELECT * FROM kelime_listesi";
if($result=$db->query($query)){
	for($i=0;$i<100;$i++){
		$row=$result->fetch_assoc();
					$satir_txt[$i]=$row['kelime'];
				}
			
		}
		echo '<br>';
echo "Veri tabanı:"."<br>"."<br>";
for($j=0;$j<20;$j++){
	echo $satir_txt[$j].'<br>';
}
echo '<br>';
$sayac1=0;
for($a=0;$a<=20;$a++){
	for($b=0;$b<=20;$b++){
		if($kelime_txt[$a]==$satir_txt[$b]){
			
			
			$ortaklar_txt[$sayac_txt]=$kelime_txt[$a];

            $sayac_txt++;
		}
	}
}
echo "Ortaklar "."<br>";
for($c=0;$c<20;$c++){
	echo $ortaklar_txt[$c];
}
print_r(array_count_values($ortaklar_txt));

	
}
elseif ($secenek=='word') {
	echo "Word Dosyası"."<br>"."<br>";
 
$filename = "deneme.docx";// or /var/www/html/file.docx

$icerik_word=read_file_docx($filename);
$kelime_word=explode(" ", $icerik_word);
for($i=0;$i<20;$i++){
	echo $kelime_word[$i];
}
echo $kelime_word[1];
if($icerik_word !== false) {

	/*for($i=0;$i<15;$i++){
		echo $satir2[$i];
	}*/
    //echo nl2br($content);
}
else {
    echo 'Couldn\'t the file. Please check that file.';
}


		$query="SELECT * FROM kelime_listesi";
if($result=$db->query($query)){
	for($i=0;$i<100;$i++){
		$row=$result->fetch_assoc();
					$satir_txt[$i]=$row['kelime'];
				}
			
		}
		echo '<br>';
echo "Veri tabanı:"."<br>"."<br>";
for($j=0;$j<20;$j++){
	echo $satir_txt[$j].'<br>';
}
echo '<br>';

$sayac2=0;
for($d=0;$d<=20;$d++){
	for($e=0;$e<=20;$e++){
		if($kelime_word[$d]==$satir_txt[$e]){
			
			
			$ortaklar_word[$sayac_word]=$kelime_word[$d];

            $sayac_word++;
		}
	}
}
echo "Ortaklar "."<br>";
for($f=0;$f<20;$f++){
	echo $ortaklar_word[$f];
}
print_r(array_count_values($ortaklar_word));
	
}
function read_file_docx($filename){

    $striped_content = '';
    $content = '';

    if(!$filename || !file_exists($filename)) return false;

    $zip = zip_open($filename);

    if (!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }// end while

    zip_close($zip);

    //echo $content;
    //echo "<hr>";
    //file_put_contents('1.xml', $content);

    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);

    return $striped_content;
}


?>
	</pre>