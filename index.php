<?php
if(isset($_POST['send1']))
{
	$con=mysqli_connect("localhost","root","");
	mysqli_select_db($con,"greenit");
	$nm=$_POST['uname'];
	$em=$_POST['email'];
	$mbl=$_POST['mbl'];
	$loc=$_POST['locality'];
	$adr=$_POST['address'];
	$psd=$_POST['psw'];
	mysqli_query($con,"insert into user(username,password,email,contact,locality,address) values('$nm','$psd','$em','$mbl','$loc','$adr')") or die(mysqli_error($con));
	echo '<script language="javascript">';
	echo 'alert("Registered Successfully")';
	echo '</script>';		
}

if(isset($_POST['send2']))
{
	$con=mysqli_connect("localhost","root","");
	mysqli_select_db($con,"greenit");
	$nm=$_POST['dname'];
	$did=$_POST['did'];
	$em=$_POST['email'];
	$psd=$_POST['psw'];
	mysqli_query($con,"insert into officials(officialid,deptname,password,email) values('$did','$nm','$psd','$em')") or die(mysqli_error($con));
	echo '<script language="javascript">';
	echo 'alert("Registered Successfully")';
	echo '</script>';		
}


session_start();
$_SESSION['login']=false;
if(isset($_POST['login']))
{
	$secret = '6LceM1MUAAAAAOFSEpR1cQ4BN-CJ79WFXKdi7dx6';
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
    $result = json_decode($url, TRUE);
    if ($result['success'] == 1) {	
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"greenit");
$qry1=mysqli_query($con,"select * from user");
$qry2=mysqli_query($con,"select * from officials");
$nm=$_POST['uname'];
$psd=$_POST['psw'];
$bool=false;
while($data=mysqli_fetch_array($qry1))
{
	if($nm==$data['username'] && $psd==$data['password'])
	{
		$_SESSION['login']=true;
		$_SESSION['user']=$data['username'];
		$_SESSION['userid']=$data['uid'];
		$_SESSION['access']=0;
		$bool=true;
		header("location:menu.php");
		break;
	}
}
if($bool==false)
{
while($data=mysqli_fetch_array($qry2))
{
	if($nm==$data['deptname'] && $psd==$data['password'])
	{
		$_SESSION['login']=true;
		$_SESSION['user']=$data['deptname'];
		$_SESSION['userid']=$data['officialid'];
		$_SESSION['access']=1;
		$bool=true;
		header("location:menu2.php");
		break;
	}
}
}

if($_SESSION['login']==false){
  echo '<script language="javascript">';
  echo 'alert("Wrong username or password")';
  echo '</script>';
}

}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Addre US</title>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	<link rel="stylesheet"href="public/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <style>
        /* Full-width input fields */
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

        h1{
            color: white;
            text-shadow: 2px 2px 4px #000000;
            margin-top: 100px;
			font-family: 'Mali', cursive;
			font-size:500%; text-align: center;
        }
		h3{
            color: lightgrey;
            text-shadow: 2px 2px 4px #000000;
            margin-top: 20px;
			font-family: 'Mali', cursive;
			font-size:200%; text-align: center;
        }
        body{
            background-image: url("colab.jpg");
            background-size: cover;
        }
        #btns{

            margin: 10px;
            padding: 10px;
            margin-left: 250px;
            font-family: 'Raleway', sans-serif; font-size:500%;
        }
        .btn{
            margin: 20px;
            padding: 10px;
            box-shadow: 2px 2px 4px #000000;
        }	
    </style>
</head>
<body>
<h1>AddreUS</h1>
<h3>A platform for You, by You</h3>
<div id="btns">
<button onclick="document.getElementById('id01').style.display='block'" style="width:200px;" type="button" class="btn btn-lg btn-info">Login</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:200px;" type="button" class="btn btn-lg btn-info">Register as Civilian</button>
<button onclick="document.getElementById('id03').style.display='block'" style="width:200px;" type="button" class="btn btn-lg btn-info">Register as Official</button>
</div>


<div id="id01" class="modal">

    <form class="modal-content animate" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

        <div class="container">
            <label><b>User ID</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label ><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
			<div class="g-recaptcha" data-sitekey="6LceM1MUAAAAABLgT6aeaW8DBfymIl9rQkBmVgNv"></div>
			<input type="submit" value="login" name="login" class="btn btn-success  btn-lg"><br>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>


<div id="id02" class="modal">

    <form class="modal-content animate" name="signupform" action="<?php $_SERVER['PHP_SELF']?>" method="POST" >

        <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>

        <div class="container">
            <label><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="uname" required>

            <label ><b>Email</b></label>
            <input type="text" placeholder="Enter e-mail" name="email" required>

            <label ><b>Contact</b></label>
            <input type="number" placeholder="Enter Contact" name="mbl" required>
			
			<label ><b>Locality</b></label>
            <input type="text" placeholder="Enter Locality" name="locality" required>
			
			<label ><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" required>
			
			<label ><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
			
			<input type="submit" name="send1" value="submit" class="btn btn-success btn-lg"><br>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>


<div id="id03" class="modal">

    <form class="modal-content animate" name="signupform" action="<?php $_SERVER['PHP_SELF']?>" method="POST" >

        <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>

        <div class="container">
            <label><b>Department Name</b></label>
            <input type="text" placeholder="Enter Department" name="dname" required>
			
			<label><b>Id Number</b></label>
            <input type="number" placeholder="Enter ID number" name="did" required>
			
			 <label ><b>Email</b></label>
            <input type="text" placeholder="Enter e-mail" name="email" required>

            <label ><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

			<input type="submit" name="send2" value="submit" class="btn btn-success btn-lg"><br>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    var modal = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
	
	var modal = document.getElementById('id03');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>