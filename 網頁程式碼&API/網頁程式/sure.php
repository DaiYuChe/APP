<html>
<head>
<link rel="SHORTCUT ICON" href="CSS/images/monitor_icon.png" />
<link rel="icon" href="CSS/images/monitor_icon.png" type="image/ico" />
<meta charset="big5" />
<title>確認</title>
<meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />
</head>
<body style="background-image:url(XD1.jpg);background-repeat:no-repeat;background-size:cover;">
<div id="wrapper">
   <div id="page">
                <div id="content">
					 <center><h1><font color="white">確認刪除</h1>
<?php

?>
<form action="work.php" method="post">
<input name="use" type="hidden" value="<?php echo $_POST['use'] ?>">
<input name="pass" type="hidden" value="<?php echo $_POST["pass"]?>">
<input class="form_submitb"type="submit" name="Delete" value="是"/>
</form>
<form action="1.php" method="post">
<input name="use" type="hidden" value="<?php echo $_POST['use'] ?>">
<input name="pass" type="hidden" value="<?php echo $_POST["pass"]?>">
<input class="form_submitb"type="submit" name="Query" value="否"/>
</form>
</div>  
<div style="clear: both; height: 1px"></div>
            </div>
        </div>
   </body>
</html>