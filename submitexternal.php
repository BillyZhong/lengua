<?php
$valid_formats = array("pdf");
$path = ""; // Upload directory
$count = 0;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
			if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        }
	    }
	}
}
$output = NULL;
//exec('sudo python full_text_to_summarize.py bioterms.txt');
//exec('sudo python full_text_to_summaries.py uploads/biotext.txt', $output, $return); 

?>  

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/sandwich.css">
</head>
<body background= "background1.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 hidden-xs hidden-sm">
        <img src="assets/img/sandwich.png" class="headimgdesktop">
      </div>
      <div class="col-md-12 visible-xs visible-sm">
        <img src="assets/img/sandwich.png" class="headimgmini">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 hidden-xs hidden-sm" style="border-right:solid;border-color:rgb(189, 195, 199);border-width:2px;opacity:.5">
        <?php
		$fileopen = fopen('summaries.txt', 'r') or die('err');
		echo '<h2>Summary</h2><div class="well well-lg">';
		while(!feof($fileopen)){
			$line = stream_get_line($fileopen, filesize('summaries.txt'), "\n"); 
			echo '<h4>'.$line.'</h4>';
		}
		echo '</div>';
		fclose($fileopen);	
	?>
      </div>
      <div class="col-md-6">
	<table class="table table-condensed" style="font-weight:bold">
		<thead>
			<tr>
				<th>Key Topic</th>
				<th>Slide Number</th>
				<th>Key Topic</th>
				<th>Page Number</th>
			</tr>
		</thead>
		<thbody>
			<?php
				$fileopen = fopen('pptresults.txt', 'r') or die("err");
				$fileopen2 = fopen('pagenumbers.txt', 'r') or die("err2");
				while(!feof($fileopen)||!feof($fileopen2)){
					echo '<tr>';
					$templine = fgets($fileopen);
					$temp = explode(',', $templine);
					echo '<td>'.$temp[0].'</td>';
					echo '<td>'.$temp[1].'</td>';
					$templine2 = fgets($fileopen2);
					$temp2 = explode(',', $templine2);
					echo '<td>'.$temp2[0].'</td>';
					echo '<td>'.$temp2[1].'</td>';
					echo '</tr>';
				}
				fclose($fileopen);
				fclose($fileopen2);
			?>
		</thbody>
	</table>
      </div>
	</div>
  </div>
</body>
</html>