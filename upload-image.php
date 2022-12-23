<!DOCTYPE html>
<html>
  <head>
    <title>Picture Story</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <script src="script.js" type="text/javascript"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="container">
      <?php include("html/header.html")?>
      <div class="page-title">
        <h1>Upload Pictures</h1>
      </div>
      <div class="w-25 p-1" style="background-color: #afafafc7;" id="line"></div>
      <div id="upload">
        <form method="post" enctype="multipart/form-data">
          <input type="file" name="upload" accept=".png, .gif, .jpg" required>
          <input type="submit" name="submit" onclick="showNote()" value="Upload">
        </form>
      </div>
      <div class="good" id="note" onmousedown='hideNote()'>
        Succesfully Uploaded
      </div>
      <!--<div class="bad" id="note" onmousedown='hideNote()'>
        Failed to Upload
      </div>-->
    </div>
    <?php
      // SAVE IMAGE INTO DATABASE
      if (isset($_FILES["upload"])) {
        require "backend/lib.php";
        $_DBIMG->save($_FILES["upload"]["name"], file_get_contents($_FILES["upload"]["tmp_name"]));
      } 
    ?>
    <script>
      
    </script>
  </body>
</html>