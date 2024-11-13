<?php
session_start();

   // Retrieve the task ID from the query string
   $subID = $_GET['course'];

   // Set the session variable
   $_SESSION['CurrentSub'] = $subID;

   // Redirect back to the original page
   header('Location: Subject.php');
   exit;
?>