<?php
$upv=false;
session_start();
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"greenit");
if($_SESSION['login']!=true)
{
		header("location:index.php");
}
if(isset($_GET['logout']))
{
echo '<script language="javascript">';
echo 'alert("Logged Out Successfully")';
echo '</script>';	
session_destroy();
header("location:index.php");
}

if(isset($_POST['upload'])){
$target_dir = "images/";
$target= $target_dir . basename($_FILES["image"]["name"]);
$con=mysqli_connect("localhost","root","");
$image=$_FILES["image"]["name"];
$tit=$_POST['title'];
$ct=$_POST['category'];
$dc=$_POST['dcptn'];
$loct=$_POST['loct'];
$uid=$_SESSION['userid'];
mysqli_select_db($con,"greenit");
mysqli_query($con,"insert into issues(description,category,userid,image,title,locality) values('$dc','$ct','$uid','$image','$tit','$loct')") or die(mysqli_error($con));
if(move_uploaded_file($_FILES["image"]["tmp_name"],$target)) {
	echo '<script language="javascript">';
	echo 'alert("Posted Successfully")';
	echo '</script>';
}
else{
	echo '<script language="javascript">';
	echo 'alert("Try Again")';
	echo '</script>';
}
}

if(isset($_GET['upvote']))
{
	$con=mysqli_connect("localhost","root","");
	mysqli_select_db($con,"greenit");
	mysqli_query($con,"update issues set upvote=upvote+1 where issueno=".$_GET['upvotevalue'].";")or die(mysqli_error($con));
	$upv=true;
	echo '<script language="javascript">';
	echo 'alert("Upvoted Successfully")';
	echo '</script>';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AddreUS Login</title>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <style>
		img {
			float: left;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 200px;
	height: 200px;
}
		input[type=text], input[type=password],input[type=number] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.9;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {-webkit-transform: scale(0)}
            to {-webkit-transform: scale(1)}
        }

        @keyframes animatezoom {
            from {transform: scale(0)}
            to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
		#btns{

            margin: 10px;
            padding: 10px;
            margin-left: 300px;
            font-family:'Kaushan Script', cursive; font-size:500%;
        }
        .btn{
            margin: 20px;
            padding: 10px;
            box-shadow: 2px 2px 4px #000000;
        }	
		
		*{
			font-family: 'Mali', cursive;
		}
		h1{
           font-family: 'Mali', cursive;
            letter-spacing: 1px;
        }
		p{
			height: 200px;
			width: 1000px;
		}
        .navbar{
            color: white;
        }
        li{
            color: white;
            background: white;
			padding-left:20px;
			padding-right:20px;
        }
        .header {
            padding: 10px 16px;
            background: #21bede;
            color: #ffffff;
            z-index: 100;
        }

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

        .sticky + .content {
            padding-top: 102px;
        }
		
        .footer2 {
            position: static;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color:powderblue;
            color: white;
            text-align: center;
			padding: 20px;
        }		
		table, td, th {
		border: 2px solid black;
		}
		
		
/* Float four columns side by side */
.column {
  width: 100%;
  padding: 10px 10px;
  margin: 10px 10px 10px 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 10px 10px 10px 10px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

		.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}
		
        </style>
</head>
<body data-spy="scroll"  data-target=".navbar" data-offset="50">
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="/">
        <h1 style="display: inline; font-family: 'Mali', cursive; text-shadow: ">Welcome <?php echo $_SESSION['user'];?></h1>   
    </a>
	<a href="<?php echo" ".$_SERVER['PHP_SELF']."?logout=".$_SESSION['login']; ?><button type="button" class="btn btn-outline-dark">LogOut</button></a>
	</nav>
	
<span class="d-block p-2 bg-primary text-white">
	<button onclick="document.getElementById('issue').style.display='block'" style="width:200px;" type="button" class="btn btn-lg btn-outline-light">Facing an Issue?</button>
</span>

<div id="issue" class="modal">

    <form class="modal-content animate" name="signupform" action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">

        <span onclick="document.getElementById('issue').style.display='none'" class="close" title="Close Modal">&times;</span>
<br>
		<label><b>Title</b></label>
        <input type="text" placeholder="Enter Title" name="title" required><br>
		<label><b>Category</b></label>
			<select name="category">
  <option value="RoadTransport">Road and Transport</option>
  <option value="Housing">Housing</option>
  <option value="LawandOrder">Law and Order</option>
  <option value="WaterResources">Water Resources</option>
  <option value="Food">Food</option>
  <option value="WomenandChildren">Women and Children</option>
  <option value="LabourandManpower">Labour and Manpower</option>
  <option value="Sanitation">Sanitation</option>
  <option value="ElectronicsandIT">Electronics and IT</option>
  <option value="SafetyandSecurity">Safety and Security</option>
  <option value="Miscellaneous">Miscellaneous</option>
</select><br>
			
		<label><b>Select image to upload:</b></label>
		<input type="hidden" name="size" value="1000000">
		<input type="file" name="image"><br>
		
		<label><b>Description</b></label>
            <input type="text" placeholder="Enter Description" name="dcptn" required><br>
			
		<label><b>Location</b></label>
            <input type="text" placeholder="Enter Location" name="loct" required><br>
			
		<input type="submit" value="Post" name="upload" class="btn btn-success btn-lg"><br>
        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('issue').style.display='none'" class="btn btn-danger btn-lg">Cancel</button>
        </div>
    </form>
</div>


	<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"greenit");
$qry=mysqli_query($con,"select * from issues where status=0 order by upvote");
echo"<div class='row'>";
while($data=mysqli_fetch_array($qry))
{
echo "<div class='column'><div class='card'>";
echo "<h2>".$data['title']."</h2>";
echo "<h4>".$data['locality']."</h4>";
echo "<p><img src='images/".$data['image']."' alt='issue_image'>".$data['description']."</p>";
echo "<h4>".$data['category']."</h4>";
echo"<form name='frm' method='get' action='".$_SERVER['PHP_SELF']."'><input type='hidden' name='upvotevalue' value='".$data['issueno']."'>";
echo"<input type='submit' name='upvote' value='Upvote' class='btn btn-outline-primary'></form>";
echo"</div></div>";}
echo"</div>";
?>
   <h2>Issues resolved by US</h2>
   <?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"greenit");
$qry=mysqli_query($con,"select * from issues where status =1 order by upvote");
echo"<div class='row'>";
while($data=mysqli_fetch_array($qry))
{
echo "<div class='column'><div class='card'>";
echo "<h2>".$data['title']."</h2>";
echo "<h4>".$data['locality']."</h4>";
echo "<p><img src='images/".$data['image']."' alt='issue_image'>".$data['description']."</p>";
echo "<h4>".$data['category']."</h4>";
echo"</div></div>";}
echo"</div>";
?>

<div class="footer2">
	<h2>Our aim is Happiness of our citizens</h2>
	<h5>Designed by Government of Punjab</h5>
    <p>Copyright</p>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

<script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }	
	
    // Get the modal
    var modal = document.getElementById('issue');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>