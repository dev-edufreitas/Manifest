<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

session_start();
require 'vendor/autoload.php';

// Se não houver dados para processar, retornar erro
if (!isset($_SESSION['processing_data'])) {
    echo json_encode([
        'error' => 'No data to process',
        'completed' => true,
        'total' => 0,
        'sent' => 0,
        'failed' => 0
    ]);
    exit;
}

// Inicializar ou recuperar o estado do processamento
if (!isset($_SESSION['processing_state'])) {
    // Carregar os e-mails da planilha
    try {
        $spreadsheet = IOFactory::load('emails.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $emails = [];
   

        foreach ($sheet->getRowIterator() as $row) {
            $cell = $sheet->getCell('C' . $row->getRowIndex());
            if (filter_var($cell->getValue(), FILTER_VALIDATE_EMAIL)) {
                $emails[] = $cell->getValue();
            }
        }
        // Limitar a 10 e-mails em ambiente de desenvolvimento (remova esta linha em produção)
        // $emails = array_slice($emails, 0, 10);

        // Inicializar o estado do processamento
        $_SESSION['processing_state'] = [
            'emails' => $emails,
            'total' => count($emails),
            'current_index' => 0,
            'sent' => 0,
            'failed' => 0,
            'completed' => false,
            'batch_size' => 5 // Número de e-mails a processar por requisição
        ];
    } catch (Exception $e) {
        echo json_encode([
            'error' => 'Error loading spreadsheet: ' . $e->getMessage(),
            'completed' => true,
            'total' => 0,
            'sent' => 0,
            'failed' => 0
        ]);
        exit;
    }
}

// Estado atual do processamento
$state = &$_SESSION['processing_state'];
$data = $_SESSION['processing_data'];

// Se já completou, apenas retornar o estado atual
if ($state['completed']) {
    echo json_encode([
        'completed' => true,
        'total' => $state['total'],
        'sent' => $state['sent'],
        'failed' => $state['failed']
    ]);
    exit;
}

// Dados do formulário
$nome = $data['nome'];
$email = $data['email'];
$pais = $data['pais'];

// Carrega template em italiano e substitui placeholders
$mensagem_it = file_get_contents('mensagem_it.html');
$mensagem_it = str_replace(
    ['[[Nome]]', '[[Email]]', '[[nacionalidade]]', '[[Data]]'],
    [$nome, $email, strtolower($pais), date('d/m/Y')],
    $mensagem_it
);

// Assunto FIXO em italiano
$subject = 'Manifestazione collettiva contro il Decreto-Legge Tajani';

// Criar cliente Guzzle para acessar a API Resend
$client = new Client([
    'base_uri' => 'https://api.resend.com',
    'headers' => [
        'Authorization' => 'Bearer re_C2jhWZJq_wFkULFnwBwah4q9CaaQRFe5w', // Substitua com sua chave API
        'Content-Type' => 'application/json'
    ]
]);

// Processar o próximo lote de e-mails
$batch_end = min($state['current_index'] + $state['batch_size'], $state['total']);


$batchEmails = array_slice($state['emails'], $state['current_index'], $state['batch_size']);

$to = array_shift($batchEmails); // pega o primeiro como "to"
$bcc = $batchEmails; // o resto como bcc

try {
    $emailData = [
        'from' => 'Manifestação Cidadania <contato@siamoitaliani.org>',
        'reply_to' => $email,
        'to' => $to,
        'bcc' => $bcc,
        'subject' => $subject,
        'html' => $mensagem_it
    ];

    $response = $client->post('/emails', [
        'json' => $emailData
    ]);

    $statusCode = $response->getStatusCode();
    $responseData = json_decode($response->getBody()->getContents());

    if ($statusCode == 200 && isset($responseData->id)) {
        $state['sent'] += count($bcc) + 1;
    } else {
        $state['failed'] += count($bcc) + 1;
    }
} catch (RequestException $e) {
    $state['failed'] += count($bcc) + 1;
} catch (Exception $e) {
    $state['failed'] += count($bcc) + 1;
}

// Pequena pausa para não sobrecarregar a API
usleep(300000); // 100ms


// Verificar se completou
if ($state['current_index'] >= $state['total']) {
    $state['completed'] = true;
}

// Retornar o estado atual
echo json_encode([
    'completed' => $state['completed'],
    'total' => $state['total'],
    'sent' => $state['sent'],
    'failed' => $state['failed'],
    'current_index' => $state['current_index']
]);