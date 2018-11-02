<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
Plantilla::apply();
//var_dump($articulos_vendidos);
?>
<br><br>
<div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://itla.edu.do/identidad_corporativa/Logo_Full_Color/Logo_Color_Full.png" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Factura #: <?= $factura[0]->id ?><br>
                                Fecha creacion: <?= $factura[0]->fecha_facturacion ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Instituto de las americas<br>
                                Santo Domingo Este/ Rep.Dom<br>
                            </td>
                            
                            <td>
                                Cliente factura rapida.<br>
                                Codigo de cliente: <?= $factura[0]->codigo_cliente ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                	<div class="form-inline"><div style="width: 40%;">Nombre</div> <div style="margin-left: 40%;">Cantidad</div></div>
                    
                </td>             
                <td>
                	<div class="form-inline"> <div style="margin-left: 30%; margin-right: 10%;">Precio</div><div class="text-center" style="width: 40%;">Total</div></div>                
                </td>
            </tr>
            	<?php foreach ($articulos_vendidos as $articulo): ?>
				<tr class="item">
                  <td>
  			    <div class="form-inline"><div style="width: 40%;"><?= $articulo->nombre ?></div> <div style="margin-left: 40%;"><?= $articulo->cantidad ?></div></div>
                  </td>             
                  <td>
                  	<div class="form-inline"> <div style="margin-left: 30%; margin-right: 10%;"><?= $articulo->precio ?></div><div class="text-right" style="width: 40%;"><?= $articulo->cantidad*$articulo->precio ?></div></div>
                    
                  </td>              
               </tr>
				<?php endforeach;?>

            <tr class="total">
                <td></td>
                
                <td>
                   Total: $<?= $factura[0]->total ?>
                </td>
            </tr>
        </table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	  window.print();
	});
</script>