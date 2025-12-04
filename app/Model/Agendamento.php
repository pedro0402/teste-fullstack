<?php
App::uses('AppModel', 'Model');

class Agendamento extends AppModel {

    public $displayField = 'nome_cliente';

    public $validate = array(
        'prestador_id' => array(
            'numeric' => array('rule' => array('numeric')),
        ),
        'servico_id' => array(
            'numeric' => array('rule' => array('numeric')),
        ),
        'nome_cliente' => array(
            'notBlank' => array('rule' => array('notBlank')),
        ),
        // ### PARTE 1: MODIFICAR A REGRA AQUI ###
        'data_hora_inicio' => array(
            'custom_format' => array(
                // A regra agora chama nossa própria função, 'validateDateTimeFormat'
                'rule' => array('validateDateTimeFormat'),
                'message' => 'Por favor, insira uma data e hora válidas no formato DD/MM/AAAA HH:MM.',
                'allowEmpty' => false
            )
			),
		'data_hora_fim' => array(
			'custom_format' => array(
				'rule' => array('validateDateTimeFormat'),
				'message' => 'Por favor, insira uma data e hora válidas (DD/MM/AAAA HH:MM).',
				'allowEmpty' => true // Pode ser vazio? Se sim, 'true'. Se não, 'false'.
			)
    )
    );

    public $belongsTo = array(
        // ... seu belongsTo continua o mesmo ...
        'Prestador' => array('className' => 'Prestador', 'foreignKey' => 'prestador_id'),
        'Servico' => array('className' => 'Servico', 'foreignKey' => 'servico_id')
    );

    // ### PARTE 2: ADICIONAR A NOSSA FUNÇÃO DE VALIDAÇÃO ###
    public function validateDateTimeFormat($check) {
        // Pega o valor do campo (ex: '04/12/2025 15:30')
        $dateTimeString = array_values($check)[0];

        // Usa a mesma lógica do beforeSave para TENTAR criar um objeto DateTime.
        // Se a data for inválida (ex: 32/12/2025), createFromFormat retorna false.
        $d = DateTime::createFromFormat('d/m/Y H:i', $dateTimeString);

        // A validação passa se:
        // 1. O objeto foi criado com sucesso (não é false).
        // 2. A string que o objeto gerou de volta é a mesma que entrou. Isso evita datas como "31/02/2025" que o PHP às vezes "corrige" para Março.
        return $d && $d->format('d/m/Y H:i') === $dateTimeString;
    }

	public function beforeSave($options = array()) {
		// Lista de campos que precisam de conversão de formato
		$camposDeData = array('data_hora_inicio', 'data_hora_fim');

		foreach ($camposDeData as $campo) {
			if (!empty($this->data[$this->alias][$campo])) {
				$dataHoraDoFormulario = $this->data[$this->alias][$campo];
				
				// Só converte se não estiver no formato do banco
				// (evita reconverter ao editar sem mudar a data)
				if (strpos($dataHoraDoFormulario, '/') !== false) {
					$dataObj = DateTime::createFromFormat('d/m/Y H:i', $dataHoraDoFormulario);
					if ($dataObj) {
						$this->data[$this->alias][$campo] = $dataObj->format('Y-m-d H:i:s');
					} else {
						return false; // Formato inválido
					}
				}
			}
		}
		return true;
	}
}