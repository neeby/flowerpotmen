<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$call = $_POST['call'];
	$website = $_POST['website'];
	$priority = $_POST['priority'];
	$type = $_POST['type'];
	$message = $_POST['message'];
	$formcontent=" From: $name \n Phone: $phone \n Call Back: $call \n Website: $website \n Priority: $priority \n Type: $type \n Message: $message";
	$recipient = "benjamin.shinas@gmail.com";
	$subject = "Contact Form";
	$mailheader = "From: $email \r\n";



//mail($recipient, $subject, $formcontent) or die("Error!");

?>

<html>
<head>
	<title>Contact Page</title>
</head>
<body>

	<form action="contact.php" method="POST">
		<p>Name</p> <input type="text" name="name">
		<p>Email</p> <input type="text" name="email">
		<p>Phone</p> <input type="text" name="phone">

		<p>Request Phone Call:</p>
		Yes:<input type="checkbox" value="Yes" name="call"><br />
		No:<input type="checkbox" value="No" name="call"><br />

		<p>Website</p> <input type="text" name="website">

		<p>Priority</p>
		<select name="priority" size="1">
			<option value="Low">Low</option>
			<option value="Normal">Normal</option>
			<option value="High">High</option>
			<option value="Emergency">Emergency</option>
		</select>
		<br />

		<p>Type</p>
		<select name="type" size="1">
			<option value="update">Website Update</option>
			<option value="change">Information Change</option>
			<option value="addition">Information Addition</option>
			<option value="new">New Products</option>
		</select>
		<br />

		<p>Message</p><textarea name="message" rows="6" cols="25"></textarea><br />
		<input type="submit" name="submit"><input type="reset" value="Clear">
	</form>
	
	<?php
		if(isset( $_POST['submit'] )){
			if(mail('enquires@DaviePropertyMgmt.com.au',$subject,$message)){
				echo "Thank You! Message sent<br>";	
			} else {
				echo "Warning! Message failed, please try the following link <a href='enquires@DaviePropertyMgmt.com.au'>Send Mail</a> ";
			}
		
		}
	?>
	
	<a href="properties.php">Return to Properties Page</a>
	

</body>
</html>