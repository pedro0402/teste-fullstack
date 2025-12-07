<?php
class AddFotoToPrestadores extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_foto_to_prestadores';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
        'up' => array(
            'create_field' => array(
                'prestadores' => array(
                    'foto' => array('type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'after' => 'email'),
                ),
            ),
        ),
        'down' => array(
            'drop_field' => array(
                'prestadores' => array('foto'),
            ),
        ),
    );

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
