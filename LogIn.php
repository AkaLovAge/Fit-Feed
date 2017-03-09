<?php 
	session_start();
	if (isset($_POST['submit'])){
		$user_name="fitfeed123_fitfeed";
		$dbpassword="fitfeed123";
		$database_name="fitfeed123_FITFEED";
		$conn = mysqli_connect($server_name,$user_name, $dbpassword,$database_name);
		$errors = array();
		if (mysqli_connect_error()){
	    		die("Database Connection Failed" . mysqli_connect_error());
		}
		
		if (isset($_POST['username'])&&isset($_POST['password'])){
			$fitfeed_user_name = mysqli_real_escape_string($conn, $_POST['username']);
			$passwordinput = mysqli_real_escape_string($conn,$_POST['password']);
			$result = $conn->query("SELECT * FROM user where username = '$fitfeed_user_name'");
			$row_num = $result->num_rows;
			if($row_num>0){
				while ($row = $result->fetch_assoc()){
					$user=$row['username'];
					$userpass = $row['password'];
				}
				//echo "<script type='text/javascript'>alert('$userpass');</script>";
				if($userpass == $passwordinput){
					$_SESSION['user']=$user;
					header('Location: welcome.php');
					exit;
				}else{
					$error['authorirty']="password is not correct";
				}
			}else{
				$error['usernull']="user not found";
			
			}
		}else{
			$error['missing']="all field is required";
		}	
	}
	function show_error($error=array()){
		$output = "";
		if (!empty($error)){
			foreach ($error as $key=>$value){
				$output.="{$value}<br></br>";
			}
		}
		return $output;
	}
		

?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <style>
        body {font-family: "Times New Roman", Georgia, Serif;}
        h1,h2,h3,h4,h5,h6 {
            font-family: "Playfair Display";
            letter-spacing: 5px;
        }
    </style>
    <script src="JQuery/jquery-3.1.1.min.js">
    </script>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2">
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">Fit Feed</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#menu" class="w3-bar-item w3-button">Menu</a>
      <a href='#contact' class="w3-bar-item w3-button">Contact</a>
      <a href='LogIn.php' class="w3-bar-item w3-button" ></a>
      <a href='register.php' class="w3-bar-item-button"></a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="http://g02.a.alicdn.com/kf/HTB1vOgAIpXXXXXraXXXq6xXFXXXb/Miranda-kerr-modeli-kuma%C5%9F-poster-40-x-24-21-x-13--005.jpg" alt="Hamburger Catering" width="1600" height="800">

  <div class="register-form">
  	<div class ="w3-card-2 w3-light-grey w3-display-middle w3-opacity-min" style="width:60%">

  		<h3 class="w3-display-topmiddle">Log In</h3>
  		<form action = "LogIn.php" method="post">
  			Username:<input type="text" name="username"><br></br>
  			Password:<input type="text" name="password"><br></br>
  			<input type="submit"name="submit" value="Login">
  			<p id = "register_error"></p>
  			<?php echo show_error($error);?>
  		</p>
  		</form>
  	</div>
  </div>
  
<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-8">
  <p>Powered by Pei Liu, Yuting Yang, Chujie Qin, Xu Li<a href="https://wiki.illinois.edu/wiki/display/cs411sp17/Team+9" title="Wiki Page" target="_blank" class="w3-hover-text-green"><br></br>Wiki Page</a></p>
</footer>

</body>
</html>
