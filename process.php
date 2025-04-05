<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dados do formulário
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pais = htmlspecialchars($_POST['pais'], ENT_QUOTES, 'UTF-8');
    $language = isset($_POST['language']) ? $_POST['language'] : 'pt';
    
    // Guardar dados na sessão para processamento posterior
    $_SESSION['processing_data'] = [
        'nome' => $nome,
        'email' => $email,
        'pais' => $pais,
        'language' => $language
    ];
    
    // Limpar qualquer estado de processamento anterior
    if (isset($_SESSION['processing_state'])) {
        unset($_SESSION['processing_state']);
    }
    
    // Redirecionar para a página de carregamento
    header("Location: loading.php");
    exit();
} else {
    // Se acessado diretamente, redirecionar para a página inicial
    header("Location: index.php");
    exit();
}