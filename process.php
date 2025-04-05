<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

    // Configuração do PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'siamo.italiani.it.manifest@gmail.com'; // Nome de usuário SMTP 
        $mail->Password = 'brployiwrdzrcgmp'; // Senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Remetente
        $mail->setFrom($email, $nome);
        $mail->addReplyTo($email, $nome);

        // Assunto FIXO em italiano
        $mail->Subject = 'Manifestazione collettiva contro il Decreto-Legge Tajani';

        // Carrega template em italiano e substitui placeholders
        $mensagem_it = file_get_contents('mensagem_it.html');
        $mensagem_it = str_replace(
            ['[[Nome]]', '[[Email]]', '[[nacionalidade]]', '[[Data]]'],
            [$nome, $email, strtolower($pais), date('d/m/Y')],
            $mensagem_it
        );
        
        $mail->isHTML(true);
        $mail->Body = $mensagem_it;
        $mail->AltBody = strip_tags($mensagem_it);

        // Envia para todos os e-mails da lista
        foreach ($emails as $destinatario) {
            try {
                $mail->clearAddresses();
                $mail->addAddress($destinatario);
                $mail->send();
                echo "E-mail enviado para: $destinatario<br>";
            } catch (Exception $e) {
                echo "Falha no envio para $destinatario: " . $mail->ErrorInfo . "<br>";
            }
        }

        echo "<h3>Todos os e-mails foram processados!</h3>";

    } catch (Exception $e) {
        die("Erro no envio: {$mail->ErrorInfo}");
    }
} else {
    header("Location: index.php");
    exit();
}
?>