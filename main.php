
<!DOCTYPE html>
<html lang="en">
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif; 
  text-align:center;}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee, .fa-university {font-size:200px}
header{background-color:#a3e4d7;}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-green w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">About us</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Get Involved</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contact Us</a>
    <a href="googlelogin.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Login</a>
  </div>
  

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-green w3-center" style="padding:50px 16px " >
<img src="logo.png" alt="Anchor Image" width="300" height="300">
  <h1 class="w3-margin w3-jumbo">UTM Unity : Volunteer & Serve</h1>
  <p class="w3-xlarge">Our mission is to connect volunteers and organizations, fostering community engagement and positive change. We provide a comprehensive platform with features  to empower individuals and organizations to make a lasting impact on their communities.</p>
  <a href="googlelogin.php" class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Get Started</a>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h5 class="w3-padding-32">Welcome to UTM Unity, where we bridge the gap between service and community. Our platform connects passionate volunteers and organizations, fostering a culture of service and engagement within the University of Technology Malaysia (UTM) community and beyond. Our team is driven by the values of inclusivity, impact, and purpose, dedicated to creating opportunities that inspire meaningful service and positive change. Join us in the journey of making a real difference, one act of service at a time.</h5>
    </div>
    <div class="w3-third w3-center ">
      <!-- Replace the anchor icon with the image tag -->
      <img src="image.png" alt="Anchor Image" width="300" height="200">
    </div>
  </div>
</div>

<!-- Second Grid -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
    </div>

    <div class="w3-twothird">
      <h1>Our Advantages</h1>
      <h5 class="w3-padding-32">These advantages combine to create a powerful tool within the UTM community.</h5>
      <div class="w3-text-grey">
        <p style="display: inline-block; margin-right: 10px;">Efficient matching of volunteers and organizations.</p>
        <p style="display: inline-block; margin-right: 10px;">Enhanced community engagement and accessibility.</p>
        <p style="display: inline-block;">Promotes accountability and trust through feedback.</p>
      </div>
    </div>
  </div>
</div>


<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day: live life</h1>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
 </div>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
