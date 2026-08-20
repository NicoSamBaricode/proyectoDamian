<?php
header('Content-Type: text/html; charset=iso-8859-1');
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php");
if ($_SESSION['permiso'] != 'autorizado'){
	$mensaje="Usuario sin permisos";
	$destino="../index.php";
	header("location:../lib/mensaje.php?mensaje=$mensaje&destino=$destino");
}
//--------------------------------Fin inicio de sesion------------------------

include("../lib/funciones.php");

$link_mysql=conectarse();


/////Cargo Valores del contenido------------------------------------------------------
if (isset($_GET['id'])){
	
	$id=$_GET['id'];
	
	$solo_lectura=1; //utilizado para bloquear y desbloquear para la edicion.
	$agregar_control=1; //habilita para agregar certificado de control a este.
	

	$sql="select descripcion,dia,hora,coordinador from discipulados
	where id_grupo='$id'";
	
	$recordset=mysql_query($sql,$link_mysql);
	
	$record=mysql_fetch_array($recordset);
	
	$campo1=$record["descripcion"];
	$campo2=$record["dia"];
	$campo3=$record["hora"];
	$campo4=$record["coordinador"];
	
	
	
	
	
	//-----------------Listado dependiente-----------------------------------------------------------------------
	$query_t1="select a.id_persona_grupo as id_persona_grupo,b.id_persona,b.apellido as apellido,b.nombre as nombre,b.nro_documento as nro_documento,b.tel from personas_discipulados a,personas b ,discipulados c 
where a.id_persona=b.id_persona
and a.id_grupo=c.id_grupo 
and c.id_grupo='$id'
and a.activo='1' 
order by apellido";
	
	$recordset_t1=mysql_query($query_t1,$link_mysql);
	//--------------------------------------------------------------------------------------------------------------------------
			
			
}
else
{
	$campo1="";
	$campo2="";
	$campo3="";
	$campo4="";
}
/////fin Cargo Valores del contenido--------------------------------------------------------------------------


?>


<html>
  	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
	<title>Grupo</title>
	<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
    
	
<style type="text/css">

@import "../css/demo_page.css";
@import "../css/demo_table.css";
@import "../css/themes/base/jquery-ui.css";
@import "../css/themes/smoothness/jquery-ui-1.7.2.custom.css";
@import "../css/jquery.dataTables.css";
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>

<script src="../jscripts/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="../jscripts/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../jscripts/js/jquery-ui.js" type="text/javascript"></script>

<script language='javascript' src="../jscripts/funciones.js"></script>
<script src="../jscripts/popcalendar.js"></script> 

  
   
<script type="text/JavaScript">

//---Para el manejo de tablas--------------------------
$(document).ready( function() {

            var tabla = $("#t_certificados").dataTable({			
				"bJQueryUI": true,
				"bFilter": true,
				"bPaginate": true,
				"bSort": true,
				"bLengthChange": true,
				"iDisplayLength": 10,
				"aaSorting": [],
				"sPaginationType": "two_button",
				//-----Esto son etiquetas para mostrar en castellano, si se quita anda todo pero muestra en ingles
				"oLanguage": {
						"sLengthMenu": "Muestra _MENU_ registros por página",
						"sZeroRecords": "Ningún registro encontrado",
						"sInfo": "Registros: _START_ al _END_ - Total: _TOTAL_ registros",
						"sInfoEmpty": "Muestra 0 al 0 de 0 registros",
						"sInfoFiltered": "(Filtrados desde _MAX_ total de registros )",
						"sSearch": "Buscar:",	
				}
				//----------Fin etiquetas-------------------------------------------------------------------------		
			});
		});
	

   
 
 
function setea_pantalla(){

	if(document.form1.txt_solo_lectura.value==1){
		document.form1.txt_documento.disabled=true;
		document.form1.txt_nombre.disabled=true;
		document.form1.txt_telefono.disabled=true;
		document.form1.txt_observaciones.disabled=true;
		document.form1.button.disabled=true;
	}
	
}

function btn_editar(){
		document.form1.txt_documento.disabled=true;
		document.form1.txt_nombre.disabled=false;
		document.form1.txt_telefono.disabled=false;
		document.form1.txt_observaciones.disabled=false;
		document.form1.button.disabled=false;
}
   
//-------------Validaciones del formulario---------------------------//
function validar(frm) {

	//var patronCUIT = /[23]{1}[0347]{1}[0-9]{8}[0-8]{1}|[1-9]{1}[0-9]{7}|[1-9]{1}[0-9]{6}/;
	var patronCUIT = /[2,3]{1}[0,3,4,7]{1}[0-9]{8}[0-8]{1}/;
	var patronDNI1 = /[1-9]{1}[0-9]{6,7}/;
	var patronDNI2= /[1-9]{1}[0-9]{6}/;
	
	
    if (!(document.form1.txt_documento.value.match(patronCUIT)) && !(document.form1.txt_documento.value.match(patronDNI1))  ) {
        alert("formato de DNI o CUIT incorrecto"); 
		document.form1.txt_documento.focus();
  		return (false); 
    }
	
   if ( document.form1.txt_nombre.value == ".." || vacio(document.form1.txt_nombre.value)==false ){
  		alert("Debe ingresar un nombre"); 
		document.form1.txt_nombre.focus();
  		return (false); 
  	}
	
	if (!confirm('¿Confirma el registro del propietario?')){   
	   return (false); 
   }
   
}
//-------------Fin validaciones del formulario---------------------------//   


