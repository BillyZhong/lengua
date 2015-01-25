<?php
$speech = $_GET['txt1'];
chmod("/somedir/somefile", 0644);
print $speech;
$ourFileName = "testFile.txt";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fclose($ourFileHandle);
?>
