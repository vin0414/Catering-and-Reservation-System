<?php
session_start();
//save
include("resources/dbconfig.php");
$act = "Logged Out";
$date = date('Y-m-d h:i:s a');
$stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
$stmt->bindParam(':datetime',$date);
$stmt->bindParam(':user',$_SESSION['sess_id']);
$stmt->bindParam(':activity',$act);
$stmt->execute();
session_destroy();
$_SESSION["loggedin"] = false;

// Redirect to login page
header("location: https://zephaniah-catering.com/");
exit;
?>