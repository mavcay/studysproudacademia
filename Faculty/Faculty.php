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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
body {
    margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #EAE7E1;
            color: #1E1E1E;
}

h1 {
    color: #1E1E1E;
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 5px;
            margin-left: 15%;
            margin-top: 2%;
        }



        .card-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Responsive grid layout */
    gap: 20px;
    padding: 20px;
    margin-left: 15%;
}

        .card-container:hover {
            background-color: transparent; 
        }

        .card {
    background-color: #DDAA11;
    border: none;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

        .card:hover {
            transform: scale(1.05); /* Scale the card on hover for a subtle effect */
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
    padding: 1px;
                text-align: center;
}


.sidebar {
    width: 15%;
            padding: 15px;
            background-color: #2B2C9D;
            color: #fff;
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
            margin-top: 20px;
}

.list-group-item {
    background-color: #312583;
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

.logout-btn {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                padding: 8px 16px;
                background-color: #ff0000;
                color: #fff;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                font-size: 16px;
                cursor: pointer;
                text-align: center;
                width: 80%;
            }

.logout-btn:hover {
    background-color: #cc0000; /* Change this to the desired background color on hover */
}

.header-title {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin-left: -1100px;
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <title>Study Sprouts Academia Dashboard</title>
    </head>
<body>

<h1 class="header-title" >Subjects</h1>

    <hr class="solid">

    <div class="wrapper">
        <?php
		include_once 'Sidebar.php'; 
        include_once 'SubjectPage.php';
        include "../classes.php";
		require_once "../db_config.php";

        // Initialize $sidebarLinks array
// Initialize $sidebarLinks array
$sidebarLinks = array(
    "Faculty.php" => "Section/Subjects",
    "Profile.php" => "Profile"
);


        $sidebar = new Sidebar($sidebarLinks);
        $sidebar->render();


        include_once 'SubjectPage.php';
        $subjectPage = new SubjectPage($db);
        $userID = $_SESSION['userID'];
		$subjectPage->render($userID);
        ?>

    </div>


    <!-- Bootstrap JS files (jQuery and Popper.js are required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap JS files (jQuery and Popper.js are required) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmLogout() {
        // Display a confirmation dialog
        if (confirm("Are you sure you want to log out?")) {
            // If user clicks 'OK', return true to proceed with logout
            return true;
        } else {
            // If user clicks 'Cancel', return false to cancel the logout
            return false;
        }
    }
</script>

    }
</body>
</html>
