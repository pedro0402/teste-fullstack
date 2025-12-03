<div class="agendamentos index">
	<h2><?php echo __('Agendamentos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('prestador_id'); ?></th>
			<th><?php echo $this->Paginator->sort('servico_id'); ?></th>
			<th><?php echo $this->Paginator->sort('data_hora_inicio'); ?></th>
			<th><?php echo $this->Paginator->sort('data_hora_fim'); ?></th>
			<th><?php echo $this->Paginator->sort('nome_cliente'); ?></th>
			<th><?php echo $this->Paginator->sort('telefone_cliente'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('observacoes'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($agendamentos as $agendamento): ?>
	<tr>
		<td><?php echo h($agendamento['Agendamento']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($agendamento['Prestador']['id'], array('controller' => 'prestadores', 'action' => 'view', $agendamento['Prestador']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($agendamento['Servico']['nome'], array('controller' => 'servicos', 'action' => 'view', $agendamento['Servico']['id'])); ?>
		</td>
		<td><?php echo h($agendamento['Agendamento']['data_hora_inicio']); ?>&nbsp;</td>
		<td><?php echo h($agendamento['Agendamento']['data_hora_fim']); ?>&nbsp;</td>
		<td><?php echo h($agendamento['Agendamento']['nome_cliente']); ?>&nbsp;</td>
		<td><?php echo h($agendamento['Agendamento']['telefone_cliente']); ?>&nbsp;</td>
		<td><?php echo h($agendamento['Agendamento']['status']); ?>&nbsp;</td>
		<td><?php echo h($agendamento['Agendamento']['observacoes']); ?>&nbsp;</td>
		<td><?php echo h($agendamento['Agendamento']['created']); ?>&nbsp;</td>
		<td><?php echo h($agendamento['Agendamento']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $agendamento['Agendamento']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $agendamento['Agendamento']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $agendamento['Agendamento']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $agendamento['Agendamento']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Agendamento'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Prestadores'), array('controller' => 'prestadores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prestador'), array('controller' => 'prestadores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Servicos'), array('controller' => 'servicos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Servico'), array('controller' => 'servicos', 'action' => 'add')); ?> </li>
	</ul>
</div>
