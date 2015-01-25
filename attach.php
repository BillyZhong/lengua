<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/sandwich.css">
</head>
<body>
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
      <div class="col-md-6">
        <?php
        chdir('uploads');	
foreach (glob("*.txt") as $filename) {
	$myfile = fopen($filename, "r") or die("Unable to open file!");
	$filedata = fread($myfile, filesize($filename));
	echo '<h2>'.$filename.'</h2><div class="well well-lg" style="opacity:.7"><h4>'. $filedata .
'</h4></div>';
	fclose($myfile);
}
?>

      </div>
      <div class="col-md-6">
 <form action="submitexternal.php" method="post" enctype="multipart/form-data">
    	<label for="textbook">Attach pdf of textbook</label>
	<input type="file"  class="btn btn-primary" id="textbook" name="files[]" multiple="" accept=".pdf" />
	<label for="powerpoint">Attach powerpoint</label>
        <input type="file" class="btn btn-primary" id="powerpoint" name="files[]" multiple="" accept=".pdf" />
<br>
<div class="col-md-7">
<label for="glossaryNum">Enter first page number of Glossary</label>
<input type = "text" class="form-control" name = "glossaryNum" id="glossaryNum">
</div>
<br>
<div class="col-md-12">
  <input type="submit" class="btn btn-info btn-lg" value="UPLOAD RESOURCES" />
</div>
</form>
      </div>
    </div>
  </div>
</body>
</html>
