<div class="agendamentos form">
<?php echo $this->Form->create('Agendamento'); ?>
	<fieldset>
		<legend><?php echo __('Add Agendamento'); ?></legend>
	<?php
		echo $this->Form->input('prestador_id');
		echo $this->Form->input('servico_id');
		echo $this->Form->input('data_hora_inicio', array(
			'type' => 'text',
			'label' => 'Início do Atendimento',
			'class' => 'datetimepicker',
			'readonly' => true 
		));
		echo $this->Form->input('data_hora_fim', array(
					'type' => 'text',
					'label' => 'Fim do Atendimento',
					'class' => 'datetimepicker',
					'readonly' => true 
				));
		echo $this->Form->input('nome_cliente');
		echo $this->Form->input('telefone_cliente');
		echo $this->Form->input('status', array('options' => $optionsStatus, 'empty' => 'Selecione um status'));
		echo $this->Form->input('observacoes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Agendamentos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Prestadores'), array('controller' => 'prestadores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prestador'), array('controller' => 'prestadores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Servicos'), array('controller' => 'servicos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Servico'), array('controller' => 'servicos', 'action' => 'add')); ?> </li>
	</ul>
</div>


<script type="text/javascript">
$(document).ready(function() {
    $('.datetimepicker').datetimepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',

        timeFormat: 'HH:mm',
        hourText: 'Horas',
        minuteText: 'Minutos',
        timeText: 'Tempo',
        controlType: 'select'
    });
});
</script>