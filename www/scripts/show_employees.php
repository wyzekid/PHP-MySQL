<?php
	require 'database_connection.php';
	require 'style.php';
	echo '<form method="post">';
	echo'<p>Выберите тип отчета<br>';
	echo '<select name="Listbox" HorizontalAlignment="Center">';
	echo '<option value="Option 1" selected>Общий отчет</option>';
	echo '<option value="Option 2">3-е лучших</option>';
	echo '<option value="Option 3">3-е худших</option>';
	echo '</select>';
	echo '</p>';
	echo '<input type="submit" value="Построить отчет">';
	switch($_POST["Listbox"]){
	case "Option 1":
		$strSQL = "SELECT FIO, salary, phone, COUNT(excursions.emp_id) as kolvo, SUM(exc_cost*sold_tickets) as sale FROM employees JOIN excursions ON (employees.id_user=excursions.emp_id AND MONTH(excursions.exc_date) = MONTH(NOW()))  GROUP BY emp_id";
	case 'Option 2':
		$strSQL = "SELECT FIO, salary, phone, COUNT(excursions.emp_id) as kolvo, SUM(exc_cost*sold_tickets) as sale FROM employees JOIN excursions ON (employees.id_user=excursions.emp_id AND MONTH(excursions.exc_date) = MONTH(NOW()))  GROUP BY emp_id ORDER BY sale DESC LIMIT 3";
	case 'Option 3':
		$strSQL = "SELECT FIO, salary, phone, COUNT(excursions.emp_id) as kolvo, SUM(exc_cost*sold_tickets) as sale FROM employees JOIN excursions ON (employees.id_user=excursions.emp_id AND MONTH(excursions.exc_date) = MONTH(NOW()))  GROUP BY emp_id ORDER BY sale LIMIT 3";
	}
	echo '</form>';
	$strSQL = "SELECT FIO, salary, phone, COUNT(excursions.emp_id) as kolvo, SUM(exc_cost*sold_tickets) as sale FROM employees JOIN excursions ON (employees.id_user=excursions.emp_id AND MONTH(excursions.exc_date) = MONTH(NOW()))  GROUP BY emp_id ORDER BY sale DESC";
	$rs = mysql_query($strSQL);
	if (!$rs)
		{
			die("<p>Ошибка при выполнении SQL-запроса " . $strSQL . ": " . mysql_error() . "</p>");
		}
	echo '<table class="simple-little-table" cellspacing="0" align="center">';
	echo '<tr>';
	echo '<th>'. "ФИО" .'</th>';
	echo '<th>'. "з/п" .'</th>';
	echo '<th>'. "Телефон" .'</th>';
	echo '<th>'. "Кол-во экскурсий" .'</th>';
	echo '<th>'. "Прибыль" .'</th>';
	echo '<th>'. "Премия" .'</th>';
	echo '</tr>';
	
	while($row = mysql_fetch_array($rs)) {
		echo '<tr>';
		echo '<td>'. $row["FIO"] .'</td>';
		echo '<td>'. $row["salary"] .'</td>';
		echo '<td>'. $row["phone"] .'</td>';
		echo '<td>'. $row["kolvo"] .'</td>';
		echo '<td>'. $row["sale"] .'</td>';
		if ($row["kolvo"]>1)
			echo '<td>'. "<img src='images/green.png'>" .'</td>';
			else
			echo '<td>'. "<img src='images/red.png'>" .'</td>';
		echo '</tr>';
	}
	echo '</table>';
	
?>