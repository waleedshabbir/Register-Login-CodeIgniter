<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Signup Page</title>

</head>
<body>

<div id="container">
    <h1>Signup</h1>


    <form action="<?php echo base_url().'main/signup_validation'; ?>" method="post">

    <?php echo validation_errors(); ?>

    <label>Email</label>
    <input type="text" name="email" value="<?php $this->input->post('email'); ?>">
    <br>

    <label>Password</label>
    <input type="password" name="password">
    <br>

    <label>Confirm Password</label>
    <input type="password" name="cpassword">
    <br>



    <input type="submit" value="Sign up">
    <br>



</form>


</div>

</body>
</html>