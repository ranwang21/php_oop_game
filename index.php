<?php

// check win / lose / start status
if(isset($_GET['status'])){
    $status = $_GET['status'];
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Phrase Hunter</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	</head>

	<body>
		<div class="main-container">
			<h2 class="header">Phrase Hunter</h2>
            <h3><?php
                    if(isset($status)){
                        if($status == "win"){
                            echo "Congratulations, you won!";
                        }else if($status == "lose"){
                            echo "Sorry, you lost!";
                        }
                    }
                ?></h3>
            <form action="play.php" method="GET">
                <input id="btn__reset" type="submit" value="Start Game" />
            </form>
		</div>

	</body>
</html>