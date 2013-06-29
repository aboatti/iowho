<html>
<head>
<title>Welcome to Xpens.es | Groups</title>
</head>
<body>
<h1>My Groups</h1>
<ul>
<?php foreach($groups as $group){
		echo "<li>".$group['name']."</li>";
	}
?>
</ul>
</form>
</html>