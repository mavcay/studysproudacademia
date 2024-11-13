<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Sprouts Academia</title>
    <style>
			body {
				margin: 0;
				padding: 0;
				font-family: Verdana, Geneva, Tahoma, sans-serif;
				background-color: #EAE7E1;
				color: black;
				display: flex;
				flex-direction: column;
				align-items: center;
			}

			/* Header styling */
			.header {
				width: 100%;
		padding: 20px;
		background-color: #EAE7E1; /* White background */
		text-align: center;
		border-bottom: 2px solid #2B2C9D; /* Dark blue border */
			}

			.header h1 {
				font-size: 1.8em;
				color: black;
				margin: 0;
				font-weight: bold;
			}

			.header h2 {
				font-size: 1.2em;
				font-weight: bold;
				color: #2B2C9D;
				margin: 5px 0 20px;
			}

			.circle-logo {
		width: 100px;
		height: 100px;
		background-color: #2B2C9D; /* Dark blue color */
		border-radius: 50%;
		position: absolute;
		top: 10px;
		left: 10px;
		background-image: url('adminImages/studysprout_logo.png');
		background-size: cover;
		background-position: center;
		}

			.dropdown-container {
				text-align: center;
				margin-top: 50px;
			}

			.dropdown {
				display: inline-block;
				margin: 0 100px; 
			}

			.dropdown select {
				background-color: #ffde59;
				color: #000000;
				border: none;
				border-radius: 5px;
				padding: 10px 20px;
				font-size: 16px;
				cursor: pointer;
				transition: background-color 0.2s ease;
				width: 250px;
				height: 45px;
				background-color: #DFB126;
			}

			.dropdown select:focus {
				outline: none;
			}


			.button-group {
				display: flex;
				justify-content: center;
				gap: 15px;
				margin-top: 20px;
			}

			button {
				background-color: #DFB126;
				color: black;
				border: none;
				border-radius: 25px;
				padding: 10px 20px;
				font-size: 16px;
				cursor: pointer;
				transition: background-color 0.2s ease;
				width: 180px;
				font-weight: bold;
			}

			button:hover {
				background-color: #2B2C9D;
				color: white;
			}
			
			.container {
				width: 60%;
				margin: 60px auto;
				padding: 15px;
				background-color: white;
				box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
				border-radius: 5px;
			}
			
			table{
				width: 100%;
				padding: 1%;
				
			}
			
			th, tr, td {
				text-align: left;
				padding: 5px;
			}

			.footer {
				width: 100%;
				height: 50px;
				background-color: #2B2C9D;
				position: fixed;
				bottom: 0;
				text-align: center;
				color: white;
				font-weight: bold;
				line-height: 50px;
			}
		
    </style>
</head>

