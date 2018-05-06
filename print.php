<?php
	function pr_td($td) {
		echo("<td>$td</td>");
		return 0;
	}

	function pr_b_td($td) {
		pr_td("<b>$td</b>");
		return 0;
	}

	// Предпросчёт количества одинаковых типографий
	$arr = array(0);
	$prev_name = mysqli_fetch_array($data)['name'];
	mysqli_data_seek($data, 0);
	while ($row=mysqli_fetch_array($data)) {
		if ($prev_name == $row['name']) {
			$arr[count($arr)-1] += 1;
		} else {
			$prev_name = $row['name'];
			$arr[] = 1;
		}
	}
	
	// Название столбцов
	$titles = array('Press name', 'Index', 'Title', 'Author', 'Unit price, $', 'Content', 'Print price, $', 'Print time, days');
	// Ключи к значениям	
	$keys = array('name_np', 'name_author', 'mp', 'content', 'time', 'mpp');

	// Вывод названия столбцов
	mysqli_data_seek($data, 0);
	echo('<table border="1" cellpadding="4" cellspacing="0">');
	echo('<tr>');
	for ($i = 0; $i < count($titles); $i++) {
		pr_b_td($titles[$i]);
	}
	echo('</tr>');

	$i = 0; // Номер типографии
	while ($row=mysqli_fetch_array($data)) {
		echo('<tr>');
		if ($ind == 0) {
			$ind = $arr[$i]; // Количество строк с текущей типографией
			$i += 1;
			echo('<td rowspan="'.$ind.'">'.$row['name'].'</td>');
			echo('<td rowspan="'.$ind.'">'.$row['ind'].'</td>');
		}
		$ind -= 1;
		foreach($keys as $key) {
			pr_td($row[$key]); // Вывод всех значений
		}
		echo('</tr>');
	}
	echo('</table>');
?>
