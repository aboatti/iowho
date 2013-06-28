<html>
<head>
<title>Register for Xpens.es</title>
</head>
<body>
<?php echo validation_errors('<div class="error">', '</div>'); ?>

<?php echo form_open('register'); ?>


<h5>Email Address</h5>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<h5>Password</h5>
<input type="text" name="password" value="" size="50" />

<h5>Password Confirm</h5>
<input type="text" name="passconf" value="" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>
</html>