<body>
    <div class="header">
	<div class="circle-logo"></div>
    <h1>Study Sprouts Academia</h1>
        <h2>Admin Account</h2>
    </div>
    <br>
    <br>
    <h2 style="color: #2B2C9D; font-size: 32px;">Student Grade</h2>
	<form action="ADMIN_StudentGrade.php" method="post">
    <div class="dropdown-container">
        <div class="dropdown">
            <select id="subID" name="subID">
                <option value="" disabled selected hidden>Subject ID</option>
				<option value="default">All</option>
				<?php 
					include '../classes.php';
					require '../db_config.php';
					$sql1 = "SELECT * FROM subject";
					
					$result3 = $db->query($sql1);
					if ($result3->num_rows > 0) {
					  // output data of each row
					  while($row = $result3->fetch_assoc()) {
						$subID = $row["Subject_ID"];
						$name = $row["Subject_Name"];
						$sec = $row["Subject_Section"];
						$sched = $row["Subject_Schedule"];
						echo "<option value =".$subID."> ID: ".$subID." | Subject Name: ".$name." | Section: ". $sec ." | Schedule: ".$sched."</option>";
					  }
					} else {
					}
					?>
				
            </select>
        </div>
        <div class="dropdown">
            <select id="stdID" name="stdID" >
                <option value="" disabled selected hidden>Student Number</option>
				<option value="default">All</option>
                <?php 
					$sql2 = "SELECT * FROM student";
					
					$result3 = $db->query($sql2);
					if ($result3->num_rows > 0) {
					  // output data of each row
					  while($row = $result3->fetch_assoc()) {
						$studID = $row["Student_ID"];
						$FN = $row["Student_FName"];
						$MI = $row["Student_MInitial"];
						$LN = $row["Student_LName"];
						$GradeLvl = $row["Student_GradeLevel"];
						
						if(is_null($MI)){
							echo "<option value =".$studID."> ID: ".$studID." | Name: ".$FN." ".$LN." | Grade/Year: ".$GradeLvl."</option>";

						}
						else{
							echo "<option value =".$studID."> ID: ".$studID." | Name: ".$FN." ".$MI.". ".$LN." | Grade/Year: ".$GradeLvl."</option>";
						}
					  }
					} else {
					}
					?>
            </select>
        </div>
		<div class="dropdown">
			<button id="applyButton" type="submit" value="Submit">Apply Filters</button>
		</div>
    </div>
	</form>
	<div class="container">
	<table>
		<tr>
			<th>Student ID</th>
			<th>Student Name</th>
			<th>Subject ID</th>
			<th>Subject Name</th>
			<th>Grade</th>
			<th>Remarks</th>
		</tr>
	<?php
	
	if(isset($_POST['stdID'])){
		$stdID = $_POST['stdID'];
	} else {
		$stdID = "default";
	}
	if(isset($_POST['subID'])){
		$subID = $_POST['subID'];
	} else {
		$subID = "default";
	}
	
	if($stdID != "default" && $subID != "default"){
		$sql3 = "SELECT s.Student_FName, s.Student_MInitial, s.Student_LName, s.Student_ID, su.Subject_Name, su.Subject_ID, e.Stud_FinalGrade, e.Remarks
		FROM enrollment e
		INNER JOIN student s ON e.Student_ID = s.Student_ID
		INNER JOIN subject su ON e.Subject_ID = su.Subject_ID
		WHERE e.Subject_ID = ? AND e.Student_ID = ?;";
		
		if($stmt3 = $db->prepare($sql3)){
			// Bind variables to the prepared statement as parameters
			$stmt3->bind_param("ii", $param_subID, $param_stdID);
			
			// Set parameters
			$param_subID = $subID;
			$param_stdID = $stdID;
			
			// Attempt to execute the prepared statement
			if($stmt3->execute()){
				$result3 = $stmt3->get_result();
				if ($result3->num_rows > 0) {
				  // output data of each row
				  while($row = $result3->fetch_assoc()) {
					$studID = $row["Student_ID"];
					$FN = $row["Student_FName"];
					$MI = $row["Student_MInitial"];
					$LN = $row["Student_LName"];
					$subjID = $row["Subject_ID"];
					$subjName = $row["Subject_Name"];
					$grade = $row["Stud_FinalGrade"];
					$remarks = $row["Remarks"];
					
					echo "<tr>";
					echo "<td>".$studID."</td>";
					if(is_null($MI)){
						echo "<td>".$FN." ".$LN."</td>";
					}
					else{
						echo "<td>".$FN." ".$MI.". ".$LN."</td>";
					}
					echo "<td>".$subjID."</td>";
					echo "<td>".$subjName."</td>";
					echo "<td>".$grade."</td>";
					echo "<td>".$remarks."</td>";
					echo "</tr>";
				  }
				} else {
					echo "No records found!";
				}
			} else{
				echo "Something went wrong. Please try again later.";
			}
		}
	}
	else if($stdID != "default"){
		$sql3 = "SELECT s.Student_FName, s.Student_MInitial, s.Student_LName, s.Student_ID, su.Subject_Name, su.Subject_ID, e.Stud_FinalGrade, e.Remarks
		FROM enrollment e
		INNER JOIN student s ON e.Student_ID = s.Student_ID
		INNER JOIN subject su ON e.Subject_ID = su.Subject_ID
		WHERE e.Student_ID = ?;";
		
		if($stmt3 = $db->prepare($sql3)){
			// Bind variables to the prepared statement as parameters
			$stmt3->bind_param("i", $param_stdID);
			
			// Set parameters
			$param_stdID = $stdID;
			
			// Attempt to execute the prepared statement
			if($stmt3->execute()){
				$result1 = $stmt3->get_result();
				if ($result1->num_rows > 0) {
				  // output data of each row
				  while($row = $result1->fetch_assoc()) {
					$studID = $row["Student_ID"];
					$FN = $row["Student_FName"];
					$MI = $row["Student_MInitial"];
					$LN = $row["Student_LName"];
					$subjID = $row["Subject_ID"];
					$subjName = $row["Subject_Name"];
					$grade = $row["Stud_FinalGrade"];
					$remarks = $row["Remarks"];
					
					echo "<tr>";
					echo "<td>".$studID."</td>";
					if(is_null($MI)){
						echo "<td>".$FN." ".$LN."</td>";
					}
					else{
						echo "<td>".$FN." ".$MI.". ".$LN."</td>";
					}
					echo "<td>".$subjID."</td>";
					echo "<td>".$subjName."</td>";
					echo "<td>".$grade."</td>";
					echo "<td>".$remarks."</td>";
					echo "</tr>";
				  }
				} else {
					echo "No records found!";
				}
			} else{
				echo "Something went wrong. Please try again later.";
			}
		}
	}
	else if($subID != "default"){
		$sql3 = "SELECT s.Student_FName, s.Student_MInitial, s.Student_LName, s.Student_ID, su.Subject_Name, su.Subject_ID, e.Stud_FinalGrade, e.Remarks
		FROM enrollment e
		INNER JOIN student s ON e.Student_ID = s.Student_ID
		INNER JOIN subject su ON e.Subject_ID = su.Subject_ID
		WHERE e.Subject_ID = ?;";
		
			if($stmt3 = $db->prepare($sql3)){
			// Bind variables to the prepared statement as parameters
			$stmt3->bind_param("i", $param_subID);
			
			// Set parameters
			$param_subID = $subID;
			
			// Attempt to execute the prepared statement
			if($stmt3->execute()){
				$result2 = $stmt3->get_result();
				if ($result2->num_rows > 0) {
				  // output data of each row
				  while($row = $result2->fetch_assoc()) {
					$studID = $row["Student_ID"];
					$FN = $row["Student_FName"];
					$MI = $row["Student_MInitial"];
					$LN = $row["Student_LName"];
					$subjID = $row["Subject_ID"];
					$subjName = $row["Subject_Name"];
					$grade = $row["Stud_FinalGrade"];
					$remarks = $row["Remarks"];
					
					echo "<tr>";
					echo "<td>".$studID."</td>";
					if(is_null($MI)){
						echo "<td>".$FN." ".$LN."</td>";
					}
					else{
						echo "<td>".$FN." ".$MI.". ".$LN."</td>";
					}
					echo "<td>".$subjID."</td>";
					echo "<td>".$subjName."</td>";
					echo "<td>".$grade."</td>";
					echo "<td>".$remarks."</td>";
					echo "</tr>";
				  }
				} else {
					echo "No records found!";
				}
			} else{
				echo "Something went wrong. Please try again later.";
			}
		}
		
	}
	else{
		$sql3 = "SELECT s.Student_FName, s.Student_MInitial, s.Student_LName, s.Student_ID, su.Subject_Name, su.Subject_ID, e.Stud_FinalGrade, e.Remarks
		FROM enrollment e
		INNER JOIN student s ON e.Student_ID = s.Student_ID
		INNER JOIN subject su ON e.Subject_ID = su.Subject_ID;";
		$result3 = $db->query($sql3);
		if ($result3->num_rows > 0) {
		  // output data of each row
		  while($row = $result3->fetch_assoc()) {
			$studID = $row["Student_ID"];
			$FN = $row["Student_FName"];
			$MI = $row["Student_MInitial"];
			$LN = $row["Student_LName"];
			$subjID = $row["Subject_ID"];
			$subjName = $row["Subject_Name"];
			$grade = $row["Stud_FinalGrade"];
			$remarks = $row["Remarks"];
					
			echo "<tr>";
					echo "<td>".$studID."</td>";
					if(is_null($MI)){
						echo "<td>".$FN." ".$LN."</td>";
					}
					else{
						echo "<td>".$FN." ".$MI.". ".$LN."</td>";
					}
					echo "<td>".$subjID."</td>";
					echo "<td>".$subjName."</td>";
					echo "<td>".$grade."</td>";
					echo "<td>".$remarks."</td>";
				echo "</tr>";
		  }
		} else {
		}
	}		
	?>
	</table>
	</div>

    <div class="button-group">
        <a href="ADMIN_AccountInterface.php"><button>Back</button></a>
    </div>
    <br>
    <br>
	<div class="footer">
        
		</div>
</body>

</html>
