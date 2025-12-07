<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $agendamentos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'prestador_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'servico_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'data_hora_inicio' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'data_hora_fim' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'nome_cliente' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'telefone_cliente' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'status' => array('type' => 'enum(\'Agendado\',\'Confirmado\',\'Concluído\',\'Cancelado\')', 'null' => false, 'default' => 'Agendado', 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'observacoes' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'agendamentos_ibfk_1' => array('column' => 'prestador_id', 'unique' => 0),
			'agendamentos_ibfk_2' => array('column' => 'servico_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8mb3', 'collate' => 'utf8mb3_general_ci', 'engine' => 'InnoDB')
	);

	public $prestadores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'nome' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'telefone' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'foto' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'servico_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'valor_servico' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb3', 'collate' => 'utf8mb3_general_ci', 'engine' => 'InnoDB')
	);

	public $servicos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'nome' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'descricao' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8mb3_general_ci', 'charset' => 'utf8mb3'),
		'valor' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb3', 'collate' => 'utf8mb3_general_ci', 'engine' => 'InnoDB')
	);

}
