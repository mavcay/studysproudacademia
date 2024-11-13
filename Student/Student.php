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
            background-color: #cc0000;
        }

        .header-title {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin-left: -1100px;
            font-family: 'Roboto', sans-serif;
        }
 /* Floating chatbot button styling */
 .floating-chat-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #2B2C9D; /* Match sidebar color for consistency */
    color: white;
    border: none;
    padding: 15px;
    font-size: 18px;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    transition: background-color 0.3s ease;
    background-image: url('Student_Images/chat_logo.png');
    background-size: cover; /* Ensures the image covers the button */
    background-position: center;
    width: 60px; /* Adjust width and height to fit the image */
    height: 60px;
}

.floating-chat-button:hover {
    background-color: #001e3d;
}

/* Chatbox styling */
.chatbox {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 350px;
    max-height: 500px;
    background-color: #FFFFFF;
    border: 1px solid #ddd;
    border-radius: 10px;
    display: none;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    overflow: hidden;
    font-family: 'Roboto', sans-serif;
}

/* Chatbox header */
.chatbox h4 {
    margin: 0;
    padding: 15px;
    background-color: #2B2C9D;
    color: white;
    text-align: center;
    font-weight: 500;
    border-radius: 10px 10px 0 0;
}

/* Chat messages container */
/* Chat messages container styling with scroll */
.chat-messages {
    height: 65%;
    max-height: 300px; /* Restrict height for consistent scrolling */
    overflow-y: auto;
    padding: 15px;
    border-bottom: 1px solid #ddd;
    background-color: #f8f9fa;
}

/* Chat input area */
.chat-input {
    width: calc(100% - 20px);
    margin: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Send button */
.send-button {
    width: calc(100% - 20px);
    margin: 10px;
    padding: 10px;
    background-color: #2B2C9D;
    color: white;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.send-button:hover {
    background-color: #0056b3;
}
.message-container {
    background-color: #2B2C9D;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
    font-size: 14px;
    color: #fff;
    display: flex;
    align-items: center;
}


.message-container.user-message {
    background-color: #2B2C9D;
    color: white;
    align-self: flex-end;
}

.message-container.bot-message {
    background-color: #e1e5eb;
    color: #333;
    align-self: flex-start;
}

    </style>
    <title>Study Sprouts Academia Dashboard</title>
</head>

<body>


<h1 class="header-title">Courses</h1>
<hr>
<div class="wrapper">
    <?php
    include_once 'Sidebar.php';
    include "../classes.php";
    require_once "../db_config.php";

    $sidebarLinks = array(
        "Profile.php" => "Profile",
        "Student.php" => "Course"
    );

    $sidebar = new Sidebar($sidebarLinks);
    $sidebar->render();

    include_once 'SubjectPage.php';

    $subjectPage = new SubjectPage($db);
    $userID = $_SESSION['userID'];
    $subjectPage->render($userID);
    ?>
</div>


<!-- Floating Chatbot Button -->
<button class="floating-chat-button" onclick="toggleChatbox()"></button>

<!-- Chatbot Popup -->
<div class="chatbox" id="chatbox">
    <h4>Plant Bot</h4>
    <div class="chat-messages" id="response"></div>
    <input type="text" id="text" class="chat-input" placeholder="Type a message...">
    <button onclick="generateResponse();" class="send-button">Send</button>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmLogout() {
        if (confirm("Are you sure you want to log out?")) {
            return true;
        } else {
            return false;
        }
    }
</script>

<script src="script.js"></script>
<script>
    function toggleChatbox() {
        const chatbox = document.getElementById('chatbox');
        chatbox.style.display = chatbox.style.display === 'none' ? 'block' : 'none';
    }

  
</script>
</body>
</html>
