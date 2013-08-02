<?php
	/* PHP Functions */
	function countRows($link){
		$q = "SELECT * FROM itemlist";
		$result = mysql_query($q, $link);
		$count = mysql_num_rows($result);

		echo $count;

	}

?>