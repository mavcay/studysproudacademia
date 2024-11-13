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
		$query = "SELECT * FROM enrollment WHERE Student_ID = ? AND Payment_Status != 'Not Paid';";
		if ($stmt = $this->db->prepare($query)) {
			$stmt->bind_param("i", $param_stdnum);
			$param_stdnum = $userID;
	
			if ($stmt->execute()) {
				$result = $stmt->get_result();
	
				if ($result->num_rows > 0) {
					echo '<div class="card-container">'; // Move this outside of the inner loop
					while ($row = $result->fetch_assoc()) {
						$subID = $row["Subject_ID"];
						$sql = "SELECT * FROM subject WHERE Subject_ID = ?;";
	
						if ($stmt2 = $this->db->prepare($sql)) {
							$stmt2->bind_param("i", $param_subnum);
							$param_subnum = $subID;
	
							if ($stmt2->execute()) {
								$result2 = $stmt2->get_result();
	
								while ($row2 = $result2->fetch_assoc()) {
									$this->renderSubjectCard($row2);
								}
							}
						}
					}
					echo '</div>'; // Close the card container here
				} else {
					echo '<p>No subjects available.</p>';
				}
			}
		}
	}
	
	
	private function renderSubjectCard($subjectData)
	{
		echo '<div class="card">';
		echo '<a href="Subject/set_session.php?course=' . $subjectData['Subject_ID'] . '">';
		echo '<img src="Student_Images/english.png" alt="Subject Image">';
		echo '<div class="card-content">';
		echo '<h3>' . $subjectData['Subject_Name'] . '</h3>';
		echo '<p>Section: ' . $subjectData['Subject_Section'] . '</p>';
		echo '</div>';
		echo '</a>';
		echo '</div>';
	}

}
?>

