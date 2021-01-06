<?php 
require 'header3.php';
if(isset($_POST['redirect'])){
header('Location: '.$_POST['redirect']);
exit;
}
?>
<meta charset = "utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
</style>

<script type="text/javascript">
function goToNewPage()
{
var url = document.getElementById('MSchedule').value;
if(url != 'none'){
window.location.href = url;
}
}
</script>
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper">
<h1 align=center>Master Schedule</h1>
<div align="center">
<form method="post" id="MSchedule">
<select name="redirect" id="pages">
<option value="MasterSchedule1.php" selected>Choose Semester</option>
<option value="MasterSchedule1.php">Spring 2020</option>
</select>
</select>
<input type="submit" value="Submit"/>
</form>
</div>
</div>
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
<?php
include 'footer.php'
?>