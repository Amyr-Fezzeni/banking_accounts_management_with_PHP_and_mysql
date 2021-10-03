<?php
if (isset($_POST['tx'])) {
$t=$_POST['tx'];
echo $t."<br>";
echo ucfirst($t);

	
}


?>




<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		
	</script>
	
<form method="POST" action="test.php" style="text-align:center;" >

	<p>Matrice :</p><input type="text" name="tx"><br>
	<input type="submit" name="inverse" value="inverse" >
	<input type="submit" name="transpose" value="transpose">
	<input type="submit" name="determinant" value="Determinant">
	<input type="submit" name="trace" value="Trace">
</form>
</body>
</html>