<?php
include_once('../estructura/cabeceraNueva.php');
include_once('../../configuracion.php');

$objRol = new ABMRol();

$arreglo=$objRol->buscar(null);
$rolesUs = $session->getRol();
$error=false;
foreach($rolesUs as $r){
    if($r == "administrador"){
if($session->activa() && $datouser['rol'] == "administrador"){


/* 
    $objControl = new ABMrol();
$List_Menu = $objRol->buscar(null);
$combo = '<select class="easyui-combobox"  id="idrol"  name="idrol" label="Submenu de?:" labelPosition="top" style="width:90%;">
<option></option>';
foreach ($List_Menu as $objRol){
    $combo .='<option value="'.$objRol->getIdrol().'">'.$objRol->getRodescript().'</option>';
}

$combo .='</select>'; */


?>

    <!-- Start Cart  -->
    <head>

<title>Roles</title>
<link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/color.css">
<!-- <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/demo/demo.css"> -->

</head>
    <div class="cart-box-main">
        <div class="container">
        <h2>GESTIONAR ROL</h2>
<p>Seleccione la acci&oacute;n que desea realizar.</p>

<table id="dg" title="Administrador de Roles" class="easyui-datagrid" style="width:450px;height:350px;"
    url="accion/listar_menu.php" toolbar="#toolbar" pagination="true"rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
            <th field="idrol" width="200">ID</th>
            <th field="rodescripcion" width="200">Nombre</th>
    <!--         <th field="medescripcion" width="50">Descripci&oacute;n</th>
            <th field="idpadre" width="50">Submenu De:</th>
             <th field="medeshabilitado" width="50">Deshabilitado</th> -->
            </tr>
            </thead>
            </table>
            <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMenu()">Nuevo Rol </a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editMenu()">Editar Rol</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyMenu()">Baja Rol</a>
            </div>
            
            <div id="dlg" class="easyui-dialog" style=" width:600px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Menu Informacion</h3>
            <div style="margin-bottom:10px;">
            
                      
            <input  name="idrol" id="idrol" class="easyui-textbox" required="true" label="ID ROL:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
            <input  name="rodescripcion" id="rodescripcion"  class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
            </div>
            <!-- <div style="margin-bottom:10px"> -->
           <!--  <?php 
               /*  echo $combo; */
            ?> -->
           <!--   
            </div>
              <div style="margin-bottom:10px">
            <input class="easyui-checkbox" name="medeshabilitado" value="medeshabilitado" label="Des-Habilitar:">
        </div> -->
            </form>
            </div>
            <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMenu()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
            </div>
            <script type="text/javascript">
            var url;
            function newMenu(){
                
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Rol');
                $('#fm').form('clear');
                url = 'accion/alta_menu.php';
            }
            function editMenu(){
                var row = $('#dg').datagrid('getSelected');
                if (row){
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Rol');
                    $('#fm').form('load',row);
                    url = 'accion/edit_menu.php?accion=mod&idmenu='+row.idmenu;
                }
            }
            function saveMenu(){
            	//alert(" Accion");
                $('#fm').form('submit',{
                    url: url,
                    onSubmit: function(){
                        return $(this).form('validate');
                    },
                    success: function(result){
                        var result = eval('('+result+')');

                        //alert("Volvio Serviodr");   
                        if (!result.respuesta){
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                           
                            $('#dlg').dialog('close');        // close the dialog
                            $('#dg').datagrid('reload');    // reload 
                        }
                    }
                });
            }
            function destroyMenu(){
                var row = $('#dg').datagrid('getSelected');
                if (row){
                    $.messager.confirm('Confirm','Seguro que desea eliminar el menu?', function(r){
                        if (r){
                            $.post('accion/eliminar_menu.php?idrol='+row.idrol,{idrol:row.id},
                               function(result){
                               	 //alert("Volvio Serviodr");   
                                 if (result.respuesta){
                                   	 
                                    $('#dg').datagrid('reload');    // reload the  data
                                } else {
                                    $.messager.show({    // show error message
                                        title: 'Error',
                                        msg: result.errorMsg
                                  });
                                }
                            },'json');
                        }
                    });
                }
            }
            


            </script>

            <?php
/* 
            $datos = data_submitted();
            if(isset($datos['true'])){
                echo "<span class='text-success border border-success'>exito se elimino correctamente!</span>";
            }
            if(isset($datos['false'])){
                echo "<span class='text-danger border border-danger'>No se pudo eliminar item!</span>";
            }
            
            if(isset($datos['modifytrue'])){
                echo "<span class='text-success border border-success'>Modificado Correctamente.</span>";
            }
            if(isset($datos['modifyfalse'])){
                echo "<span class='text-danger border border-danger'>No Modificado! no ha cambiado los kg que desea comprar.</span>";
            }
            
            ?>
            <div class="row">
                <div class="">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Rol</th>
                                    <th>Rol</th>
                                    <th>Editar Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mostrar = false;
                                if(count($arreglo)>0){
                                    foreach ($arreglo as $rol){

                                ?>
                                <form method="post" action="../accion/accionEditarRol.php?rol=administrador">
                                    <tr>
                                        <td class="thumbnail-img remove-pr" name="idcompraitem">
                                            <input type="hidden" name="idrol" value="<?php echo $rol->getIdrol();?>">
                                            <?php echo $rol->getIdrol();?>
                                        </td>
                                        <td class="thumbnail-img remove-pr">
                                            
                                            <input type ="text" name="rodescripcion" value="<?php echo $rol->getRodescript();?>">
                                        </td>
                                        <td class="remove-pr ">
                                            <button class="border-0 bg-white" type="submit" value=""><i class='fas fa-edit'></i></button>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                                    }
                                    $mostrar= true;
                                }
                                if(!$mostrar){?>
                                    <td class="thumbnail-img">
                                        <?php echo "no hay Items en el carrito";?>
                                    </td>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <?php
                    
                    ?>
                    <div class="row my-5">
                        <div class="col-lg-6 col-sm-6"></div>
                        <div class="col-lg-6 col-sm-6">
                            <form method="post" action="crearRol.php?rol=administrador">
                                <div class="update-box">
                                    <input value="Crear Rol" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    
                    ?>
                </div>
                
            </div> */?>






        </div>
    </div>
    
    <?php
$error=true;
}
}
}
if(!$error){
    echo '<div class="alert alert-danger" role="alert">Acceso Denegado</div>';
}

?>
    <!-- End Cart -->

<?php
include_once('../estructura/pie.php');
?>