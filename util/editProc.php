<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
error_reporting(E_ALL); //TODO #set_error_reporting
ini_set("display_errors", 1);
require('admin_config.php');
if (strcmp($_POST['password'], 'dontkillthefrogs') != 0
        || $_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  echo strcmp($_POST['password'], 'dontkillthefrogs');
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  //echo "Stored in: " . $_FILES["file"]["tmp_name"];
  $separator='/';
  if($_POST['path'] == '') {
      $separator='';
  }
  $end= "../" . $_POST['path'] . $separator . $_FILES["file"]["name"];
  $success = move_uploaded_file($_FILES["file"]["tmp_name"], $end);
  if($success) { echo 'Success <br />';} else {echo 'Bad upload <br />' .
$_FILES['file']['error'] . '<br />';}
  echo "Stored in: " . $end;
  }
  //arbitrary script hack
  //unlink('install.php');
  //
?>
<br />
<div> <p> Another? </p> </div>
<br />
<form action="editProc.php" method="post"
enctype="multipart/form-data">
<label for="password">Passtest:</label>
<input type="password" name="password" id ="password" />
<br />
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<br />
<label for="path">Path:</label>
<input type="text" name="path" value="" id ="path" />
<br />

<input type="submit" name="submit" value="Submit" />
</form>

<!--
    Authors: Derek Leung
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->
