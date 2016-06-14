<?php 
	require_once('include.php'); 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Processing page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
	<div class="container">
		<div class="col-md-12">
			<h1>Processing page</h1>
			<?php
				if(isset($_POST['_nonce'])) {
					$correct_guid = my_get_guid();
					$guid = my_validate_nonce($_POST['_nonce']);
					if($guid === false) { 
						echo '<p class="bg-danger"><strong>Sorry, your form didn\'t pass security checks.</strong></p>';
					}
					elseif($guid == $correct_guid) {
						echo '<p class="bg-success">The GUID passed to this form is ' . $guid. ' and the name you gave was ' . $_POST['personName'] .'.</p>';
					}
					else {
						echo '<p class="bg-danger"><strong>Sorry, the GUID for this request is out of order. It\'s supposed to be ' . $correct_guid . ' but it\'s actually ' . $guid. '. The WHOLE SYSTEM is OUT OF ORDER.</strong></p>';
					}
				}
				else {
					echo '<p class="bg-warning">It looks like the form you submitted doesn\'t have a nonce.</p>';
				}
			?>
			<a href="index.php" class="btn btn-primary">Go to form</a>
		</div>
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
