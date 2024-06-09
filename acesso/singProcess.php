<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>

    <link href="src/output.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .error-message {
            background-color: #fde2e2;
            border: 1px solid #f37171;
            color: #c53030;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .success-message {
            background-color: #d1fae5;
            border: 1px solid #34d399;
            color: #065f46;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    include '../connection/conexao.php';

    // Função para validar a senha
    function validarSenha($senha) {
        // Verifica se a senha possui pelo menos 8 caracteres
        return strlen($senha) >= 8;
    }

    // Verificação de e-mail único
    function verificarEmailUnico($email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id_cliente FROM cliente WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->rowCount();
        return $count === 0;
    }

    // Verificação de número de contribuinte único
    function verificarContribuinteUnico($numero_contribuinte) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id_cliente FROM cliente WHERE numero_contribuinte = ?");
        $stmt->execute([$numero_contribuinte]);
        $count = $stmt->rowCount();
        return $count === 0;
    }

    // ...

    // Preparando os dados do formulário para inserção no banco de dados
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $telefone = $_POST['telefone'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validando o formato do e-mail
    $endereco = $_POST['endereco'];
    $numero_contribuinte = $_POST['numero_contribuinte'];
    $genero = $_POST['genero'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografando a senha

    // Variáveis para controle de erros
    $errors = [];

    // Validando a entrada
    if (
        !validarSenha($_POST['senha'])
    ) {
        $errors[] = "A senha deve ter pelo menos 8 caracteres.";
    }

    if (!$email) {
        $errors[] = "Por favor, insira um endereço de e-mail válido.";
    }

    if (empty($firstName) || empty($lastName) || empty($telefone) || empty($endereco) || empty($numero_contribuinte) || empty($genero)) {
        $errors[] = "Por favor, preencha todos os campos corretamente.";
    }

    // Verificando se o e-mail já está em uso
    if (!verificarEmailUnico($email)) {
        $errors[] = "O e-mail fornecido já está em uso.";
    }

    // Validando o número de contribuinte
    if (!preg_match('/^\d{10}[A-Z]{2}\d{3}$/', $numero_contribuinte)) {
        $errors[] = "O número de contribuinte é inválido. Deve ter 10 dígitos seguidos por 2 letras maiúsculas e mais 3 dígitos.";
    }

    // Verificando se o número de contribuinte já está em uso
    if (!verificarContribuinteUnico($numero_contribuinte)) {
        $errors[] = "O número de contribuinte fornecido já está em uso.";
    }

    // Se houver erros, exibir alerta de erro
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='error-message'>$error</div>";
        }
        exit();
    }

    // Preparando a consulta SQL para inserção de dados
    $sql = "INSERT INTO cliente (firstName, lastName, telefone, email, endereco, numero_contribuinte, genero, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparando a declaração
    $stmt = $pdo->prepare($sql);

    // Executando a declaração com os valores vinculados diretamente na execução
    if ($stmt->execute([$firstName, $lastName, $telefone, $email, $endereco, $numero_contribuinte, $genero, $senha])) {
        // Se a inserção for bem-sucedida, exibir uma mensagem de sucesso
        echo "<div class='success-message'>Cadastro realizado com sucesso!</div>";
        header("Location: login.html");
    } else {
        // Se houver algum erro durante a inserção, exibir uma mensagem de erro
        echo "<div class='error-message'>Ocorreu um erro ao cadastrar: " . $pdo->errorInfo()[2] . "</div>";
    }

    // Fechando a conexão
    $pdo = null;
    ?>

</div>
</body>
</html>
