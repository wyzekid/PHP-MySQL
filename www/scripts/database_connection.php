<?php
	require 'app_config.php';
	mysql_connect(DATABASE_HOST, 
				  DATABASE_USERNAME)
		or die("<p>������ ����������� � ���� ������: " . mysql_error() . "</p>");
	mysql_query("SET NAMES cp1251");
	mysql_query("SET CHARACTER SET cp1251");
	
	
	mysql_select_db(DATABASE_NAME)
		or die("<p>������ ��� ������ ���� ������ " . DATABASE_NAME . mysql_error() . "</p>");
	
	?>