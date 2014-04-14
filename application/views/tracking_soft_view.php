<div id="content">
	<div class="container">
		<!-- Titulo y slogan -->
		<div class="row">
			<div class="span12">  
				<h3><?=lang('tracking.slogan');?></h3>
				<div class="caption">
					<a  class="lead"><?=lang('tracking.lead');?></a><br>
					<p class="alignJustify"><?=lang('tracking.align2');?></p>
				</div>
			</div>
		</div>

		<!-- Resultados -->
		<div class="clear"></div>
		<div class="row">
			<div class="span12 tk_content" style="display:block;">
				<?php if(isset($status) && $status != 'KO'){ ?>
					<h4 class="tk_num_pedido"><?=$info['data']['expedicion'] ?></h4>
					<!-- Left Panel -->
					<div class="span5">
						<div class="caption w100x100">
							<!-- en ruta -->
							<div style="display:block" id="div_tk_ruta">
							<span class="tk_data-line" id="tk_ruta_estado"><?=lang('tracking.soft.data1');?><font class="dataBold" id="estadoList" style="color:<?= $info['data']['colorDesc'];?>;"><?= $info['data']['estado_entrega']?></font><br/><font id="sloganList"><?= $info['data']['estadoSlogan']?></font></span>
							<p style="float:left;"><br/><?=lang('tracking.soft.data2');?></p>
							<?php if($info['data']['cf_estado'] != 3 && $info['data']['cf_agencia_destino'] != 15){ ?>
								<span id="tk_button_line" class="tk_data-line "><a href="<?= base_url().$this->lang->lang();?>/tracking" class="btn btn-small" id="btn_show_franja_ruta" style="margin-top:5px;" data-type="submit"><?=lang('tracking.soft.data3');?></a></span>
							<?php } ?>
							</div>
						</div>
					</div>
				<?php }else{ ?>
					<!-- Left Panel -->
					<div class="span5">
						<div class="caption w100x100">
							<!-- en ruta -->
							<div style="display:block" id="div_tk_ruta">
							<h4 class="tk_num_pedido" >Error</h4>
							<span class="tk_data-line" id="tk_ruta_estado" style="color:red;"><b><?= $msg ?></b></span>														
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		
		<!-- Dudas -->
		<div class="clear"></div>
		<div class="row">
			<div class="span12">
				<div class="caption">
					<a  class="lead"><?=lang('tracking.dudas.title');?></a><br>
					<p class="alignJustify"><?=lang('tracking.dudas.description');?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
		
</script>