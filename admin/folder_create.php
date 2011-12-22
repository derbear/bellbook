<?php
error_reporting(E_ALL); //TODO #set_error_reporting
ini_set("display_errors", 1);
if(isset($_GET['name'])) {
    $dir=$_GET['name'];
    $success=mkdir('../' . $dir);
    if($success) {
        echo $dir." was successfully created! ";
    } else {
        echo "Failed to create " .$dir;
    }
} else {
?>
<form action="folder_create.php" method="get">
    <label for="name">Folder name: </label> <input type="text" name="name" />
    <input type="submit" />
</form>
<?
}
