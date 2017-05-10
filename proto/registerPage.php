<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

	<div align="center">
		<form action='registerPage.php' method='POST'>
		
			<table>
				<tr>
					<td><label for="suburb">Suburb:</label></td>
					<td><input type='text' name='suburb'><br /></td>
				</tr>
				<tr>
					<td><label for="userName">Username *: </label></td>
					<td><input type="text" name="userName" /><br /></td>
				</tr>
				<tr>
					<td><label for="pwd">Password *: </label></td>
					<td><input type="password" name="pwd" /><br /></td>
				</tr>
				<tr>
					<td><label for="conPwd">Confirm Password *: </label></td>
					<td><input type="password" name="conPwd" /><br /></td>
				</tr>
				<tr>
					<td><label for="firstName">First Name *: </label></td>
					<td><input type="text" name="firstName" /><br /></td>
				</tr>
				<tr>
					<td><label for="otherName">Other Names *: </label></td>
					<td><input type="text" name="otherName" /><br /></td>
				</tr>	
				<tr>
					<td><label for="surname">Surname *: </label></td>
					<td><input type="text" name="surname" /><br /></td>
				</tr>				
				<tr>
					<td><label for="dob">Date of Birth *: </label></td>
					<td><input type="date" name="dob" /><br /></td>
				</tr>				
				<tr>
					<td><label for="email">Email *: </label></td>
					<td><input type="email" name="email" /><br /></td>
				</tr>				
				<tr>
					<td><label for="tel">Telephone: </label></td>
					<td><input type="text" name="tel" /><br /></td>
				</tr>				
				<tr>
					<td><label for="add">Address *: </label></td>
					<td><input type="text" name="add" /><br /></td>
				</tr>				
				<tr>
					<td><label for="ptc">Post Code *: </label></td>
					<td><input type="text" name="ptc" /><br /></td>
				</tr>				
			</table>

			<input type="submit" value="Submit" />
		</form>
	</div>

<p>Note: Please make sure your details are correct before submitting form and that all fields marked with * are completed!.</p>

</body>
</html>