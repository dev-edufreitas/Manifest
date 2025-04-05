<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dados do formulário
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pais = htmlspecialchars($_POST['pais'], ENT_QUOTES, 'UTF-8');
    
    // Carrega os e-mails da planilha
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

    } catch (Exception $e) {
        die("Erro ao carregar a planilha: " . $e->getMessage());
    }

    if (empty($emails)) {
        die("Nenhum e-mail válido encontrado na planilha.");
    }

    // Criar cliente Guzzle para acessar a API Resend
    $client = new Client([
        'base_uri' => 'https://api.resend.com',
        'headers' => [
            'Authorization' => 'Bearer re_C2jhWZJq_wFkULFnwBwah4q9CaaQRFe5w', // Substitua com sua chave API do Resend
            'Content-Type' => 'application/json'
        ]
    ]);

    // Carrega template em italiano e substitui placeholders
    $mensagem_it = file_get_contents('mensagem_it.html');
    $mensagem_it = str_replace(
        ['[[Nome]]', '[[Email]]', '[[nacionalidade]]', '[[Data]]'],
        [$nome, $email, strtolower($pais), date('d/m/Y')],
        $mensagem_it
    );

    // Assunto FIXO em italiano
    $subject = 'Manifestazione collettiva contro il Decreto-Legge Tajani';
    
    // Envia para todos os e-mails da lista
    $successCount = 0;
    $failCount = 0;
    
    foreach ($emails as $destinatario) {
        try {
            $emailData = [
                'from' => 'Manifestação Cidadania <onboarding@resend.dev>', // Para testes iniciais
                'reply_to' => $email,
                'to' => $destinatario,
                'subject' => $subject,
                'html' => $mensagem_it
            ];
            
            $response = $client->post('/emails', [
                'json' => $emailData
            ]);
            
            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody()->getContents());
            
            if ($statusCode == 200 && isset($responseData->id)) {
                echo "E-mail enviado para: $destinatario (ID: {$responseData->id})<br>";
                $successCount++;
            } else {
                echo "Falha no envio para $destinatario: código de status $statusCode<br>";
                $failCount++;
            }
        } catch (RequestException $e) {
            $errorMessage = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : $e->getMessage();
            echo "Falha no envio para $destinatario: " . $errorMessage . "<br>";
            $failCount++;
        } catch (Exception $e) {
            echo "Erro no envio para $destinatario: " . $e->getMessage() . "<br>";
            $failCount++;
        }
    }

    echo "<h3>Processamento concluído!</h3>";
    echo "<p>E-mails enviados com sucesso: $successCount</p>";
    echo "<p>Falhas no envio: $failCount</p>";
    
    if ($failCount > 0) {
        echo "<p>Verifique as mensagens de erro acima para mais detalhes.</p>";
    }

} else {
    header("Location: index.php");
    exit();
}