<?php

	$length = "";

	if (!empty($_POST)) {

		$length = count($_POST['subject']);

		echo "<pre>";
		var_dump($length,$_POST);
		echo "</pre>";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>ARray INPUt</title>
</head>
<body>
	<form method="post">
		<div style="padding-top:10px;">
			<input type="text" name="subject[]">
			<input type="text" name="code[]">
			<input type="number" name="pass[]">
			<input type="number" name="total[]">
			<label for="check1">Optional</label>
			<input  type="checkbox" value="1" name="optional[]">
		</div>
		<div style="padding-top:10px;">
			<input type="text" name="subject[]">
			<input type="text" name="code[]">
			<input type="number" name="pass[]">
			<input type="number" name="total[]">
			<label for="check1">Optional</label>
			<input  type="checkbox" value="1" name="optional[]">
		</div>

		<div style="padding-top:10px;">
			<input type="text" name="subject[]">
			<input type="text" name="code[]">
			<input type="number" name="pass[]">
			<input type="number" name="total[]">
			<label for="check1">Optional</label>
			<input  type="checkbox" value="1" name="optional[]">
		</div>

		<div style="padding-top:10px;">
			<input type="text" name="subject[]">
			<input type="text" name="code[]">
			<input type="number" name="pass[]">
			<input type="number" name="total[]">
			<label for="check1">Optional</label>
			<input type="checkbox" value="1" name="optional[]">
		</div>

		<div style="padding-top:10px;"><button type="submit">Submit</button></div>
	</form>
</body>
</html>