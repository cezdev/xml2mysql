<?php
	/* Database connection */
	include('./include/connect.php');
	include('./include/functions.php');

	if ($_FILES[xml][size] > 0) { 
		$file = $_FILES[xml][tmp_name]; 

		mysql_query("TRUNCATE TABLE itemlist",$link) or die ("Error in query: $insert. ".mysql_error());

		$xml = simplexml_load_file($file);
		$count = 0;

		foreach ($xml->Item as $item) {
		    $ItemNumber = mysql_real_escape_string($item->ItemNumber);
		    $Description = mysql_real_escape_string($item->Description);
		    $Price = mysql_real_escape_string($item->Price);

	    	//print $ItemNumber . "<br />";
		
			mysql_query("INSERT INTO itemlist (ItemNumber, Description, Price) VALUES ('$ItemNumber', '$Description', '$Price')",$link) or die ("Error in query: $insert. ".mysql_error());
			$count++;

		}

		//redirect 
    	header('Location: index.php?success=1?inserts=' . $count . ''); die; 

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<link rel="stylesheet" type="text/css" href="./css/screen.css" media="screen and (min-width: 481px)" />
<title>xml2mysql - XML to Mysql Convertor</title> 
</head> 

<body> 

<div class="wrapper">

<?php 
	if(!empty($_GET[success])){
		echo "<b>Database cleared, and all of the items where imported correctly!</b><br><br>"; 
	
	} 
?> 

<h1>Import new data</h1>
At this moment, there are <?php countRows($link); ?> items within the database. If you want to import a new version of the itemlist, you can do so by using the following form. Beware that the old database will be deleted, only the items within the XML file will be inside the database after this process is complete.<br /><br />

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  <b>Upload your XML file: </b><br /> 
  <input name="xml" type="file" id="xml" /> 
  <input type="submit" name="Submit" value="Submit" /> 
</form> 

<br />You can always download the original XML file here: <a target="new" href="itemlist_original.xml">itemlist_original.xml</a>.

</div>

</body> 
</html> 