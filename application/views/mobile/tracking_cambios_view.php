<div data-role="dialog" id="popupBasic">
	<div data-role="content" >
        <h3><?=lang('tracking.cambio.title');?></h3>
		<p><?=lang('tracking.cambio.slogan');?></p>			
		<span id="alert_fecha_entrega"><?=lang('tracking.cambio.data1');?><b><?= $cambios["fecha_entrega_cliente"] ?></b></span><br>
		<span id="alert_franja"><?=lang('tracking.cambio.data2');?><b><?= $cambios["franja"] ?></b></span><br>
		<span id="alert_telf1"><?=lang('tracking.cambio.data3');?><b><?= $cambios["telf1"] ?></b></span><br>
		<span id="alert_telf2"><?=lang('tracking.cambio.data4');?><b><?= $cambios["telf2"] ?></b></span><br>
		<span id="alert_email"><?=lang('tracking.cambio.data5');?><b><?= $cambios["email"] ?></b></span><br>
		<span id="alert_comentarios"><?=lang('tracking.cambio.data6');?><i><?= $cambios["comentarios"] ?></i></span><br><br>			 			 
		<p><?=lang('tracking.cambio.que_hacer');?></p>
		<a href="<?= base_url() ?>es/tracking/" data-role="button" ><?=lang('tracking.cambio.hacer_ok');?></a>
		<a href="#" data-role="button" data-rel="back"><?=lang('tracking.cambio.hacer_ko');?></a>
    </div>
</div>