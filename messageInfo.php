<!-- MessageBox -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <?php
        $msg_title          = $_GET['msg_title'];
        $msg_body           = $_GET['msg_body'];
        $ok_callback        = $_GET['ok_callback'];
    ?>
</head>
<body>
<div style="background-image: url('img/backgroundUsers.png'); width:100%; height:100%;">
<div id="modal"></div>
    <div class="messageBox">
        <center>
        <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
        <p style="font-family:sitkaSmall;"><?php echo $msg_title;?></p>
        <p style="font-family:sitkaSmall;"><?php echo $msg_body;?></p>
        <a href="<?php echo $ok_callback;?>" style="width:100px; height:30px;" class="in">OK</a>
        </center>
	</div>
</body>
</html>