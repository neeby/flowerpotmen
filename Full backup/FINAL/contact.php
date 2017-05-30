<?php
	session_start();
	include_once("functions.php");
	include_once("contactFunctions.php");
	loginDB();
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$call = $_POST['call'];
	$priority = $_POST['priority'];
	$type = $_POST['type'];
	$message = $_POST['message'];
	$errorMessage = "";
	//$formcontent=" From: $name \n Phone: $phone \n Call Back: $call \n Priority: $priority \n Type: $type \n Message: $message";
	//$recipient = "benjamin.shinas@gmail.com";
	//$subject = "Contact Form";
	//$mailheader = "From: $email \r\n";
	
	$contactForm = <<<EOL
		<form action="contact.php" method="POST">
		<p>Name</p> <input type="text" name="name">
		<p>Email</p> <input type="text" name="email">
		<p>Phone</p> <input type="text" name="phone">

		<p>Request Phone Call:</p>
		Yes:<input type="radio" value='Yes' name="call" checked><br />
		No:<input type="radio" value='No' name="call"><br />

		<p>Priority</p>
		<select name="priority" size="1">
			<option value="Low">Low</option>
			<option value="Normal">Normal</option>
			<option value="High">High</option>
		</select>
		<br />

		<p>Type</p>
		<select name="type" size="1">
			<option value="Property Enquiry">Property Enquiry</option>
			<option value="Information Update">Information Update</option>
			<option value="Maintenance Request">Maintenance Request</option>
			<option value="Other Requests">Other Requests</option>
		</select>
		<br />

		<p>Message</p><textarea name="message" rows="6" cols="25"></textarea><br />
		<input type="submit" name="submit"><input type="reset" value="Clear">
	</form>
EOL;

	if (isset($_POST['contactToEdit'])){
		updateRequestStatus ( $_POST['contactToEdit'], "Completed");
	}

	if (isset($_POST['contactToDelete'])){
		if ($_SESSION['UAC_Level'] == "David" || $_SESSION['UAC_Level'] == "Admin"){
			deleteRequest ($_POST['contactToDelete']);	

		} else {
			$errorMessage =  "Insufficient Access to delete contact request";
		}
		
	}



?>

<html>
<head>
	<title>Contact Page</title>
</head>
<body>
	
	<?php
		writeMenu();
		
		switch ($_SESSION['UAC_Level']){
			case 'Staff':
			case 'Admin':
			case 'David':
				writeContactRequests();
				echo $errorMessage;
				break;
			default:
			echo $contactForm;
		}

		if(isset( $_POST['submit'] )){

			//insert to Contact db
			$requestDate = (new \DateTime())->format('d-m-y H:i:s');
			if(addContactRequest ( $name, $email, $phone, $call, $priority, $type, $message, $requestDate, "New enquiry")){
				echo "Thank You! Message sent<br>";	
			} else {
				echo "Warning! Message failed, please try the following link 
				<a href='mailto:enquires@DaviePropertyMgmt.com.au?subject=$type&body=$message'>Send Mail</a><br>";
			}
			
			/* Email option - code is fine however server needs mail server setup and configured - to be done if time permits.
			if(mail('enquires@DaviePropertyMgmt.com.au',$subject,$message)){
				echo "Thank You! Message sent<br>";	
			} else {
				echo "Warning! Message failed, please try the following link <a href='mailto:enquires@DaviePropertyMgmt.com.au'>Send Mail</a><br> ";
			}
			*/
		}

		
		
	?>
	

</body>
</html>