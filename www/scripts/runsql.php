<?php
	require 'database_connection.php';
	if(isset($HTTP_POST_VARS['Купить'])){ //если нажата наша кнопка
    //Подключение к БД
    $ticketSQL = "UPDATE excursions SET sold_tickets=sold_tickets+1";
    mysql_query($ticketSQL) or die ("Couldn't query");
	}
?>