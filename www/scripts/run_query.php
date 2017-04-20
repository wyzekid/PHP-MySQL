<?php
	require 'database_connection.php';
	mysql_query("SET NAMES cp1251");
	mysql_query("SET CHARACTER SET cp1251");
	$query_text = $_REQUEST['query'];
	$result=mysql_query($query_text);
	
	if (!$result)
		{
			die("<p>Ошибка при выполнении SQL-запроса " . $query_text . ": " . mysql_error() . "</p>");
		}
	$return_rows=false;
	$query_text=strtoupper($query_text);
	$location=strpos($query_text, "CREATE");
	if ($location===false) {
		$location=strpos($query_text, "INSERT");
		if ($location===false) {
			$location=strpos($query_text, "UPDATE");
			if ($location===false) {
				$location=strpos($query_text, "DELETE");
				if ($location===false) {
					$location=strpos($query_text, "DROP");
					if ($location===false) {
						$return_rows=true;
						}
					}
				}
			}
		}
	if ($return_rows) 
		{			
	echo "<p>Результаты вашего запроса:</p>";
	echo "<ul>";
	$i=-1;
	while ($row=mysql_fetch_array($result))
		{
			$i++;
			echo '<li>'. $row[0]. '</li>';
		}
	echo "</ul>";
		}
	else 
	{
		echo "<p>Следующий запрос был обработан успешно: </p>";
		echo "<p>{$query_text}</p>";
	}
?>