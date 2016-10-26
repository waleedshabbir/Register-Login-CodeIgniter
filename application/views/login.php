<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login Page</title>

</head>
<body>

<div id="container">
	<h1>Login</h1>

	<form action="<?php echo base_url().'main/login_validation'; ?>" method="post">

		<?php echo validation_errors(); ?>

		<label>Email</label>
		<input type="text" name="email" value="<?php $this->input->post('email'); ?>">

		<br>

		<label>Password</label>
		<input type="password" name="password">


		<input type="submit" value="Login">

	</form>


	<a href="<?php echo base_url()."main/signup" ?>">Sign up</a>
</div>

</body>
</html>