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


if(isset($_GET['status']))
{
	$con=mysqli_connect("localhost","root","");
	mysqli_select_db($con,"greenit");
	mysqli_query($con,"update issues set status=1 where issueno=".$_GET['statusval'].";")or die(mysqli_error($con));
	echo '<script language="javascript">';
	echo 'alert("Resolved Successfully")';
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
            margin: 8px 0;
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
		
	
		h1{
           font-family: 'Kaushan Script', cursive;
            letter-spacing: 1px;
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
  float: left;
  width: 100%;
  padding: 10px 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 5px 5px;}

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

	<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"greenit");
$cg=$_SESSION['user'];
$qry=mysqli_query($con,"select * from issues where category='$cg' and status=0 order by upvote")or die(mysqli_error($con));
echo"<div class='row'>";
while($data=mysqli_fetch_array($qry))
{
echo "<div class='column'><div class='card'>";
echo "<h2>".$data['title']."</h2>";
echo "<h4>".$data['locality']."</h4>";
echo "<p><img src='images/".$data['image']."' alt='issue_image'>".$data['description']."</p>";
echo "<h4>".$data['category']."</h4>";
echo"<form name='frm' method='get' action='".$_SERVER['PHP_SELF']."'><input type='hidden' name='statusval' value='".$data['issueno']."'>";
echo"<input type='submit' name='status' value='Resolved' class='btn btn-outline-primary'></form>";
echo"</div></div>";}
echo"</div>";
?>
      

<div class="footer2">
	<h2>Our aim is Happiness of our citizens</h2>
	<h5>Designed by Government of India</h5>
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