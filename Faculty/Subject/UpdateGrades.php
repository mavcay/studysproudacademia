<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="studentstyles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #004aad;
            color: #ffffff;
        }

        h1, h3 {
            color: #ffffff;
            margin: 20px 0;
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            padding: 20px;
            margin-left: 15%;
        }

        .card {
            background-color: #ffde59;
            border: none;
            border-radius: 5px;
            width: calc(25% - 20px);
            overflow: hidden;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card a {
            text-decoration: none;
            color: #000000;
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 10px;
            text-align: center;
        }

        .sidebar {
            width: 15%;
            padding: 15px;
            background-color: #ffde59;
            color: #fff;
            text-align: center;
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .sidebar img {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
            margin-top: 20px;
        }

        .list-group-item {
            background-color: #ffde59;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .list-group-item a {
            color: #fff;
            text-decoration: none;
        }

        .list-group-item:hover {
            background-color: #001e3d;
        }

        .selected {
            background-color: #001e3d;
        }

        #grades-table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
            table-layout: fixed;
        }

        #grades-table th,
        #grades-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: small;
        }

        #grades-table th {
            background-color: black;
            font-weight: bold;
            color: white;
        }

        #updateButton, #goBackButton {
            align-items: center;
            justify-content: center;
            margin-top: 3%;
        }
    </style>
    <title>Study Sprout Academia Update Grade</title>
</head>

<body>
    <h1>Study Sprout Academia</h1>
    <h3>Update Grades</h3>
    <hr class="solid">

<?php
if (!isset($_SESSION['CurrentSub'])) {
  $_SESSION['CurrentSub'] = 1; // Replace 1 with the actual subject ID you want to use
}

include '../../classes.php';
require_once '../../db_config.php';
$subjectQuery = "SELECT Subject_Name FROM subject WHERE Subject_ID = ".$_SESSION['CurrentSub'].";";
$subjectResult = $db->query($subjectQuery);

$subjectName = "Unknown Subject"; // Default value
if ($subjectResult->num_rows > 0) {
    $subjectRow = $subjectResult->fetch_assoc();
    $subjectName = $subjectRow["Subject_Name"];
}

$subID = $_SESSION['CurrentSub'];
$sql = "SELECT s.Student_ID, s.Student_FName, s.Student_MInitial, s.Student_LName, e.Stud_FinalGrade, e.Remarks
FROM student s
INNER JOIN enrollment e ON s.Student_ID = e.Student_ID
WHERE e.Subject_ID = ".$subID.";";
$result = $db->query($sql);

echo '<form method="post" action="">
<table id="grades-table">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Final Grade</th>
      <th>Remarks</th>
    </tr>
  </thead>
  <tbody>';

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $ID = $row["Student_ID"];
    $FN = $row["Student_FName"];
    $MI = $row["Student_MInitial"];
    $LN = $row["Student_LName"];
    $FinGrade = $row["Stud_FinalGrade"];
    $remarks = $row["Remarks"];
    echo "<tr>";
    echo "<td>".$ID."</td>";
    echo "<td>".$FN." ".$MI.", ".$LN."</td>";
    echo "<td><input type='text' name='final_grade_".$ID."' value='".$FinGrade."'></td>";
    echo "<td>".$remarks."</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='5'>No records found</td></tr>";
}

echo '</tbody>
</table>

<center>
  <button style="margin-top: 3%;" id="updateButton" type="submit" name="update">Update</button>
  <br>
  <a href="javascript:history.back()">
    <button id="goBackButton" type="button" class="btn btn-secondary">Go Back</button>
  </a>
</center>
</form>';

if (isset($_POST['update'])) {
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'final_grade_') !== false) {
      $ID = substr($key, 12); // Extract the student ID from the input name
	  if($value > 100 || $value < 0){
		  echo "Invalid Grade";
	  }
	  else {
		  $FinGrade = $value; // Get the updated final grade from the form
		  if($FinGrade >= 75){
			  $remarks = "Passed";
		  }
		  else
			$remarks = "Failed";
		  // Update the Enrollment table with the new final grade and remarks
		  $updateQuery = "UPDATE enrollment SET Stud_FinalGrade = '".$FinGrade."', Remarks = '".$remarks."' WHERE Student_ID = ".$ID." AND Subject_ID = ".$subID.";";
		  $db->query($updateQuery);
	  }
    }
  }
  echo "<p>Enrollment table updated successfully</p>";
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
