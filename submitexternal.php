<?php
$valid_formats = array("pdf");
$path = "uploads/"; // Upload directory
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
$output = null; 
chdir('pdfreference');
exec('sudo python full_text_to_summarize.py bioterms.txt');
exec('sudo python readppt.py', $output, $return); 
exec('sudo python test.py', $output, $return); 

chdir('/var/www/html/sandwich/');
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
        <h1 class="text-center " style="padding-right:50px"> ABOUT SANDWICH </h1>
	<h3 class="text-center " style="padding-right:50px">Using a transcribed or recorded lecture, Sandwich is a studying supplement that compiles a list of key topics from the lecture, and provides a plethora of external resources, including related web information, powerpoint slides, and an index of corresponding, relevant textbook information. The automization of education allows students to efficiently learn more and participate in educational dialogue.</h3>
      </div>
      <div class="col-md-3 visible-xs visible-sm">
        <h2 class="text-center "> ABOUT SANDWICH </h2>
      </div>
      <div class="col-md-6">
        <div class="row" id="transcript">
          <div class="col-md-12">
            <h1 class="text-center col-md-12"> STEP 1 </h1>
            <h2 class=" col-md-12 text-center"> CHOOSE METHOD </h2>
          </div>
          <div class="col-md-12 text-center">
             <a href="record.html" class="btn btn-info btn-lg" id="record">RECORD LECTURE</a>
          </div>
          <div class="col-md-12 text-center">
          </div>
           <div class="col-md-12 text-center">
            <h4>OR</H4>
           </div>
           <div class="col-md-12 text-center">
             <a class="btn btn-info btn-lg" id="p">SUBMIT TRANSCRIPT</a>
             <div id="g" class="text-center">
              <form action="submittranscript.php" method="post" enctype="multipart/form-data">
<br>
             <center><input type=file  class="btn btn-primary" id="fileToUpload" name="fileToUpload" href="submittranscript.php" accept=".txt"></center>
<br>
    <input type="submit" class="btn btn-info btn-lg" value="UPLOAD TEXT" name="submit">
</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $("#g").hide();
  $("#p").click(function(){
    $("#g").show();
  });
});
</script>
             </div>
           </div>
          </div>
        </div>
      </div>
  </div>
</body>
</html>