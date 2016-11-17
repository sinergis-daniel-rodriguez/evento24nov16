<?php
/* 
Primer Reload:
En index, incrementa comodin-refresh en +1 y guardar y subir index
Controlador, descomentar la linea de reload
Valor a comparar en IF es el valor anterior a comodin-refresh

Post Evento
Solo Descomentar Encuesta, en la linea 15
*/
	if($_POST["refresh"]=='0'){
        //echo "window.location.reload();";
    }
    if ($_POST["encuesta"] == '0') {
    	//echo "$('#mymodalnew').modal('show');";
    }
?>