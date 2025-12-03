<div class="prestadores view">
<h2><?php echo __('Prestador'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prestador['Prestador']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($prestador['Prestador']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($prestador['Prestador']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($prestador['Prestador']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prestador'), array('action' => 'edit', $prestador['Prestador']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prestador'), array('action' => 'delete', $prestador['Prestador']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $prestador['Prestador']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Prestadores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prestador'), array('action' => 'add')); ?> </li>
	</ul>
</div>
