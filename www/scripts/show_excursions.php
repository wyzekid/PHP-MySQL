<?php
	require 'database_connection.php';
	require 'style.php';
	$strSQL = "SELECT exc_name, DATE_FORMAT(exc_date,'%d.%m.%Y') as eurodate, TIME_FORMAT(exc_time,'%H:%i') as eurotime, exc_cost, total_tickets-sold_tickets as remain FROM excursions WHERE exc_date>=CURDATE() ORDER BY exc_date";
	$rs = mysql_query($strSQL);
	if (!$rs)
		{
			die("<p>������ ��� ���������� SQL-������� " . $strSQL . ": " . mysql_error() . "</p>");
		}
	
	echo '<form action="ticketsql.php" method="post">';
	echo '<table class="simple-little-table" cellspacing=0>';
	echo '<tr>';
	echo '<th>'. "��������" .'</th>';
	echo '<th>'. "���� ����������" .'</th>';
	echo '<th>'. "������" .'</th>';
	echo '<th>'. "���� ������" .'</th>';
	echo '<th>'. "������� ��������" .'</th>';
	echo '</tr>';
	while($row = mysql_fetch_array($rs)) {
		echo '<tr>';
		echo '<td>'. $row["exc_name"] .'</td>';
		echo '<td>'. $row["eurodate"] .'</td>';
		echo '<td>'. $row["eurotime"] .'</td>';
		echo '<td>'. $row["exc_cost"] .'</td>';
		echo '<td>'. $row["remain"] .'</td>';
		if ($row["remain"]<1)
		{
			echo '<td>'. "������� ���" .'</td>';
		}
		else
		{
			echo '<td><input type="submit" value="������ �����" name="������" class="button7"></td>';
		}
		echo '</tr>';
	}
	echo '</table>';
	echo '</form>';
?>

