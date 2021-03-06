<?php
chdir('uploads');
foreach (glob("*.txt") as $filename) {
	unlink($filename);
}
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