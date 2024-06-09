<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar Carro</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
        /* CSS para animações do modal */
        .modal-backdrop {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-panel {
            opacity: 0;
            transform: translateY(4rem);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .modal-open .modal-backdrop {
            opacity: 1;
        }

        .modal-open .modal-panel {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto">
    <h2 class="text-2xl font-bold text-center mb-6">Comprar Carro</h2>

    <div id="alert-container" class="hidden mb-4"></div>

    <form id="purchase-form" action="processar_compra.php" method="post" enctype="multipart/form-data">
        <!-- Adiciona um campo hidden para armazenar o ID do carro -->
        <input type="hidden" name="id_carro" value="<?php echo $_GET['id_carro']; ?>">
        <!-- Campo para upload do comprovativo -->
        <div class="mb-4">
            <label for="comprovativo_pagamento" class="block text-gray-700">Comprovativo de Pagamento:</label>
            <input type="file" name="comprovativo_pagamento" id="comprovativo_pagamento" accept=".pdf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
        </div>
        <div class="text-center">
            <input type="submit" value="Enviar Comprovativo" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        </div>
    </form>
</div>

<!-- Modal de sucesso -->
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 modal-backdrop" id="success-modal" style="display: none;">
    <div class="bg-white p-6 rounded-lg shadow-lg modal-panel">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>
        <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Pagamento bem-sucedido</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">Sua compra foi realizada com sucesso.</p>
            </div>
        </div>
        <div class="mt-5 sm:mt-6">
            <button id="modal-close-btn" type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Voltar para o dashboard</button>
        </div>
    </div>
</div>

<script>
    // Função para mostrar o modal
    function showModal() {
        const modal = document.getElementById('success-modal');
        modal.style.display = 'flex';
        document.body.classList.add('modal-open');
    }

    // Função para ocultar o modal
    function hideModal() {
        const modal = document.getElementById('success-modal');
        modal.style.display = 'none';
        document.body.classList.remove('modal-open');
    }

    // Event listener para o botão de fechar o modal
    const modalCloseBtn = document.getElementById('modal-close-btn');
    modalCloseBtn.addEventListener('click', hideModal);

    // Função para exibir alerta
    function showAlert(message, type) {
        const alertContainer = document.getElementById('alert-container');
        alertContainer.innerHTML = `
            <div class="rounded-md bg-${type}-100 p-4">
                <div class="flex justify-between items-center">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            ${type === 'green' ? 
                                '<svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>' : 
                                '<svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>'
                            }
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-${type}-800">${message}</p>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="inline-flex rounded-md bg-transparent text-${type}-500 hover:text-${type}-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-${type}-600" onclick="hideAlert()">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;
        alertContainer.classList.remove('hidden');
    }

    // Função para ocultar alerta
    function hideAlert() {
        const alertContainer = document.getElementById('alert-container');
        alertContainer.classList.add('hidden');
    }

    // Adiciona um event listener para o submit do formulário
    document.getElementById('purchase-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Previne o envio do formulário padrão
        // Faz o envio do formulário via AJAX
        const formData = new FormData(this);
        fetch('processar_compra.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Verifica se a resposta indica uma compra bem-sucedida
            if (data === 'Compra realizada com sucesso!') {
                showAlert('Sua compra foi realizada com sucesso.', 'green');
                showModal(); // Exibe o modal de sucesso
            } else {
                showAlert(data, 'red'); // Exibe qualquer mensagem de erro retornada pelo PHP
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showAlert('Ocorreu um erro ao processar a compra.', 'red');
        });
    });
</script>

</body>
</html>
