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
            margin: 0 150px; 
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

        .container {
            width: 60%;
            margin: 60px auto;
            padding: 15px;
            background-color: #ffffff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
		
		table{
			width: 100%;
			padding: 1%;
			
		}
		
		th, tr, td {
			text-align: left;
			padding: 5px;
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
    <h2 style="color: #2B2C9D; font-size: 32px;">List of Faculty</h2>
    <div class="container">
	<table>
		<tr>
		<th>Teacher ID</th>
		<th>First Name</th>
		<th>Middle Initial</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Password</th>
		<th>Phone Number</th>
		</tr>
		<?php 
		include '../classes.php';
		require '../db_config.php';
		$sql = "SELECT * FROM teacher";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			$ID = $row["Teacher_ID"];
			$FN = $row["Teacher_FName"];
			$MI = $row["Teacher_MInitial"];
			$LN = $row["Teacher_LName"];
			$Email = $row["Teacher_Email"];
			$PW = $row["Teacher_Password"];
			$Phone = $row["Teacher_PhoneNum"];
			echo "<tr>";
			echo "<td>".$ID."</td>";
			echo "<td>".$FN."</td>";
			echo "<td>".$MI."</td>";
			echo "<td>".$LN."</td>";
			echo "<td>".$Email."</td>";
			echo "<td>".$PW."</td>";
			echo "<td>".$Phone."</td>";
			echo "</tr>";
		  }
		} else {
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
