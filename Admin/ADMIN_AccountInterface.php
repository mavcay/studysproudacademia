<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Study Sprouts Admin</title>
 <style>
    /* Body styling */
    body {
      margin: 0;
      padding: 0;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      background-color: #EAE7E1; /* Light background color */
      color: black; /* Default text color */
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Header styling */
    .header {
      width: 100%;
      padding: 20px;
      background-color: #EAE7E1; /* White background */
      text-align: center;
      border-bottom: 2px solid #2B2C9D; /* Dark blue border */
    }

    .study-sprouts-header {
      font-size: 1.8em;
      color: black;
      margin: 0;
      font-weight: bold;
    }

    .admin-header {
      font-size: 1.2em;
      font-weight: bold;
      color: #2B2C9D; /* Dark blue text */
      margin: 5px 0 20px;
    }

    /* Circle logo at the top */
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

    /* Container styling */
    .container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 300px;
    }

    /* Button group styling */
    .button-group a {
      text-decoration: none;
    }

    /* Button styling */
    .button-group button {
      background-color: #DFB126; /* Gold background for buttons */
      color: black; /* Black text */
      border: none;
      padding: 10px 20px;
      font-size: 1.5em;
      font-weight: bold;
      border-radius: 25px; /* Rounded button corners */
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
    }

    /* Hover effect */
    .button-group button:hover {
      background-color: #2B2C9D; /* Dark blue background on hover */
      color: white; /* White text on hover */
    }

    /* Footer styling */
    .footer {
      width: 100%;
      height: 50px;
      background-color: #2B2C9D; /* Dark blue background */
      position: fixed;
      bottom: 0;
    }
 </style>
</head>
<body>

 <!-- Circle Logo Section -->
 <div class="circle-logo"></div>

 <!-- Header Section -->
 <div class="header">
    <h1 class="study-sprouts-header">Study Sprouts Academia</h1>
    <h2 class="admin-header">Admin Account</h2>
 </div>

 <!-- Main Container for Buttons -->
 <div class="container">
    <!-- Button Group Links to Admin Pages -->
    <div class="button-group">
      <a href="ADMIN_CreateSubject.php"><button>New Subject</button></a> 
      <a href="ADMIN_CreateStudent.php"><button>New Student</button></a>
      <a href="ADMIN_CreateTeacher.php"><button>New Teacher</button></a> 
      <a href="ADMIN_EnrollStudent.php"><button>Enroll Student</button></a>
      <a href="ADMIN_AssignTeacher.php"><button>Assign Teacher</button></a>  
      <a href="ADMIN_StudentGrade.php"><button>Student Grades</button></a>  
      <a href="ADMIN_ListOfStudents.php"><button>Student List</button></a> 
      <a href="ADMIN_ListOfFaculty.php"><button>Faculty List</button></a> 
    </div>
 </div>

 <!-- Footer Section -->
 <div class="footer"></div>

</body>
</html>
