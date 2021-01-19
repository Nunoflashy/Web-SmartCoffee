<!-- MessageBox -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/modal.css">

    <?php
        $msg_title          = $_GET['msg_title'];
        $msg_body           = $_GET['msg_body'];
        $yes_callback       = $_GET['yes_callback'];
        $no_callback        = $_GET['no_callback'];
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
        <a href="<?php echo $yes_callback;?>" style="width:200px; height:50px; font-family:sitkaSmall;" class="in">Sim</a>
        <a href="<?php echo $no_callback;?>" style="width:200px; height:50px; font-family:sitkaSmall;" class="in">Não</a>
        </center>
	</div>
</body>
</html>