</script>

</head>
   <body onLoad="setea_pantalla();" >
   
   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <td width="770"><?php include("../lib/encabezado.php"); ?></td>
     </tr>
     <tr>
       <td></td>
     </tr>
     <tr>
       <td>	          </td>
     </tr>
     <tr>
       <td class="titulopantalla">Grupo</td>
     </tr>
     <tr align="left" valign="middle" bgcolor="#FFFFFF">
       <td class="etiquetas"><?php include("../lib/barra_menu_standard.php"); ?></td>
     </tr>
     <tr align="left" valign="middle" bgcolor="#FFFFFF">
       <td class="etiquetas"><?php include("../lib/barra_menu_grupos.php"); ?></td>
     </tr>
     <tr>
       <td align="left" valign="top"><table width="770" border="0" cellspacing="0" cellpadding="0">
           <tr valign="top">
           <td align="center"><form action="procesa_am_grupo.php" method="post" name="form1" id="form1" onSubmit="return validar(this)" >
           <table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
                   <tr>
                     <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                  <tr>
                           <td width="190" height="40" align="left" valign="bottom" class="etiquetas"><input type="button" name="btn_editar_area2" id="btn_editar_area2" value="Editar datos" onClick="btn_editar();"></td>
                           <td width="550" height="40" align="left" valign="bottom"><input name="txt_estado" type="hidden" id="txt_estado" value="<?php echo $estado;?>">
                           <input name="txt_solo_lectura" type="hidden" id="txt_solo_lectura" value="<?php echo $solo_lectura;?>">
                           <input name="hd_id" type="hidden" class="datos" id="hd_id" tabindex="2" onKeyPress="return tabular(event,this)" value="<?php echo $id;?>" size="11" maxlength="11" /></td>
                       </tr>
                       <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">Nombre :</td>
                         <td width="550" align="left" valign="middle"><input name="txt_1" type="text" class="dato_grande" id="txt_1" tabindex="2" onKeyPress="return tabular(event,this)" value="<?php echo $campo1;?>" size="15" maxlength="11" /></td>
                       </tr>
                       <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">D&iacute;a:</td>
                   <td width="550" align="left" valign="middle"><span class="style17">
                             <input name="txt_2" type="text" class="datos" id="txt_2" tabindex="3" onKeyPress="return tabular(event,this)"   size="50" maxlength="50" value="<?php echo $campo2;?>" />
                           </span></td>
                       </tr>
                         <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">Horario:</td>
                           <td width="550" align="left" valign="middle"><input name="txt_3" type="text" class="datos" id="txt_3" tabindex="2" onKeyPress="return tabular(event,this)" value="<?php echo $campo3;?>" size="50" maxlength="50" /> </td>
                       </tr>
                         <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">Coordinador:</td>
                         <td width="550" align="left" valign="middle">
                         
                         <select name="txt_4" class="datos" id="txt_4" tabindex="8" onkeypress="return tabular(event,this)">
                           <?php
						   $sql2_combo1="select apellido,nombre from personas where id_persona='$campo4' and coordinador='1'";
						   $record2_combo1=mysql_query($sql2_combo1,$link_mysql);
						   $valor_base=mysql_fetch_array($record2_combo1);
						   
                           $sql_combo1="select id_persona,apellido,nombre from personas where id_persona <> '$campo4' and coordinador='1' order by apellido";
							$record_combo1=mysql_query($sql_combo1,$link_mysql);
                           
                           ?>
                           <option  value="<?php echo $campo4;?>" selected="selected"><?php echo $valor_base["apellido"].",".$valor_base["nombre"];?></option>
                           <?php
            while($list_combo1=mysql_fetch_array($record_combo1)){ ?>
                           <option  value="<?php echo $list_combo1["id_persona"]; ?>"><?php echo $list_combo1["apellido"].",".$list_combo1["nombre"]; ?></option>
                           <?php				
            }
            ?>
            <option  value="">Ninguno</option>
                         </select>
                         </td>
                       </tr>
                         <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">&nbsp;</td>
                           <td width="550" align="left" valign="middle">&nbsp;</td>
                       </tr>
                       
  <tr >
         <td width="190" align="left" valign="middle" class="etiquetas">&nbsp;</td>
         <td width="550" align="left" valign="middle">&nbsp;</td>
    </tr>
                         <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">Observaciones:</td>
                         <td width="550" align="left" valign="middle"><label>
                             <textarea name="txt_observaciones" cols="60" rows="5" class="datos" id="txt_observaciones" tabindex="7"><?php echo $observaciones;?></textarea>
                           </label></td>
                       </tr>
                         
                         
                         

     

                          <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas"><label>
                     
                           </label></td>
                           <td width="550" align="left" valign="middle"><label></label>
                             <label></label></td>
                       </tr>
                        
                         
                         
                         <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">&nbsp;</td>
                           <td width="550" align="left" valign="middle">&nbsp;</td>
                       </tr>
                         <tr>
                           <td align="left" valign="middle" class="etiquetas"><input type="submit" name="button" id="button" value="Guardar" onMouseOver="solapamiento();" onFocus="solapamiento();" tabindex="11" ></td>
                           <td align="left" valign="middle"><input type="hidden" name="hd_solapa_inicio" id="hd_solapa_inicio">
                           <input type="hidden" name="hd_solapa_fin" id="hd_solapa_fin"></td>
                         </tr>
                         <tr>
                           <td align="left" valign="middle" class="etiquetas">&nbsp;</td>
                           <td align="left" valign="middle">&nbsp;</td>
                         </tr>
                     </table></td>
                   </tr>
                 </table>
             </form></td>
         </tr>
         
           
     <tr align="left" valign="middle">
       <td height="50" class="sub_titulopantalla" >&nbsp;</td>
     </tr>
       </table></td>
     </tr>
     <tr>
       <td><table width="100%" border="0">
        <tr>
       <td bgcolor="#CCCCCC" class="sub_titulopantalla" >Personas en el grupo</td>
     </tr>
         <tr>
           <td><form name="form2" method="post" action="asocia_persona_grupo.php">
             <table width="30%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td width="50" align="center" valign="middle">Persona:                  </td>
                 <td width="50" align="center" valign="middle">
                 <select name="txt_asociado" id="txt_asociado">
                 
                      <option  value="<?php echo $campo4;?>" selected="selected"><?php echo $nombre_propietario_selec;?></option>
                    	<?php
							$query_combo1="select id_persona,apellido,nombre from personas order by apellido";
							$recordset_combo1=mysql_query($query_combo1,$link_mysql);
							
                 			 while($record_combo1=mysql_fetch_array($recordset_combo1)){ 
                  		?>
                    			<option  value="<?php echo $record_combo1["id_persona"]; ?>"><?php echo $record_combo1["apellido"].",".$record_combo1["nombre"]; ?></option>
                   		<?php
                    
                  			}
                		?>
                 </select>
                 <input name="hd_id2" type="hidden" class="datos" id="hd_id2" tabindex="2" onKeyPress="return tabular(event,this)" value="<?php echo $id;?>" size="11" maxlength="11" />                 </td>
                 <td width="50" align="center" valign="middle"><img src="../images/nuevo.gif" width="40" height="40" onClick="document.form2.submit()"></td>
               </tr>
             </table>
                      </form>
           </td>
         </tr>
         
         <?php if (isset($_GET['id'])){ //si se esta creando vehiculo no muestra controles ?>
         <tr>
           <td><table width="100%" border="0" cellspacing="1" id="t_certificados">
             <thead>
               <tr>
                 <th class="tabla_encabezado">Apellido</th>
                 <th class="tabla_encabezado">Nombre</th>
                 <th class="tabla_encabezado">&nbsp;</th>
                 <th class="tabla_encabezado">Telefono</th>
                 <th class="tabla_encabezado">Documento</th>
               </tr>
             </thead>
             <tbody>
               <?php 
		
		while($record=mysql_fetch_array($recordset_t1)){ 
		 ?>
               <tr class="datos" >
                 <td><a href="am_persona.php?id=<?php echo $record["id_persona"];?>" class="enlace_datos"><?php echo $record["apellido"];?></a></td>
                 <td><a href="am_persona.php?id=<?php echo $record["id_persona"];?>" class="enlace_datos"><?php echo $record["nombre"];?></a></td>
                 <td><form name="form3" method="post" action="baja_persona_grupo.php">
                   <input name="hd_id_dependiente" type="hidden" id="hd_id_dependiente" value="<?php echo $record["id_persona_grupo"];?>">
                   <input name="hd_id2" type="hidden" class="datos" id="hd_id2" tabindex="2" onKeyPress="return tabular(event,this)" value="<?php echo $id;?>" size="11" maxlength="11" />
                   <label>
                   <input type="submit" name="button2" id="button2" value="Quitar">
                   </label>
                 </form>                 </td>
                 <td><a href="am_persona.php?id=<?php echo $record["id_persona"];?>" class="enlace_datos"><?php echo $record["tel"];?></a></td>
                 <td><a href="am_persona.php?id=<?php echo $record["id_persona"];?>" class="enlace_datos"><?php echo $record["nro_documento"];?></a></td>
               </tr>
               <?php 
		  }
		  ?>
             </tbody>
           </table></td>
         </tr>
          <?php }//fin si existe la matricula?>
         
       </table></td>
     </tr>
    
     
   </table>
</body>
</html>
