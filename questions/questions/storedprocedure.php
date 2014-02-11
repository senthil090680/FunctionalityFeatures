<?php
$con = mysql_connect("localhost","root","",false,65536);


//THIS IS TO SHOW HOW THE TRIGGER WORKS IN PHP SCRIPT
mysql_select_db('storedprocdb',$con);

$dataresquery                               =		mysql_query("INSERT INTO fruit (apple,orange,watermelon,jack) VALUES ('24',-58,'24','58') ");

echo $datarow      =		mysql_insert_id();
echo $datarow      =		mysql_affected_rows();


//This is used to show how the stored procedures work using PHP
mysql_select_db('epub_publish',$con);

$insert_id  = 7;

$dataresquery                               =		mysql_query('CALL getSettingId('.$insert_id.',@settingId,@presetName,@presetSet,@epubVersion,@outputType,@bookTitle,@coverImage,@resol,@supportDevice,@fixedLay,@openSpread,@interActive,@specificFont,@fontName,@oriLock,@epubFolder,@pdfFile,@pdfPages,@activityFolder,@createdDate)');
$dataresquery                               =		mysql_query('SELECT @settingId,@presetName,@presetSet,@epubVersion,@outputType,@bookTitle,@coverImage,@resol,@supportDevice,@fixedLay,@openSpread,@interActive,@specificFont,@fontName,@oriLock,@epubFolder,@pdfFile,@pdfPages,@activityFolder,@createdDate');

$datarow      =		mysql_fetch_array($dataresquery);

echo "<pre>";
print_r($datarow);
echo "</pre>";

?>