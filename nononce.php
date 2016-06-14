<?php 
	require_once('include.php'); 
	//$nonce = my_create_nonce(1, my_create_guid());
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simple Nonce Form: Input</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
	<div class="container">
		<div class="col-md-12">
			<h1>Basic Nonce: Handoff to alternate page</h1>
			<p class="text-muted">I am an engineer so you get to see a vanilla Bootstrap page.</p>
			<form action="process.php" method="post">
				<!-- <input type="hidden" name="_nonce" value="<?php echo $nonce; ?>" /> -->
				<div class="form-group row">
					<label for="nonceValue" class="col-sm-2 form-control-label">Nonce value</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nonceValue" name="nonceValue" value="<?php echo $nonce; ?>" readonly />
					</div>
				</div>
				<div class="form-group row">
					<label for="personName" class="col-sm-2 form-control-label">Your name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="personName" name="personName" placeholder="Your name here" required />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
