<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Sprouts Academia</title>

    <style>
        /* General Body Styling */
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

        /* Header Section */
        .header {
            width: 100%;
            padding: 20px;
            background-color: #EAE7E1;
            text-align: center;
            border-bottom: 2px solid #2B2C9D;
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

        /* Logo Styling */
        .circle-logo {
            width: 100px;
            height: 100px;
            background-color: #2B2C9D;
            border-radius: 50%;
            position: absolute;
            top: 10px;
            left: 10px;
            background-image: url('adminImages/studysprout_logo.png');
            background-size: cover;
            background-position: center;
        }

        /* Container for Form Elements */
        .container {
            width: 90%;
            max-width: 600px;
            margin: 60px auto;
            padding: 15px;
            background-color: #EAE7E1;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2B2C9D;
        }

        input[type="text"],
        input[type="email"],
        select,
        input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Radio Button Group Styling */
        .radio-group {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        /* Button Styling */
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

        /* Image Preview Styling */
        .photo-preview {
            margin-top: 20px;
            text-align: center;
        }

        .photo-preview img {
            max-width: 250px;
            width: 200%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        /* Footer Styling */
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
    <!-- Header Section -->
    <div class="header">
        <div class="circle-logo"></div>
        <h1>Study Sprouts Academia</h1>
        <h2>Admin Account</h2>
    </div>

    <!-- Main Title for Form Section -->
    <br>
    <br>
    <h2 style="color: #2B2C9D; font-size: 32px;">Enroll Students</h2>

    <!-- Form Container -->
    <div class="container">
        <form action="ADMIN_EnrollStudent.php" method="post">
            <!-- Select Student Dropdown -->
            <div class="form-group">
                <label for="selectStud">Select Student to enroll:</label>
                <select id="selectStud" name="selectStud">
                    <option value="" disabled selected hidden> </option>
                    <?php 
                        include '../classes.php';
                        require '../db_config.php';
                        $sql = "SELECT * FROM student";
                        
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                          // Output data of each row
                          while($row = $result->fetch_assoc()) {
                            $studID = $row["Student_ID"];
                            $FN = $row["Student_FName"];
                            $MI = $row["Student_MInitial"];
                            $LN = $row["Student_LName"];
                            $GradeLvl = $row["Student_GradeLevel"];

                            echo "<option value =".$studID."> ID: ".$studID." | Name: ".$FN." ".$MI." ".$LN." | Grade/Year: ".$GradeLvl."</option>";
                          }
                        }
                    ?>
                </select>
            </div>

            <!-- Select Subject Dropdown -->
            <div class="form-group">
                <label for="selectSub">Select Subject:</label>
                <select id="selectSub" name="selectSub">
                    <option value="" disabled selected hidden> </option>
                    <?php 
                        $sql = "SELECT * FROM subject";
                        
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                          // Output data of each row
                          while($row = $result->fetch_assoc()) {
                            $subID = $row["Subject_ID"];
                            $Name = $row["Subject_Name"];
                            $sched = $row["Subject_Schedule"];
                            $sec = $row["Subject_Section"];

                            echo "<option value =".$subID."> ID: ".$subID." Name: ".$Name." | Schedule: ".$sched." | Section: ".$sec."</option>";
                          }
                        }
                    ?>
                </select>
            </div>

            <!-- Tuition Fee Status Radio Buttons -->
            <div class="form-group">
                <label>Tuition Fee Status:</label>
                <div class="radio-group">
                    <input type="radio" id="paid" name="tuitionFeeStatus" value="Paid">
                    <label for="paid">Paid</label>
                    <input type="radio" id="notPaid" name="tuitionFeeStatus" value="Not Paid">
                    <label for="notPaid">Not Paid</label>
                    <input type="radio" id="partiallyPaid" name="tuitionFeeStatus" value="Partially Paid">
                    <label for="partiallyPaid">Partially Paid</label>
                </div>
            </div>

            <!-- Submit and Back Buttons -->
            <div class="button-group">
                <button id="createButton" type="submit" value="Submit">Enroll</button>
                <button type="button" onclick="window.location.href='ADMIN_AccountInterface.php';">Back</button>
            </div>
        </form>

        <!-- PHP Enrollment Processing -->
        <?php 
            $output = "";
            if (!isset($_POST['selectStud']) || !isset($_POST['selectSub'])) {
                echo "<br> Please fill out all necessary fields! <br>";
            } else {
                if (isset($_POST['tuitionFeeStatus'])) {
                    $payment = $_POST['tuitionFeeStatus'];
                } else {
                    $payment = "Not Paid";
                }
                $StudID = intval($_POST['selectStud']);
                $SubID = intval($_POST['selectSub']);
                
                $enr = new Enrollment($StudID, $SubID, $payment);
                $StudentIDsql = $enr->enroll_studID;
                $SubjectIDsql = $enr->enroll_subID;
                $PaymentSQL = $enr->payment;
                $output = "<br>Student ID: $StudentIDsql <br>Subject ID: $SubjectIDsql <br>Payment Status: $PaymentSQL<br>";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $qry = "INSERT INTO enrollment(Student_ID, Subject_ID, Payment_Status) VALUES (?, ?, ?)";

                    if ($stmt = $db->prepare($qry)) {
                        $stmt->bind_param("sss", $param_Stud, $param_Sub, $param_Pay);

                        $param_Stud = $StudentIDsql;
                        $param_Sub = $SubjectIDsql;
                        $param_Pay = $PaymentSQL;

                        if ($stmt->execute()) {
                            echo "<br> Enrollment Success!";
                        } else {
                            echo "<br> Oops, there seems to be an error!";
                        }
                        $stmt->close();
                    }
                }
            }
            echo $output;
        ?>
    </div>

    <!-- Footer Section -->
    <div class="footer">
    </div>
</body>
</html>
