<?php
include "header5.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<style>
body {
font-family: "Lato", sans-serif;
}

.sidenav {
display: none;
height: 100%;
width: 250px;
position: fixed;
z-index: 1;
top: 0;
left: 0;
background-color: darkgreen;
overflow-x: hidden;
padding-top: 60px;
}

.sidenav a {
padding: 8px 8px 8px 32px;
text-decoration: none;
font-size: 25px;
color: #818181;
display: block;
}

.sidenav a:hover {
color: #f1f1f1;
}

.sidenav .closebtn {
position: absolute;
top: 0;
right: 25px;
font-size: 36px;
margin-left: 50px;
}

@media screen and (max-height: 450px) {
.sidenav {padding-top: 15px;}
.sidenav a {font-size: 18px;}
}
</style>
<div id="mySidenav" class="sidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<a href="ResHold.php">View Holds</a>
<a href="ResMajorGpa.php">View Major/GPA</a>
<a href="ResRoster.php">View Roster</a>
<a href="ResMidFinal.php">View Midterm/Final</a>
<a href="ResFacuSche.php">View Faculty Schedules</a>
<a href="message.php">Message User</a>

<a href="ViewAccount.php">View Account Information</a>

</div>

<p> <div class ="Welcome"><h2>Welcome <?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName']; ?></h2> </p>
<p></p></div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Researcher Menu</span>
<script>

function openNav() {
document.getElementById("mySidenav").style.display = "block";
}

function closeNav() {
document.getElementById("mySidenav").style.display = "none";
}
</script>
</section>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
include"footer.php";
?>