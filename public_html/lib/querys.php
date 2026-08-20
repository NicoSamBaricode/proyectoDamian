<?php

function query_hist_liquidaciones($link)
{
	$query="select distinct id_liquidacion,liquidacion,fecha_hasta, nombre, apellido from liquidaciones l
	inner join personas p on l.persona=p.id_persona
	order by fecha_hasta";
	$record=mysql_query($query,$link);	

	return $record;
}

function query_responsables($link)
{
	$query_responsables="select id_persona,apellido,nombre from personas  order by apellido";
	$record_responsables=mysql_query($query_responsables,$link);	

	return $record_responsables;
}

function query_monedas($link)
{
	$query_monedas="select id_moneda,descripcion from monedas";
	$record_monedas=mysql_query($query_monedas,$link);	

	return $record_monedas;
}

function query_comisiones($link,$fdesde,$fhasta)
{
	$query_comisiones="select * from comisiones where fecha >='$fdesde' and  fecha <='$fhasta' order by tipo_factura desc, fecha, nro_factura";
	$record_comisiones=mysql_query($query_comisiones,$link);	

	return $record_comisiones;
}


?>