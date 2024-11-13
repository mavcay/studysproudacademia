<?php

class Sidebar {
    private $links;

    public function __construct($links) {
        $this->links = $links;
    }

    public function render() {
        echo '<div class="sidebar">';
        echo '<a href="Chad_SAGADHIGHSCHOOL\Student">';
        echo '<img src="Subject_Images/logo.png" alt="Sagad High School Logo">';
        echo '</a>';
        echo '<ul class="list-group">';
        foreach ($this->links as $link => $label) {
            echo '<li class="list-group-item"><a href="' . $link . '">' . $label . '</a></li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}
?>
