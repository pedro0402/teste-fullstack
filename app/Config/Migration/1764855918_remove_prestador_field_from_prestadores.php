<?php
class RemovePrestadorFieldFromPrestadores extends CakeMigration {

    public $description = 'Remove a coluna "Prestador" que foi criada por engano na tabela prestadores.';

    public $migration = array(
        'up' => array(
            'drop_field' => array(
                'prestadores' => array('Prestador'),
            ),
        ),
        'down' => array(
            'create_field' => array(
                'prestadores' => array(
                    'Prestador' => array('type' => 'string', 'null' => false), // Recria se precisarmos reverter
                ),
            ),
        ),
    );
}