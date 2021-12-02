<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
$objControl = new ABMRol();
$list = $objControl->buscar($data);
$arreglo_salida =  array();
foreach ($list as $elem ){
    
    $nuevoElem['idrol'] = $elem->getIdrol();
    $nuevoElem["rodescripcion"]=$elem->getRodescript();
    
   
   
    array_push($arreglo_salida,$nuevoElem);
}
//verEstructura($arreglo_salida);

echo json_encode($arreglo_salida,null,2);

?>