$(document).ready(function() {
    
    // ==================================================================
    // LÓGICA PARA UPLOAD DE FOTO (CLIQUE E DRAG & DROP)
    // ==================================================================

    // Faz com que clicar na "caixa" de upload ative o input de arquivo escondido
    $('#uploadBox').click(function() {
        $('#fileInput').click();
    });

    // Quando um arquivo é selecionado pelo input, mostra o preview
    $('#fileInput').change(function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Cria uma tag de imagem e a coloca dentro da área de preview
                $('#avatarPreview').html('<img src="' + event.target.result + '" alt="Avatar">');
            };
            reader.readAsDataURL(file);
        }
    });

    // Efeitos visuais para o "arrastar e soltar"
    const uploadBox = $('#uploadBox');
    uploadBox.on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        uploadBox.css('border-color', '#3b82f6'); // Destaca a borda
    });

    uploadBox.on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        uploadBox.css('border-color', '#ddd'); // Restaura a borda
    });

    // Lógica principal do "arrastar e soltar"
    uploadBox.on('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        uploadBox.css('border-color', '#ddd');
        
        // Pega os arquivos que foram soltos na caixa
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            // Define o arquivo solto como o valor do nosso input escondido
            $('#fileInput').prop('files', files);
            // Dispara o evento 'change' manualmente para reusar a lógica de preview
            $('#fileInput').change(); 
        }
    });

    // ==================================================================
    // MÁSCARA PARA O CAMPO DE TELEFONE (OPCIONAL, MAS ÚTIL)
    // ==================================================================
    
    // Este é um exemplo simples de máscara de telefone
    $('#phoneNumber').on('input', function() {
        let value = $(this).val().replace(/\D/g, ''); // Remove tudo que não for dígito
        value = value.replace(/^(\d{2})(\d)/g, '($1) $2'); // Coloca parênteses nos dois primeiros dígitos
        value = value.replace(/(\d{5})(\d)/, '$1-$2'); // Coloca o hífen depois do quinto dígito (para celulares)
        $(this).val(value.substring(0, 15)); // Limita o tamanho
    });

});