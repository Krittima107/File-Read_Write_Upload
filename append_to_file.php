<?php
/*$filename = "newfile.txt";
$text = "Jantharaporn" . date("Y-m-d H:i:s") . PHP_EOL;

// File_Append = เขียนต่อท้าย
file_put_contents($filename, $text, File_Append);

echo "บันทึกข้อมูลเรียบร้อย";*/

$myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
$txt = "rr\n";
fwrite($myfile, $txt);
$txt = "gg\n";
fwrite($myfile, $txt);
fclose($myfile);
?>