<?php
// Título da página que aparecerá na aba do navegador
$this->assign('title', isset($this->request->data['Prestador']['id']) ? 'Editar Prestador' : 'Cadastro de Prestador'); 

// IMPORTANTE: Precisamos de 'enctype' => 'multipart/form-data' para o upload de arquivos funcionar!
echo $this->Form->create('Prestador', array(
    'id' => 'providerForm',
    'novalidate' => true, // Desativa a validação do navegador para usarmos a nossa
    'type' => 'file' // Equivalente ao enctype
));

// ==================================================================
// ### INÍCIO DA CORREÇÃO ###
//
// Se estivermos editando (ou seja, se já existe um ID nos dados),
// este comando cria um campo de formulário escondido com o ID.
// Isso diz ao CakePHP para fazer um UPDATE em vez de um INSERT.
if (!empty($this->request->data['Prestador']['id'])) {
    echo $this->Form->hidden('id');
}
//
// ### FIM DA CORREÇÃO ###
// ==================================================================

?>

<h1><?php echo isset($this->request->data['Prestador']['id']) ? 'Editar Prestador' : 'Cadastro de Prestador de Serviço'; ?></h1>

<div class="section">
    <div class="section-title">Informações pessoais</div>
    <div class="section-subtitle">Cadastre suas informações e adicione uma foto.</div>

    <div class="form-group">
        <label class="form-label">Nome Completo</label>
        <?php 
            echo $this->Form->input('nome', array(
                'label' => false,
                'div' => false,
                'class' => 'form-control',
                'placeholder' => 'Ex: Eduardo Oliveira'
            )); 
        ?>
    </div>

    <div class="form-group">
        <label class="form-label">Email</label>
        <div class="input-icon">
            <i class="fas fa-envelope"></i>
            <?php 
                echo $this->Form->input('email', array(
                    'label' => false,
                    'div' => false,
                    'class' => 'form-control',
                    'placeholder' => 'eduardo@doity.com.br'
                )); 
            ?>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Sua foto</label>
        <div class="section-subtitle">Ela aparecerá no seu perfil.</div>
        <div class="upload-area">
            <div class="avatar-preview" id="avatarPreview">
                <!-- Se já houver uma foto, o CakePHP a mostrará aqui -->
                <?php
                    if (!empty($this->request->data['Prestador']['foto_url'])) {
                        echo $this->Html->image($this->request->data['Prestador']['foto_url'], array('alt' => 'Avatar'));
                    } else {
                        echo '<i class="fas fa-user avatar-placeholder"></i>';
                    }
                ?>
            </div>
            <div class="upload-box" id="uploadBox">
                <i class="fas fa-cloud-arrow-up"></i>
                <div class="upload-text">
                    <span>Clique para enviar</span> ou arraste e solte
                </div>
                <div class="upload-hint">PNG, JPG (max. 2MB)</div>
                <?php
                    // O input de arquivo real, que será escondido pelo CSS
                    echo $this->Form->input('foto', array(
                        'type' => 'file',
                        'label' => false,
                        'div' => false,
                        'class' => 'file-input',
                        'id' => 'fileInput'
                    ));
                ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Telefone</label>
        <?php 
            echo $this->Form->input('telefone', array(
                'label' => false,
                'div' => false,
                'class' => 'form-control',
                'placeholder' => '(81) 99999-9999',
                'id' => 'phoneNumber' // O JS vai usar este ID para a máscara
            ));
        ?>
    </div>
</div>

<div class="section">
    <div class="section-title">Serviços</div>
    <div class="section-subtitle">Quais serviços você vai prestar?</div>

    <div class="form-group">
        <?php
            // Usando o seletor de checkbox padrão do CakePHP que já estilizamos
            echo $this->Form->input('Servico', array(
                'label' => 'Selecione os serviços abaixo',
                'type' => 'select',
                'multiple' => 'checkbox',
                'options' => $servicos,
                'div' => 'form-group checkbox-group'
            ));
        ?>
    </div>
</div>

<div class="form-actions">
    <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-cancel')); ?>
    <button type="submit" class="btn btn-save">Salvar</button>
</div>

<?php echo $this->Form->end(); ?>