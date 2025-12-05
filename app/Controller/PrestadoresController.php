<?php
App::uses('AppController', 'Controller');

// ===============================================
// ### INÍCIO DA ATUALIZAÇÃO (1/2) ###
// Adicionamos a importação da biblioteca PHPExcel.
// Esta é a forma correta do CakePHP 2 "encontrar" a biblioteca na pasta Vendor.
// ===============================================
App::import('Vendor', 'PHPExcel/Classes/PHPExcel');

class PrestadoresController extends AppController
{
    public $components = array('Paginator', 'Flash');

    public function index()
    {
        $this->Paginator->settings = array(
            'contain' => array('Servico'),
            'limit' => 10
        );

        $conditions = array();
        
        if (!empty($this->request->query['search'])) {
            $searchTerm = '%' . $this->request->query['search'] . '%';
            $conditions['OR'] = array(
                'Prestador.nome LIKE' => $searchTerm,
                'Prestador.email LIKE' => $searchTerm,
                'Servico.nome LIKE' => $searchTerm,
            );
            $this->set('searchTerm', $this->request->query['search']);
            $this->request->params['named']['search'] = $this->request->query['search'];
        }

        $prestadores = $this->Paginator->paginate($conditions);
        
        $coresAvatar = array('#8B5CF6', '#EC4899', '#10B981', '#F59E0B', '#3B82F6', '#EF4444');
        foreach ($prestadores as $key => $prestador) {
            $nome = explode(' ', $prestador['Prestador']['nome']);
            $iniciais = strtoupper(substr($nome[0], 0, 1) . (count($nome) > 1 ? substr(end($nome), 0, 1) : ''));
            $corIndex = $prestador['Prestador']['id'] % count($coresAvatar);
            $prestadores[$key]['Prestador']['iniciais'] = $iniciais;
            $prestadores[$key]['Prestador']['avatar_color'] = $coresAvatar[$corIndex];

            if (!empty($prestador['Prestador']['foto'])) {
                $prestadores[$key]['Prestador']['foto_url'] = Router::url('/img/uploads/prestadores/' . $prestador['Prestador']['foto'], true);
            } else {
                $prestadores[$key]['Prestador']['foto_url'] = null;
            }
        }
        $this->set('prestadores', $prestadores);
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->request->data = $this->_handleFileUpload($this->request->data);
            if (isset($this->request->data['Prestador']['valor_servico'])) {
                $this->request->data['Prestador']['valor_servico'] = str_replace(',', '.', $this->request->data['Prestador']['valor_servico']);
            }
            $this->Prestador->create();
            if ($this->Prestador->save($this->request->data)) {
                $this->Flash->success(__('O prestador foi salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('O prestador não pôde ser salvo. Por favor, tente novamente.'));
            }
        }
        $servicos = $this->Prestador->Servico->find('list');
        $this->set(compact('servicos'));
    }

    public function edit($id = null)
    {
        if (!$this->Prestador->exists($id)) {
            throw new NotFoundException(__('Prestador inválido'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data = $this->_handleFileUpload($this->request->data);
            if (isset($this->request->data['Prestador']['valor_servico'])) {
                $this->request->data['Prestador']['valor_servico'] = str_replace(',', '.', $this->request->data['Prestador']['valor_servico']);
            }
            if ($this->Prestador->save($this->request->data)) {
                $this->Flash->success(__('O prestador foi salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('O prestador não pôde ser salvo. Por favor, tente novamente.'));
            }
        } else {
            $this->request->data = $this->Prestador->findById($id);
            if (!empty($this->request->data['Prestador']['valor_servico'])) {
                $this->request->data['Prestador']['valor_servico'] = number_format($this->request->data['Prestador']['valor_servico'], 2, ',', '');
            }
            if (!empty($this->request->data['Prestador']['foto'])) {
                $this->request->data['Prestador']['foto_url'] = Router::url('/img/uploads/prestadores/' . $this->request->data['Prestador']['foto'], true);
            }
        }
        $servicos = $this->Prestador->Servico->find('list');
        $this->set(compact('servicos'));
    }

    public function delete($id = null)
    {
        if (!$this->Prestador->exists($id)) {
            throw new NotFoundException(__('Prestador inválido'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Prestador->delete($id)) {
            $this->Flash->success(__('O prestador foi excluído.'));
        } else {
            $this->Flash->error(__('O prestador não pôde ser excluído. Por favor, tente novamente.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    // ===============================================
    // ### INÍCIO DA ATUALIZAÇÃO (2/2) ###
    // A nova action para processar o arquivo XLS
    // ===============================================
    public function importar_xls() {
        $this->autoRender = false;
        $this->response->type('json');

        // 1. Validação inicial do arquivo
        if (empty($this->request->data['Prestador']['arquivo']['tmp_name']) || $this->request->data['Prestador']['arquivo']['error'] !== UPLOAD_ERR_OK) {
            $this->response->statusCode(400);
            return json_encode(['success' => false, 'message' => 'Nenhum arquivo enviado ou erro no upload.']);
        }

        $caminhoArquivo = $this->request->data['Prestador']['arquivo']['tmp_name'];

        try {
            // 2. Carregar o arquivo XLS/XLSX com PHPExcel
            $objPHPExcel = PHPExcel_IOFactory::load($caminhoArquivo);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            
            // 3. Processar os dados da planilha
            array_shift($sheetData); // Remove a linha do cabeçalho
            $dadosParaSalvar = array();
            $this->loadModel('Servico'); // Carrega o model de Serviço para consulta

            foreach ($sheetData as $linha) {
                $nomePrestador = trim($linha['A']);
                if (empty($nomePrestador)) continue; // Pula linhas vazias

                // Lógica para encontrar ou criar o serviço na hora
                $nomeServico = trim($linha['D']);
                $servico_id = null;
                if (!empty($nomeServico)) {
                    $servico = $this->Servico->findByName($nomeServico);
                    if ($servico) {
                        $servico_id = $servico['Servico']['id'];
                    } else {
                        $this->Servico->create();
                        $this->Servico->save(['nome' => $nomeServico]);
                        $servico_id = $this->Servico->id;
                    }
                }

                // 4. Preparar o array para salvar no banco
                $dadosParaSalvar[] = [
                    'nome' => $nomePrestador,
                    'email' => trim($linha['B']),
                    'telefone' => trim($linha['C']),
                    'servico_id' => $servico_id,
                    'valor_servico' => str_replace(',', '.', trim($linha['E'])), // Converte vírgula para ponto
                ];
            }

            // 5. Tentar salvar todos os registros de uma vez (muito mais rápido)
            if ($this->Prestador->saveAll($dadosParaSalvar, ['validate' => true, 'atomic' => true])) {
                $this->response->body(json_encode(['success' => true, 'message' => count($dadosParaSalvar) . ' prestadores importados com sucesso!']));
            } else {
                $this->response->statusCode(400);
                $this->response->body(json_encode(['success' => false, 'message' => 'Ocorreram erros de validação ao salvar os dados. Verifique o arquivo.']));
            }

        } catch (Exception $e) {
            $this->response->statusCode(500);
            $this->response->body(json_encode(['success' => false, 'message' => 'Erro ao ler o arquivo: ' . $e->getMessage()]));
        }

        return $this->response;
    }
    // ===============================================
    // ### FIM DA ATUALIZAÇÃO ###
    // ===============================================


    private function _handleFileUpload($data)
    {
        // ... (esta função permanece exatamente a mesma) ...
        if (isset($data['Prestador']['foto']['error']) && $data['Prestador']['foto']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = APP . 'webroot' . DS . 'img' . DS . 'uploads' . DS . 'prestadores' . DS;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }
            $filename = uniqid() . '-' . basename($data['Prestador']['foto']['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($data['Prestador']['foto']['tmp_name'], $targetPath)) {
                $data['Prestador']['foto'] = $filename;
            } else {
                $data['Prestador']['foto'] = null;
            }
        } else {
            unset($data['Prestador']['foto']);
        }
        return $data;
    }
}