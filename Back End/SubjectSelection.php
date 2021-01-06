   <?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
      exit();
}

$username = $_SESSION['username'];

   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
   echo 'Connected successfully</br>';
?>
<html>
    <head>
        <title>Student Home Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
                <header>
        <p><a href="Minerva University3.html"><img src="Minerva University Logoo.png" height="100" width="100" alt="background"></a></p>
        </header>
    <h2>Choose Subject</h2>
var cookie = document.cookie;
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Subject</button>
  <div id="myDropdown" class="dropdown-content">
      <a href="mathcourssearch.php">Math</a>
    <a href="medicalcoursesearch.php">Medical</a>
    <a href="Artcoursesearch.php">Art</a>
    <a href="CompScicoursesearch.php">Computer Science</a>
    <a href="Biologycoursesearch.php">Biology</a>
    <a href="Businesscoursesearch.php">Business</a>
  </div>
</div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
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
 <footer id="footer2">
            <div class ="geninfo">
          <p><a href="Minerva University.html"><img src="Minerva University Logoo.png" height="100" width="100" alt="background"></a></p>  
          <p>Phone Number: 812-522-3917 <br>
          Street: 4038 Minerva University <br>
          City, State, Zip: Seymour, Indiana, 47274 <br>
          Inquiries: generalminervauniversity@msc.edu <br>
      </p></div>
    </footer>     
   
    
    </body>
</html>
