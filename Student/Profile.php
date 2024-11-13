<?php
session_start();
include '../db_config.php';
include 'Sidebar.php'; // Include the Sidebar class file

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
}

$ID = $_SESSION['userID']; // Fix the session key name
$FN = $_SESSION['FN'];
$MI = $_SESSION['MI'];
$LN = $_SESSION['LN'];
$Email = $_SESSION['Email'];
$Password = $_SESSION['Password'];
$PhoneNum = $_SESSION['PhoneNum'];

$sql = "SELECT * FROM student WHERE Student_ID= ?";

if ($stmt = $db->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_ID);

    // Set parameters
    $param_ID = $ID;

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $ID = $row["Student_ID"];
            $FN = $row["Student_FName"];
            $MI = $row["Student_MInitial"];
            $LN = $row["Student_LName"];
            $Email = $row["Student_Email"];
            $Password = $row["Student_Password"];
            $PhoneNum = $row["Student_PhoneNum"];
        } else {
            echo "Invalid login credentials!";
            exit();
        }
    } else {
        echo "Something went wrong. Please try again later.";
    }
    $stmt->close();
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="studentstyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>

.center-content h1 {
            text-align: center;
            margin-top: 0;
        }

        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif; /* Roboto is modern and legible for LMS websites */
            background-color: #EAE7E1;
            color: #000000;
        }

        /* Styling for blue lines */
.blue-line {
    border: none;
    border-top: 5px solid #312583 !important; /* Blue color with !important to ensure it applies */
    margin: 20px 0;
}

        /* Main heading and subtitle */
        .main-heading {
            text-align: center;
            padding-top: 20px;
            color: #000000;
            font-family: 'Roboto', sans-serif; /* Roboto is modern and legible for LMS websites */

        }

        .main-heading h1 {
            color: #1E1E1E; /* Change the font color to black */
                    margin: 20px 5;
                    text-align: left; /* Align text to the left */
                    margin-left: 300px; /* Align to the left side, remove excessive margin */
                    font-family: 'Roboto', sans-serif; /* Roboto is modern and legible for LMS websites */

        }

        .main-heading h2 {
            color: #1E1E1E; /* Change the font color to black */
                    margin: 20px 5;
                    text-align: left; /* Align text to the left */
                    margin-left: 300px; /* Align to the left side, remove excessive margin */
                    font-family: 'Roboto', sans-serif; / /* Roboto is modern and legible for LMS websites */

        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            padding: 20px;
            margin-left: 15%;
            transition: background-color 0.3s;
        }

        .card-container:hover {
            background-color: transparent;
        }

        .card {
            background-color: #ffde59;
            border: none;
            border-radius: 5px;
            width: calc(25% - 20px);
            overflow: hidden;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
            margin-left: -100px;
        }

        .card:hover {
            transform: scale(1.05);
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
            background-color: #2B2C9D;
            color: #000000;
            text-align: center;
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .sidebar img {
            width: 200px;
            height: auto;
            margin-bottom: 15px;
            margin-top: -20px;
        }

        .list-group-item {
            background-color: #312583;
            border: none;
            color: #ffffff;
            cursor: pointer;
        }

        .list-group-item a {
            color: #ffffff;
            text-decoration: none;
        }

        .list-group-item:hover {
            background-color: #001e3d;
        }

.center-content {
    max-width: 800px; /* Keeps content centered if needed */
    margin: 50px auto;
    padding: 0;
    background-color: transparent; /* Make background transparent */
    border: none; /* Remove any borders */
    box-shadow: none; /* Remove any shadow effect */
    text-align: center; /* Center-align text if needed */
    margin-right: 240px;
    margin-left: 700px;
}

        /* Table styles */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            color: #000000;
        }

        table, th, td {
            border: 1px solid #2B2C9D;
            background-color: #E8E8E8;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #D9D9D9;
        }

        /* Button styles */
        .update-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #ffde59;
    color: #000000;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    margin-left: -650px; /* Moves the button to the left */
    margin-top: 20px; /* Moves the button down */
}

.update-button:hover {
    background-color: #ffde59;
    color: #001e3d;
}


.logout-btn {
    position: absolute; /* Positions the button relative to the nearest positioned ancestor */
    right: 75px; /* Moves the button 20px from the right edge of its container */
    top: 650px; /* Moves the button 10px up from its original position */
    padding: 10px 20px; /* Adds padding inside the button */
    background-color: #ff0000; /* Red background color */
    color: #ffffff; /* Text color */
    text-decoration: none; /* Removes underline if it's a link */
    border-radius: 5px; /* Rounds the corners of the button */
    font-size: 16px; /* Adjusts the font size */
}
hr {
        border: none;
        border-top: 5px solid #050a30; /* Blue color */
        margin: 20px 0;
    }
        
    </style>
    <title>Student Profile</title>
</head>

<body>

    <!-- Main Heading and Subtitle -->
    <div class="main-heading">
        <h1>Study Sprouts Academia</h1>
    </div>

    <hr>

    
    
    <div class="wrapper">
        <?php
        // Initialize $sidebarLinks array
        $sidebarLinks = array(
            "Profile.php" => "Profile",
            "Student.php" => "Course"
        );

        $sidebar = new Sidebar($sidebarLinks);
        $sidebar->render(); // Render the Sidebar
        ?>

        <div class="center-content">
            <h1>Student Profile</h1>
            <table>
                <tr>
                    <th>Details</th>
                    <th>Information</th>
                </tr>
                <tr>
                    <td>ID</td>
                    <td><?php echo $ID; ?></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><?php echo $FN; ?></td>
                </tr>
                <tr>
                    <td>Middle Initial</td>
                    <td><?php echo $MI; ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo $LN; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $Email; ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?php echo $PhoneNum; ?></td>
                </tr>
            </table>
            <a class="update-button" href="UpdateProfile.php">Update Profile</a>
        </div>
    </div>

    <!-- Bootstrap JS files (jQuery and Popper.js are required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="bottom-bar">

</div>
</body>

</html>

