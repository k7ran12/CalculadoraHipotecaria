<?php
date_default_timezone_set('America/Lima');
	$fecha_actual = date("d-m-Y");

	setlocale(LC_TIME, 'spanish');

//sumo 1 mes

$i = 1;

while ($i < 120) {
echo strftime("%B %Y",strtotime($fecha_actual."+ $i month"))."<br>";
$i++;
}
