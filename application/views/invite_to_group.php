<html>
<head>
<title>Invite someone to your group | Xpens.es</title>
</head>
<body>
<?php echo validation_errors('<div class="error">', '</div>'); ?>

<?php echo form_open('groups/create'); ?>


<h5>Group Name</h5>
<input type="text" name="name" value="<?php echo set_value('name'); ?>" size="70" />

<h5>Group Description</h5>
<input name="description" value="" type="text" size="250" />


<div><input type="submit" value="Submit" /></div>

</form>
</html>