<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_remetente = $_POST['email'];
    $nome_remetente = $_POST['nome'];

    // Carrega a planilha de e-mails
    $arquivoExcel = 'emails.xlsx';
    $spreadsheet  = IOFactory::load($arquivoExcel);
    $sheet        = $spreadsheet->getActiveSheet();
    
    // Obtém os e-mails da coluna correta
    $emails = [];
    foreach ($sheet->getColumnIterator('A') as $column) {
        foreach ($column->getCellIterator() as $cell) {
            $email = $cell->getValue();
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emails[] = $email;
            }
        }
    }

    if (empty($emails)) {
        die("Nenhum e-mail válido encontrado na planilha.");
    }

    // Configuração do e-mail
    $assunto = "Mensagem Automática";
    $mensagem = "Olá, este é um e-mail enviado automaticamente.";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.seudominio.com'; // Configure seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = $email_remetente;
        $mail->Password = 'senha_do_email'; // Pode ser um app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body = $mensagem;

        foreach ($emails as $email_destino) {
            $mail->clearAddresses();
            $mail->setFrom($email_remetente, $nome_remetente);
            $mail->addAddress($email_destino);
            var_dump($email_destino);
        //     if (!$mail->send()) {
        //         echo "Erro ao enviar para $email_destino: " . $mail->ErrorInfo . "<br>";
        //     } else {
        //         echo "E-mail enviado para $email_destino!<br>";
        //     }
        }
    } catch (Exception $e) {
        echo "Erro ao enviar e-mails: {$mail->ErrorInfo}";
    }
}
?>
