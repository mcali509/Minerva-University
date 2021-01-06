<!-- Student Header -->
<?php
session_start();
if (!isset($_SESSION['Username']) || empty($_SESSION['Username'])) {
exit();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}
include "session.php";
?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<header>
<nav>
<p><a href="#"><img src="Minerva University Logo1.png" height="100" width="100" alt="background"></a></p>
<ul>
<div align="right">
<br>
<h4> <?php echo " {$_SESSION['user_id']} \n
\n<br> {$_SESSION['LastName']}, {$_SESSION['FirstName']} ";
?><br><h4>
<p id="date"></p>
<p>
<script> document.write(new Date().toLocaleDateString()); </script>
</p>
</div>
</ul>
</nav>
</header>
<br>
<div id="Homepagecontainer">
<div id="main">
<section class="wrapper">
<div align="center">
<ul>
<li><figure><a href="index.php"><img src="homeicon.png" height="50" width="50"><figcaption>Home</figcaption></figure></a></li>
<li><figure><a href="Student1.php"><img src="mainpageicon.png" height="50" width="50"><figcaption>Student Homepage</figcaption></figure></a></li>
<li><figure><a href="ChooseSemester.php"><img src="addicon.png" height="50" width="50"><figcaption>Register</figcaption></figure></a></li>
<li><figure><a href="DropCourse.php"><img src="minusicon.png" height="50" width="50"><figcaption>Drop Course</figcaption></figure></a></li>
<li><figure><a href="CrsCatalogLogin.php"><img src="viewicon.png" height="50" width="50"><figcaption>View Catalog</figcaption></figure></a></li>
<li><figure><a href="Holds.php"><img src="holdicon.png" height="50" width="50"><figcaption>Hold</figcaption></figure></a></li>
<li><figure><a href="ViewGrades.php"><img src="gradesicon.png" height="50" width="50"><figcaption>Grades </figcaption></figure></a></li>
<li><figure><a href="ViewMidFinal.php"><img src="gradesicon.png" height="50" width="50"><figcaption>MidTerm & Final Grade</figcaption></figure></a></li>
<li><figure><a href="Transcript.php"><img src="viewicon.png" height="50" width="50"><figcaption>Transcript</figcaption></figure></a></li>
<li><figure><a href="DegreeAudit.php"><img src="declaremajoricon.png" height="50" width="50"><figcaption>Degree Audit</figcaption></figure></a></li>
<li><figure><a href="ChangeMajor.php"><img src="declaremajoricon.png" height="50" width="50"><figcaption>Change Major</figcaption></figure></a></li>
<li><figure><a href="Stumessage.php"><img src="messageicon.png" height="50" width="50"><figcaption>Email </figcaption></figure></a></li>
<li><figure><a href="StuViewAccount.php "><img src="viewicon.png" height="50" width="50"><figcaption>View Account Info</figcaption></figure></a></li>
<li><figure><a href="logout.php"><img src="logouticon.png" height="50" width="50"><figcaption>Log Out</figcaption></figure></a></li>
</ul>

<h1>Student</h1>
</div>
</section>
</div>
</div>