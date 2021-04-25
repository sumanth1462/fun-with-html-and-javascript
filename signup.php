<?php
$server_name="localhost";
$user="root";
$pass="";
$db="restaurent";
$conn=mysqli_connect($server_name,$user,$pass,$db);
if(!$conn){
	die("unable to connect:".$conn->connect_error);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<style type="text/css">
		form{
			border: 5px solid black;
			width:300px;
			padding: 2px;
		}
	</style>
</head>
<body>
<?php
$msg="";
if(isset($_POST['submit'])){
	$name=$_POST['fname'];
	$email=$_POST['email'];
	$pas=$_POST['pass'];
	$sql="SELECT EmailId from user";
	$result=mysqli_query($conn,$sql);
	$a=mysqli_num_rows($result);
	$c=$a;
	if($a>0){
		while($row=mysqli_fetch_assoc($result)){
			//echo $a." ".$c;
			if($row['EmailId']==$email){
				$msg="Email is already taken";
				break;
			}
			else if(($c==1) and ($row['EmailId']!=$email) ){
				$s = "INSERT INTO user(FullName, EmailId, Password) VALUES('$name','$email','$pas')";
				if(mysqli_query($conn,$s)){
					echo "<script>alert('Successfully Registered')</script>";
				}
				else{
					echo "Error: " . $s . "<br>" . mysqli_error($conn);
				}
				
				
			}
			$a--;
			$c--;
		}
	}
	else{

		$s = "INSERT INTO user(FullName, EmailId, Password)VALUES('$name','$email','$pas')";
		if(mysqli_query($conn,$s)){
			echo "<script>alert('Successfully Registered')</script>";
		}
		else{
			echo "Error: " . $s . "<br>" . mysqli_error($conn);
		}
	}
}

?>
<center>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
     <label>Full Name</label><br/>
    <input type="text" name="fname" required="required"><br/><br/>
    <label>Email Id</label><br/>
	<input type="email" name="email" required="required"><br/>
	<p style="background: red;"><?php echo $msg;?></p>
	<label>Password</label><br/>
	<input type="password" name="pass" required="required"><br/><br/>
	<button type="submit" name="submit">submit</button>
</form>
</center>
</body>
</html>