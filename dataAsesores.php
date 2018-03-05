<?php
header("Access-Control-Allow-Origin: *");
require_once '../AnexGRID-master/anexgrid.php';
session_start();

$id_opera= $_SESSION['id_ope'];


try{
	$anexGrid = new AnexGrid();

	$wh = "idregistro > 0";
 
	foreach ($anexGrid->filtros as $f) 
	{
		if($f['columna'] == 'nombre') $wh .= " AND nombre LIKE '%" . addslashes($f['valor']) . "%'";
		if($f['columna'] == 'tMovil') $wh .= " AND tMovil = '" . addslashes($f['valor']) . "'";
		if($f['columna'] == 'ciudad') $wh .= " AND ciudad LIKE '%" . addslashes($f['valor']) . "%'";
		if($f['columna'] == 'pais') $wh .= " AND pais LIKE '%" . addslashes($f['valor']) . "%'";
		//if($f['columna']=='operador' && $f['valor'] != '') $wh .= " AND operador = '" . addslashes ($f['valor']) ."'";
		if($f['columna'] == 'fecha_asig') $wh .= " AND fecha_asig LIKE '%" . addslashes($f['valor']) . "%'";
		if($f['columna'] == 'fecha_a') $wh .= " AND fecha_a LIKE '%" . addslashes($f['valor']) . "%'";
		if($f['columna']=='estado' && $f['valor'] != '') $wh .= " AND estado = '" . addslashes ($f['valor']) ."'";
		if($f['columna']=='proxi_acci' && $f['valor'] != '') $wh .= " AND proxi_acci = '" . addslashes ($f['valor']) ."'";
		
	}

	$db = new PDO("mysql:dbname=;host=localhost;charset=utf8", "", "");
 
	// if(isset($f['columna']) && !empty($f['columna'])){
		if($f['columna'] == 'tMovil'){
			
			$registros =  $db->query("		
		SELECT * FROM registro_evento 
		WHERE $wh ORDER BY $anexGrid->columna $anexGrid->columna_orden
		LIMIT $anexGrid->pagina,$anexGrid->limite")->fetchAll(PDO::FETCH_ASSOC);
		
		}else{
			$registros =  $db->query("
			SELECT * FROM registro_evento 
			WHERE (operador='$id_opera') AND (estado='1' OR estado='16' OR estado='14') AND $wh ORDER BY $anexGrid->columna $anexGrid->columna_orden
			LIMIT $anexGrid->pagina,$anexGrid->limite")->fetchAll(PDO::FETCH_ASSOC);
		}

		
	$total = $db->query("
		SELECT COUNT(*) Total
		FROM registro_evento
		WHERE operador='$id_opera' AND $wh
	")->fetchObject()->Total;

	foreach ($registros as $k => $r) 
	{
		$estado = $db->query("SELECT * FROM estados WHERE id_est = " . $r['estado'])->fetch(PDO::FETCH_ASSOC);

		$registros[$k]['estado'] = $estado;
	}

	foreach ($registros as $k => $r) 
	{
		$proxi_acci = $db->query("SELECT * FROM proxi_acci WHERE id_proxi_acci = " . $r['proxi_acci'])->fetch(PDO::FETCH_ASSOC);

		$registros[$k]['proxi_acci'] = $proxi_acci;
	}
		
		print_r($anexGrid->responde($registros, $total));


}
catch(PDOException $e)
{
	echo $e->getMessage();
}
