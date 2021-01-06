<!--Student Email-->
<?php
require "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">

<h4 align=center>Email</h4>
<form name="contactform" method="post" action="message.php">
<table width="500px">
<tr>
 <td valign="top">
  <label for="first_name">Sender Email</label>
 </td>
 <td valign="top">
  <input  type="text" name="first_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="last_name">Subject</label>
  
 </td>
 <td valign="top">
  <input  type="text" name="last_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="email">Send to: Email Address</label>
  
 </td>
 <td valign="top">
     <input  type="text" name="email" maxlength="80" size="30"></input>
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Message</label>
  
 </td>
 <td valign="top">
  <textarea  name="message" maxlength="1000" cols="25" rows="6"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Submit" name='Submit'>  
 </td>
</tr>
</table>
</form>
<br>
<br>
<?php
if(isset($_POST['Submit']))
{   
$sql2 = $conn->prepare("INSERT INTO `message` (`Send_E_Add`, `Subject`, `Email_Address`, `Message`, `Date`) VALUES (?, ?, ?, ?, ?)");
       
$from = ($_POST['first_name']);
$subject = ($_POST['last_name']);
$email = ($_POST['email']);
$msg = ($_POST['message']);

date_default_timezone_set("America/New_York");
$Date = date('Y-m-d H:i:sa', time());
var_dump($Date);
$sql2->bind_param('sssss', $from, $subject, $email, $msg, $Date);
$sql2->execute();
}
?>
<h4 align=center>Inbox</h4>
<?php
$checkemail = "SELECT message.*, user.* FROM message, user WHERE user.User_ID = '".$_SESSION['user_id']."' AND user.Email_Address = message.Email_Address GROUP BY Date";
$sql3 = $conn->prepare($checkemail);
$sql3->execute();
$result = $sql3->get_result();
if ($result->num_rows > 0){
echo"<table>";
echo"<th>Sender</th>";
echo"<th>Date</th>";
echo"<th>Subject</th>";
echo"<th>Message</th>";                    
while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row['Send_E_Add'] . "</td>";                    
echo"<td>" . $row['Date'] . "</td>";                    
echo"<td>" . $row['Subject'] . "</td>";
echo"<td>" . $row['Message'] . "</td>";
                    
echo"</tr>";
}
echo"</table>";
}
?>
</section>
</div>
</div>
<?php
include"footer.php";
?>