<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="application/views/css/style.css" />
        <script language="javascript" src="application/views/js/script.js"></script>
        
        <link type="text/css" rel="stylesheet" href="application/views/css/plusstrap.css" />
        <script type="text/javascript" src="application/views/js/jQuery.js"></script>
        <script type="text/javascript" src="application/views/js/bootstrap-modal.js"></script> 
        <title>cURL Search</title>
    </head>
    <body onload="initDHTMLAPI();">
        <div id="wrapper">
            <?php
                include 'application/views/'.$content_file;
            ?>
        </div>
    </body>
</html>
