<?php
require "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<script>
function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
<dialog open>Please wait 3-5 business days for your request to be reflected in your account</dialog>;
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {
var dropdowns = document.getElementsByClassName("dropdown-content");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
}
</script>
</head>
<body>
<h2>Change Major</h2>
<p>Current Major: <?php
if(isset($_SESSION['undergradid'])){
echo $_SESSION['MajorName'];
}
/*$sql = "SELECT u.MajorID, m.M_Name FROM undergraduate AS u AND major AS m WHERE {$_SESSION['user_id']} = 
AND m.Major_ID = u.MajorID";
$result = $conn->query($sql);
if($result->num_rows > 0){
while($row = $result->fetch_assoc()){
echo "<br>" . $row['M_Name'];
}
}
else{
echo "Major not found";
}
}
*/ else if(isset($_SESSION['graduateid'])){
$sql = "SELECT u.MajorID, m.M_Name FROM graduate AS u AND major AS m WHERE {$_SESSION['user_id']} = {$_SESSION['graduateid']}
AND m.Major_ID = u.MajorID";
$result = $conn->query($sql);
if($result->num_rows > 0){
while($row = $result->fetch_assoc()){
echo "<br>" . $row['M_Name'];
}
}
else{
echo "Major not found";
}
}
?>
</p>
<form action="ResFacuSche.php" method="POST">
<select name ="majorid">
<option value="1112">Calculus</option>
<option value="1113">Trigonometry</option>
<option value="1114">Business</option>
<option value="1115">Economics</option>
<option value="1116">Accounting</option>
<option value="1117">Biochemistry</option>
<option value="1118">Medical Chemistry</option>
<option value="1119">Graphic Design</option>
<option value="1120">Digital Art</option>
<option value="1121">Human Systems</option>
<option value="1122">Comp Sci B.S.</option>
<option value="1123">Comp Sci B.A.</option>
<option value="1124">Comp Engineering</option>
<option value="1125">Bus Leadership</option>
<option value="1126">Math Theory</option>
<option value="1127">Biogenetics</option>
</select>
<select name  ="minorid">
<option value="0">None</option>
<option value="101">Math</option>
<option value="102">Biology</option>
<option value="103">Business</option>
<option value="104">Art</option>
<option value="105">Computer Science</option>
<option value="106">English</option>
<option value="107">Humanities</option>
<option value="108">Music</option>
</select>
<input type="Submit" name="Submit" value ="Submit"></form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php 
if (isset($_POST['Submit'])){
$select1 = $conn->prepare("UPDATE undergraduate SET (undergraduate.MajorID = ?, undergraduate.MinorID = ?) WHERE undergraduate.UG_StudentID = '".$_SESSION['user_id']."'");
$maj = $_POST['majorid'];
$min = $_POST['minorid'];
$select1->bind_param('ii', $maj, $min);
$select1->execute();
$result=$select1->get_result();
//$majors =  $select1->fetchALL(PDO::FETCH_COLUMN,0);
//
//echo $majors[0];
if ($result->num_rows > 0){
echo "<table>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Course Name</th>";
echo "<th>Time</th>";
echo "<th>Day</th>";
echo "<th>Room/Building</th>";
echo "<th>Credits</th>";
echo "<th>Section Number</th>";
$rownumber = 0;
while($row=$result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row['User_ID'] . "</td>";
echo"<td>" . $row['First_Name'] . "</td>";
echo"<td>" . $row['Last_Name'] . "</td>";
echo"<td>" . $row['C_Name'] . "</td>";
echo"<td>" . $row['Period'] . "</td>";
echo"<td>" . $row['Day'] . "</td>";
echo"<td>" . $row['R_Num'] . ',' . $row['B_Name'] . "</td>";
echo"<td>" . $row['C_CreditAmt'] . "</td>";
echo"<td>" . $row['S_Num'] . "</td>";
$rownumber = $rownumber +1;
echo"</tr>";
}
}
}
?>
</section>
</div>
</div>
<?php
include"footer.php";
?>