<div class="agendamentos view">
<h2><?php echo __('Agendamento'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prestador'); ?></dt>
		<dd>
			<?php echo $this->Html->link($agendamento['Prestador']['id'], array('controller' => 'prestadores', 'action' => 'view', $agendamento['Prestador']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Servico'); ?></dt>
		<dd>
			<?php echo $this->Html->link($agendamento['Servico']['nome'], array('controller' => 'servicos', 'action' => 'view', $agendamento['Servico']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data Hora Inicio'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['data_hora_inicio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data Hora Fim'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['data_hora_fim']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome Cliente'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['nome_cliente']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefone Cliente'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['telefone_cliente']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observacoes'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['observacoes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($agendamento['Agendamento']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Agendamento'), array('action' => 'edit', $agendamento['Agendamento']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Agendamento'), array('action' => 'delete', $agendamento['Agendamento']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $agendamento['Agendamento']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Agendamentos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agendamento'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prestadores'), array('controller' => 'prestadores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prestador'), array('controller' => 'prestadores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Servicos'), array('controller' => 'servicos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Servico'), array('controller' => 'servicos', 'action' => 'add')); ?> </li>
	</ul>
</div>
