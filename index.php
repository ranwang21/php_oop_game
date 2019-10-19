<?php

// check win / lose / start status
if(isset($_GET['message'])){
    $status = filter_input(INPUT_GET, 'message', FILTER_SANITIZE_STRING);
}

include './inc/header.php';
?>



	<body <?php
        if(isset($status) && $status == "Congratulations, you win!"){
            echo "style='background:green'";
        } else if(isset($status) && $status == "Sorry, you lose!"){
            echo "style='background:red'";
        }
    ?>>
		<div class="main-container">
			<h2 class="header index-header">Phrase Hunter</h2>
            <h3 class="index-header"><?php
                    if(isset($status)){
                        echo $status;
                    }
                ?></h3>
            <form action="play.php" method="GET">
                <input id="btn__reset" type="submit" value="<?php
                    if(isset($status)){
                        echo "Restart";
                    }else {
                        echo "Start";
                    }
                ?>" />
            </form>
		</div>
    <?php include './inc/footer.php'; ?>
