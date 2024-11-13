<?php
session_start();
include '../db_config.php';
include 'Sidebar.php'; // Include the Sidebar class file

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$ID = $_SESSION['userID'];
$FN = $_SESSION['FN'];
$MI = $_SESSION['MI'];
$LN = $_SESSION['LN'];
$Email = $_SESSION['Email'];
$Password = $_SESSION['Password'];
$PhoneNum = $_SESSION['PhoneNum'];

$sql = "SELECT * FROM teacher WHERE Teacher_ID= ?";

if ($stmt = $db->prepare($sql)) {
    $stmt->bind_param("i", $param_ID);
    $param_ID = $ID;

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $ID = $row["Teacher_ID"];
            $FN = $row["Teacher_FName"];
            $MI = $row["Teacher_MInitial"];
            $LN = $row["Teacher_LName"];
            $Email = $row["Teacher_Email"];
            $Password = $row["Teacher_Password"];
            $PhoneNum = $row["Teacher_PhoneNum"];
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <title>Teacher Profile</title>
    <style>
        /* Main body and general settings */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif; /* Roboto is modern and legible for LMS websites */
            background-color: #EAE7E1;
            color: #000000;
        }

        /* Heading styles */
        .main-heading{
            color: #1E1E1E; /* Change the font color to black */
                    margin: 20px 5;
                    text-align: left; /* Align text to the left */
                    margin-left: 300px; /* Align to the left side, remove excessive margin */
                    font-family: 'Roboto', sans-serif;
        }

        h1{
            margin-left: -300px; /* Align to the left side, remove excessive margin */

        }

        /* Sidebar styling */
        .sidebar {
            width: 15%;
            padding: 15px;
            background-color: #2B2C9D;
            color: #ffffff;
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

        /* Centered content styles */
        .center-content {
            margin: 50px auto;
            max-width: 800px;
            padding: 0;
            background-color: transparent;
            border: none;
            box-shadow: none;
            text-align: center;
            margin-right: 240px;
        }

        /* Table styling */
        table {
            width: 100%;
            margin-top: 10px;
            margin-left: -150px;
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

        /* Update button styling */
        .update-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #ffde59;
            color: #000000;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-left: -650px;
            margin-top: 20px;
        }

        .update-button:hover {
            background-color: #ffde59;
            color: #001e3d;
        }

        /* Logout button styling */
        .logout-btn {
            position: absolute;
            right: 75px;
            top: 650px;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .logout-btn:hover {
            background-color: #cc0000;
        }

        /* Blue line */
        .blue-line {
            border: none;
            border-top: 5px solid #312583;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <h1 class="main-heading">Study Sprout Academia</h1>
    <hr class="blue-line">

    <div class="wrapper">
        <?php
        $sidebarLinks = array(
            "Profile.php" => "Profile",
            "Faculty.php" => "Course"
        );

        $sidebar = new Sidebar($sidebarLinks);
        $sidebar->render(); // Render the Sidebar
        ?>

        <div class="center-content">
            <h1>Teacher Profile</h1>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
