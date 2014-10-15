<?php header('Content-Type: text/html; charset=iso-8859-1'); 
 ?>  <!-- LOS ACCENTOS Y LA Ñ -->


<div id=return> 
		<a href="http://scissors.wwwowww.me/alexander/">Return to the main page</a><br><br><br>
</div>

<h1> Add new user to ZOHO CRM API</h1>

<form name="information" action="addUser.php" method="post">
	<fieldset style="border: none">
  	<legend>Add new user information:</legend>

  	First Name:<br> <input type="text" name="first_Name" maxlength="30"><br>
  	Last Name:<br> <input type="text" name="last_Name" maxlength="30"><br>
  	Company:<br><input type="text" name="company"><br>

  	  <input type="submit" value="Add User">
	  <input type="reset" value="Clear">
	</fieldset>
</form>


<?php
/*$conn = new Mongo();

if ($conn) {
 echo nl2br("Ok, you're connected to MongoDB - ". $db . "\n\n");
} else {
 echo "Fail U.u";
} */
?>
