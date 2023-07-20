<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Validating a user input using Jquery and PHP</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<style type="text/css" media="screen">
		html, body {
			background-color: #ccc;
			font-size: 12pt;
			font-family: monospace;
			padding: 15px;
		}

		header {
			font-size: 15pt;
			font-weight: bold;
			color: grey;
		}

		p {
			text-align: justify;
		}

		#textarea-container {
			width: 500px;
		}

		textarea {
			width: 100%;
			height: 100px;
			margin-bottom: 10px;
		}

		button {
			width: 100%;
		}
	</style>
</head>
<body>
	<header>
		Input Validator
	</header>
	<div>
		<div id="textarea-container">
			<p>
				<b>You are allowed to type a minimum of 10 - 100 letters with both number(s) and spaces only before input will be inserted into database.</b>
			</p>
			<div id="log-msg"></div>
			<form id="input-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" name="input-form" enctype="multipart/form-data" accept-charset="utf-8">
				<div>
					<textarea name="input" id="input-area" placeholder="Type something..."></textarea>
				</div>
				<div>
					<button type="submit" name="done" id="done-button">Done</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#input-form").submit(function(e){
				e.preventDefault();	
				var button = $("#done-button");				
				$.ajax({
					url: 'validate.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: "html",
					beforeSend: function() {
						button.attr('disabled', true);
						button.html('Uploading...');
					},
					success: function(d) {
						$("#log-msg").html(d);
						$("#input-form")[0].reset();
						button.attr('disabled', false);
						button.html('Done');
					}
				});
			});
		}); 
	</script>
</body>
</html>