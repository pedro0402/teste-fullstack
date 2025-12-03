<div class="agendamentos form">
<?php echo $this->Form->create('Agendamento'); ?>
	<fieldset>
		<legend><?php echo __('Edit Agendamento'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('prestador_id');
		echo $this->Form->input('servico_id');
		echo $this->Form->input('data_hora_inicio');
		echo $this->Form->input('data_hora_fim');
		echo $this->Form->input('nome_cliente');
		echo $this->Form->input('telefone_cliente');
		echo $this->Form->input('status');
		echo $this->Form->input('observacoes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Agendamento.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Agendamento.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Agendamentos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Prestadores'), array('controller' => 'prestadores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prestador'), array('controller' => 'prestadores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Servicos'), array('controller' => 'servicos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Servico'), array('controller' => 'servicos', 'action' => 'add')); ?> </li>
	</ul>
</div>
