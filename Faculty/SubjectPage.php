<?php
class SubjectPage
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function render($userID)
    {
        // Fetch subjects from the database
        $query = "SELECT * FROM assignment WHERE Teacher_ID = ?;";
        if ($stmt = $this->db->prepare($query)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_IDnum);

            // Set parameters
            $param_IDnum = $userID;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<div class="card-container">'; // Move this outside the inner loop to wrap all cards

                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $subID = $row["Subject_ID"];
                        $sql = "SELECT * FROM subject WHERE Subject_ID = ?;";

                        if ($stmt2 = $this->db->prepare($sql)) {
                            // Bind variables to the prepared statement as parameters
                            $stmt2->bind_param("i", $param_subnum);
                            // Set parameters
                            $param_subnum = $subID;

                            // Attempt to execute the prepared statement
                            if ($stmt2->execute()) {
                                $result2 = $stmt2->get_result();

                                while ($row2 = $result2->fetch_assoc()) {
                                    $this->renderSubjectCard($row2);
                                }
                            } else {
                                echo "Something went wrong. Please try again later.1";
                            }
                        }
                    }

                    echo '</div>'; // Close the card container here
                } else {
                    echo '<p>No subjects available.</p>';
                }
            } else {
                echo "Something went wrong. Please try again later.2";
            }
        } else {
            echo "Something went wrong. Please try again later.3";
        }
    }

    private function renderSubjectCard($subjectData)
    {
        echo '<div class="card">';
        echo '<a href="Subject/set_session.php?course=' . $subjectData['Subject_ID'] . '">';
        echo '<img src="Faculty_Images/english.png" alt="Subject Image">';
        echo '<div class="card-content">';
        echo '<h3>' . $subjectData['Subject_Name'] . '</h3>';
        echo '<p>' . $subjectData['Subject_Description'] . '</p>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
}
?>
