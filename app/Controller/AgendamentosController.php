<?php
App::uses('AppController', 'Controller');
/**
 * Agendamentos Controller
 *
 * @property Agendamento $Agendamento
 * @property PaginatorComponent $Paginator
 */
class AgendamentosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Agendamento->recursive = 0;
		$this->set('agendamentos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Agendamento->exists($id)) {
			throw new NotFoundException(__('Invalid agendamento'));
		}
		$options = array('conditions' => array('Agendamento.' . $this->Agendamento->primaryKey => $id));
		$this->set('agendamento', $this->Agendamento->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Agendamento->create();
			if ($this->Agendamento->save($this->request->data)) {
				$this->Flash->success(__('The agendamento has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The agendamento could not be saved. Please, try again.'));
			}
		}
		$prestadores = $this->Agendamento->Prestador->find('list');
		$servicos = $this->Agendamento->Servico->find('list');
		$this->set(compact('prestadores', 'servicos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Agendamento->exists($id)) {
			throw new NotFoundException(__('Invalid agendamento'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Agendamento->save($this->request->data)) {
				$this->Flash->success(__('The agendamento has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The agendamento could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Agendamento.' . $this->Agendamento->primaryKey => $id));
			$this->request->data = $this->Agendamento->find('first', $options);
		}
		$prestadores = $this->Agendamento->Prestador->find('list');
		$servicos = $this->Agendamento->Servico->find('list');
		$this->set(compact('prestadores', 'servicos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Agendamento->exists($id)) {
			throw new NotFoundException(__('Invalid agendamento'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Agendamento->delete($id)) {
			$this->Flash->success(__('The agendamento has been deleted.'));
		} else {
			$this->Flash->error(__('The agendamento could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
