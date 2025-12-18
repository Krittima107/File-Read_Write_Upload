<?php
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Krittima\n";
fwrite($myfile, $txt);
fclose($myfile);
echo "บันทึกข้อมูลเรียบร้อย";
?>