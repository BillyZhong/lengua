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
	$fileo = $filename;
	echo $fileo;
	$myfile = fopen($fileo, "r") or die("Unable to open file!");
	echo fread($myfile,filesize($fileo));
	fclose($myfile);
	echo $filename .'<div class="well well-lg" style="color:#F5F5F5;opacity:.7"><h4 type="text/plain">uploads/'.$filename  .'
</h4></div>';
}
?>

      </div>
      <div class="col-md-6">
 <form action="submitexternal.php" method="post" enctype="multipart/form-data">
    <input type="file"  class="btn btn-primary" id="file" name="files[]" multiple="" accept=".pdf" />
<center><p>Attach pdf of textbook</p></center>
        <input type="file" class="btn btn-primary" id="file" name="files[]" multiple="" accept=".pdf" />
<center><p>Attach pdf of powerpoint</p></center>
<br>
<center>Enter first page number of Glossary:<br></center>
<div class="col-md-7">
<input type = "text" class="form-control" name = "glossaryNum">
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
