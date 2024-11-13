<?php

class Sidebar {
    private $links;

    public function __construct($links) {
        $this->links = $links;
    }

    public function render() {
        echo '<div class="sidebar">';
        echo '<a href="Student.php">';
        echo '<img src="Student_Images/studysprout_logo.png" alt="Sagad High School Logo">';
        echo '</a>';
        echo '<ul class="list-group">';
        foreach ($this->links as $link => $label) {
            echo '<li class="list-group-item"><a href="' . $link . '">' . $label . '</a></li>';
        }
        echo '</ul>';
        // Add logout link with styling
        echo '<style> 
        .logout-btn{
        
        }   
        </style>';
        echo '<a class="logout-btn" href="logout.php" onclick="return confirmLogout();">Logout</a>';
        echo '</div>';
    }
}
?>
