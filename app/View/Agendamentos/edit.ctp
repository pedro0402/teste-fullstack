<?php $this->assign('title', 'Editar Agendamento'); ?>
<div class="container">

	<div class="header">
		<div class="header-left">
			<h1>Editar Agendamento</h1>
			<p>Altere as informações do atendimento na agenda</p>
		</div>
		<div class="header-right">
			<?php echo $this->Html->link(
				'<i class="fas fa-calendar"></i> Ver Agenda',
				array('controller' => 'agendamentos', 'action' => 'index'),
				array('class' => 'btn btn-secondary', 'escape' => false)
			); ?>
			<?php echo $this->Html->link(
				'<i class="fas fa-arrow-left"></i> Voltar',
				array('controller' => 'prestadores', 'action' => 'index'),
				array('class' => 'btn btn-secondary', 'escape' => false)
			); ?>
		</div>
	</div>

	<?php echo $this->Form->create('Agendamento', ['class' => 'form-modern']); ?>
	<?php echo $this->Form->input('id', ['type' => 'hidden']); ?>
	<div class="form-grid">
		<div class="form-group">
			<?php echo $this->Form->input('prestador_id', [
				'label'   => 'Prestador',
				'class'   => 'form-control'
			]); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('servico_id', [
				'label'  => 'Serviço',
				'class'  => 'form-control'
			]); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('data_hora_inicio', [
				'type'    => 'text',
				'label'   => 'Início do Atendimento',
				'class'   => 'form-control datetimepicker',
			]); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('data_hora_fim', [
				'type'    => 'text',
				'label'   => 'Fim do Atendimento',
				'class'   => 'form-control datetimepicker',
			]); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('nome_cliente', [
				'label' => 'Nome do Cliente',
				'class' => 'form-control'
			]); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('telefone_cliente', [
				'label' => 'Telefone do Cliente',
				'class' => 'form-control',
				'placeholder' => '(82) 99653-5106',
				'maxlength' => 15,
				'id' => 'phoneNumber'
			]); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('status', [
				'label'   => 'Status',
				'class'   => 'form-control',
				'options' => $optionsStatus,
				'empty'   => 'Selecione um status'
			]); ?>
		</div>
		<div class="form-group" style="flex-basis:100%">
			<?php echo $this->Form->input('observacoes', [
				'label' => 'Observações',
				'class' => 'form-control'
			]); ?>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-save">
			<i class="fas fa-save"></i> Salvar
		</button>
		<?php echo $this->Html->link('<i class="fas fa-times"></i> Cancelar', array('controller' => 'agendamentos', 'action' => 'index'), array('class' => 'btn btn-cancel', 'escape' => false)); ?>
	</div>
	<?php echo $this->Form->end(); ?>
	<?php echo $this->Flash->render(); ?>
</div>

<div class="section" style="margin-top: 30px;">
	<?php echo $this->Form->postLink(
		'<i class="fas fa-trash"></i> Excluir agendamento',
		array('action' => 'delete', $this->Form->value('Agendamento.id')),
		array(
			'class' => 'btn btn-cancel',
			'escape' => false,
			'style' => 'color:#ef4444;border-color:#ef4444;background:#fff;margin-bottom:12px;'
		),
		__('Tem certeza que deseja excluir este agendamento?')
	); ?>
</div>

<!-- JS para data/hora e máscara de telefone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.datetimepicker').datetimepicker({
			dateFormat: 'dd/mm/yy',
			dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
			dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
			dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
			monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
			monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
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