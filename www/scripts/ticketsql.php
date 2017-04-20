<?php
		require 'scripts/database_connection.php';
		$ticketSQL = "UPDATE excursions SET sold_tickets=sold_tickets+1";
		mysql_query($ticketSQL) or die ("Couldn't query");
		header("Location: http://museum/excursions.html")		
?>