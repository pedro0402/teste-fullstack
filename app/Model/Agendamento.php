<?php
App::uses('AppModel', 'Model');

class Agendamento extends AppModel
{

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
                'allowEmpty' => true
            ),
            'isAfterOrEqualStart' => array(
                'rule'    => array('checkEndAfterOrEqualStart'),
                'message' => 'A data final não pode ser menor que a data inicial.',
                'allowEmpty' => true
            )
            ),
    );

    public $belongsTo = array(
        // ... seu belongsTo continua o mesmo ...
        'Prestador' => array('className' => 'Prestador', 'foreignKey' => 'prestador_id'),
        'Servico' => array('className' => 'Servico', 'foreignKey' => 'servico_id')
    );

    public function validateDateTimeFormat($check)
    {
        $dateTimeString = array_values($check)[0];

        $d = DateTime::createFromFormat('d/m/Y H:i', $dateTimeString);

        return $d && $d->format('d/m/Y H:i') === $dateTimeString;
    }

    public function beforeSave($options = array())
    {

        $camposDeData = array('data_hora_inicio', 'data_hora_fim');

        foreach ($camposDeData as $campo) {
            if (!empty($this->data[$this->alias][$campo])) {
                $dataHoraDoFormulario = $this->data[$this->alias][$campo];

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

    public function checkEndAfterOrEqualStart($check)
    {
        // Se fim vazio, ok
        $fim = array_values($check)[0];

        if (empty($this->data[$this->alias]['data_hora_inicio']) || empty($fim)) {
            return true;
        }

        // Converta ambos para timestamp (considerando que foi convertido para Y-m-d H:i:s no beforeSave)
        $inicio = $this->data[$this->alias]['data_hora_inicio'];
        $fim    = $this->data[$this->alias]['data_hora_fim'];

        // Se algum vier no formato brasileiro, converta:
        if (strpos($inicio, '/') !== false) {
            $dt = DateTime::createFromFormat('d/m/Y H:i', $inicio);
            if ($dt) $inicio = $dt->format('Y-m-d H:i:s');
        }
        if (strpos($fim, '/') !== false) {
            $dt = DateTime::createFromFormat('d/m/Y H:i', $fim);
            if ($dt) $fim = $dt->format('Y-m-d H:i:s');
        }

        return strtotime($fim) >= strtotime($inicio);
    }
}
