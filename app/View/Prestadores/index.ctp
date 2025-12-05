<?php $this->assign('title', 'Prestadores de Serviço'); ?>

<div class="container">
    <div class="header">
        <div class="header-left">
            <h1>Prestadores de Serviço</h1>
            <p>Gerencie seus prestadores de serviço</p>
        </div>
        <div class="header-right">
            <?php echo $this->Html->link(
                '<i class="fas fa-plus"></i> Add novo prestador',
                array('controller' => 'prestadores', 'action' => 'add'),
                array('class' => 'btn btn-add', 'escape' => false)
            ); ?>
        </div>
    </div>

    <!-- ================================================================== -->
    <!-- ### INÍCIO DA ATUALIZAÇÃO ### -->
    <!-- A caixa de busca agora tem o ícone 'X' de limpar integrado. -->
    <!-- ================================================================== -->
    <div class="search-box">
        <?php
        echo $this->Form->create('Prestador', array('url' => array('action' => 'index'), 'type' => 'get', 'novalidate' => true));
        ?>
        <!-- Ícone da Lupa com sua própria classe -->
        <i class="fas fa-search search-icon"></i>

        <?php
        echo $this->Form->input('search', array(
            'label' => false,
            'div' => false,
            'placeholder' => 'Buscar...',
            'id' => 'searchInput',
            'value' => isset($this->request->query['search']) ? h($this->request->query['search']) : '',
            'autocomplete' => 'off'
        ));
        ?>

        <!-- Ícone 'X' com sua própria classe -->
        <?php echo $this->Html->link(
            '<i class="fas fa-times"></i>',
            array('action' => 'index'),
            array(
                'id' => 'clearSearchBtn',
                'class' => 'clear-search-btn', // A classe que vamos usar no CSS
                'escape' => false,
                'title' => 'Limpar busca'
            )
        ); ?>
        <?php echo $this->Form->end(); ?>
    </div>

    <!-- O bloco 'search-feedback' antigo foi removido. -->

    <!-- ================================================================== -->
    <!-- ### FIM DA ATUALIZAÇÃO ### -->
    <!-- ================================================================== -->

    <div class="table-wrapper">
        <table>
            <!-- O cabeçalho da sua tabela continua o mesmo -->
            <thead>
                <tr>
                    <th>Prestador</th>
                    <th>Telefone</th>
                    <th>Serviço</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- O loop e o corpo da tabela continuam os mesmos -->
                <?php foreach ($prestadores as $prestador): ?>
                    <tr>
                        <td>
                            <div class="provider-info">
                                <div class="avatar" style="background-color: <?php echo $prestador['Prestador']['avatar_color']; ?>;">
                                    <?php
                                    if (!empty($prestador['Prestador']['foto']) && file_exists(WWW_ROOT . 'img/uploads/prestadores/' . $prestador['Prestador']['foto'])) {
                                        echo $this->Html->image('uploads/prestadores/' . $prestador['Prestador']['foto'], array('alt' => 'Foto de ' . h($prestador['Prestador']['nome'])));
                                    } else {
                                        echo h($prestador['Prestador']['iniciais']);
                                    }
                                    ?>
                                </div>
                                <div class="provider-details">
                                    <span class="provider-name"><?php echo h($prestador['Prestador']['nome']); ?></span>
                                    <span class="provider-email"><?php echo h($prestador['Prestador']['email']); ?></span>
                                </div>
                            </div>
                        </td>
                        <td><?php echo h($prestador['Prestador']['telefone']); ?></td>
                        <td>
                            <?php
                            if (!empty($prestador['Servico']['nome'])) {
                                echo h($prestador['Servico']['nome']);
                            } else {
                                echo '<span class="text-muted">Nenhum</span>';
                            }
                            ?>
                        </td>
                        <td class="text-right">
                            <?php
                            if (!empty($prestador['Servico']['nome'])) {
                                echo 'R$ ' . number_format($prestador['Prestador']['valor_servico'], 2, ',', '.');
                            } else {
                                echo '<span class="text-muted">-</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <div class="actions">
                                <?php echo $this->Html->link('<i class="fas fa-pen"></i>', array('action' => 'edit', $prestador['Prestador']['id']), array('class' => 'action-btn edit', 'escape' => false, 'title' => 'Editar')); ?>
                                <?php echo $this->Form->postLink('<i class="fas fa-trash"></i>', array('action' => 'delete', $prestador['Prestador']['id']), array('class' => 'action-btn delete', 'escape' => false, 'title' => 'Excluir'), __('Deseja realmente excluir o prestador %s?', h($prestador['Prestador']['nome']))); ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <!-- A paginação continua a mesma -->
        <div class="pagination-info">
            <?php echo $this->Paginator->counter('Página {:page} de {:pages}, mostrando {:current} registros de um total de {:count}'); ?>
        </div>
        <div class="pagination-buttons">
            <?php
            echo $this->Paginator->prev('Anterior', array('tag' => 'button'), null, array('class' => 'prev disabled', 'tag' => 'button'));
            echo $this->Paginator->next('Próximo', array('tag' => 'button'), null, array('class' => 'next disabled', 'tag' => 'button'));
            ?>
        </div>
    </div>
</div>

<!-- ================================================================== -->
<!-- ### INÍCIO DA ADIÇÃO ### -->
<!-- Script para controlar a visibilidade do botão 'X'. -->
<!-- ================================================================== -->
<?php
$this->Html->scriptBlock("
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const clearBtn = document.getElementById('clearSearchBtn');

        if (!searchInput || !clearBtn) return; // Garante que os elementos existam

        function toggleClearButton() {
            if (searchInput.value.length > 0) {
                clearBtn.style.display = 'block';
            } else {
                clearBtn.style.display = 'none';
            }
        }

        // Verifica no carregamento da página
        toggleClearButton();

        // Verifica a cada vez que o usuário digita
        searchInput.addEventListener('input', toggleClearButton);
    });
", array('inline' => false));
?>
<!-- ================================================================== -->
<!-- ### FIM DA ADIÇÃO ### -->
<!-- ================================================================== -->