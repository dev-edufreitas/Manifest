<?php
session_start();

// Se não existir dados de processamento ou estado, redirecionar para a página inicial
if (!isset($_SESSION['processing_data']) || !isset($_SESSION['processing_state']) || !$_SESSION['processing_state']['completed']) {
    header("Location: index.php");
    exit();
}

// Recuperar dados
$data = $_SESSION['processing_data'];
$state = $_SESSION['processing_state'];
$language = $data['language'];

// Textos multilíngues
$texts = [
    'pt' => [
        'title' => 'Manifestação enviada',
        'heading' => 'Manifestação enviada com sucesso!',
        'subheading' => 'Sua mensagem foi enviada aos parlamentares italianos.',
        'summary' => 'Resumo',
        'total' => 'Total de destinatários:',
        'sent' => 'E-mails enviados com sucesso:',
        'failed' => 'Falhas no envio:',
        'thank_you' => 'Obrigado por participar desta manifestação!',
        'share' => 'Compartilhe esta iniciativa com seus amigos e familiares:',
        'back' => 'Voltar para a página inicial',
        'donation_title' => 'Apoie nossa iniciativa independente',
        'donation_text' => 'Somos uma organização independente e todo dinheiro arrecadado será destinado à luta contra o Decreto-Lei Tajani. Sua contribuição nos ajudará a ampliar nossas ações.',
        'donate_button' => 'Contribuir via PayPal',

    ],
    'en' => [
        'title' => 'Manifesto sent',
        'heading' => 'Manifesto sent successfully!',
        'subheading' => 'Your message has been sent to Italian parliamentarians.',
        'summary' => 'Summary',
        'total' => 'Total recipients:',
        'sent' => 'Emails sent successfully:',
        'failed' => 'Failed deliveries:',
        'thank_you' => 'Thank you for participating in this manifesto!',
        'share' => 'Share this initiative with your friends and family:',
        'back' => 'Back to homepage',
        'donation_title' => 'Support our independent initiative',
        'donation_text' => 'We are an independent organization and all money raised will be used to fight against the Tajani Decree-Law. Your contribution will help us expand our actions.',
        'donate_button' => 'Donate via PayPal',
    ],
    'it' => [
        'title' => 'Manifestazione inviata',
        'heading' => 'Manifestazione inviata con successo!',
        'subheading' => 'Il tuo messaggio è stato inviato ai parlamentari italiani.',
        'summary' => 'Riepilogo',
        'total' => 'Destinatari totali:',
        'sent' => 'Email inviate con successo:',
        'failed' => 'Invii falliti:',
        'thank_you' => 'Grazie per aver partecipato a questa manifestazione!',
        'share' => 'Condividi questa iniziativa con i tuoi amici e familiari:',
        'back' => 'Torna alla pagina iniziale',
        'donation_title' => 'Sostieni la nostra iniziativa indipendente',
        'donation_text' => 'Siamo un\'organizzazione indipendente e tutto il denaro raccolto sarà destinato alla lotta contro il Decreto-Legge Tajani. Il tuo contributo ci aiuterà ad ampliare le nostre azioni.',
        'donate_button' => 'Contribuisci tramite PayPal',
    ]
];

// Garantir que a linguagem seja válida
if (!isset($texts[$language])) {
    $language = 'pt'; // Padrão para português
}

$t = $texts[$language];

// Limpar a sessão quando o usuário sai da página (opcional)
// Deixe isso comentado se preferir manter o resumo disponível mesmo após o usuário navegar para outra página
// session_unset();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="<?php echo $language; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $t['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .success-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .italian-flag {
            background: linear-gradient(to right,
                    #008C45 0%, #008C45 33%,
                    #F4F9FF 33%, #F4F9FF 66%,
                    #CD212A 66%, #CD212A 100%);
            height: 10px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .status-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }

        .summary-box {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .social-icons a {
            font-size: 30px;
            margin: 0 15px;
            color: #555;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #CD212A;
        }

        .email-stat {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="success-container text-center">
            <div class="italian-flag"></div>

            <div class="status-icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <h1 class="mb-3"><?php echo $t['heading']; ?></h1>
            <p class="lead mb-4"><?php echo $t['subheading']; ?></p>

            <div class="summary-box">
                <h4 class="mb-3"><?php echo $t['summary']; ?></h4>
                <div class="email-stat">
                    <strong><?php echo $t['total']; ?></strong> <?php echo $state['total']; ?>
                </div>
                <div class="email-stat text-success">
                    <strong><?php echo $t['sent']; ?></strong> <?php echo $state['sent']; ?>
                </div>
                <?php if ($state['failed'] > 0): ?>
                    <div class="email-stat text-danger">
                        <strong><?php echo $t['failed']; ?></strong> <?php echo $state['failed']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="donation-section my-4 p-4 bg-light rounded">
                <h5 class="mb-3"><?php echo $t['donation_title']; ?></h5>
                <p><?php echo $t['donation_text']; ?></p>

                <div class="text-center mt-3">
                    <form action="https://www.paypal.com/donate" method="post" target="_top" class="d-inline-block">
                        <input type="hidden" name="hosted_button_id" value="KAXKBMCV59VXJ" />
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fab fa-paypal me-2"></i> <?php echo $t['donate_button']; ?>
                        </button>
                        <img alt="" border="0" src="https://www.paypal.com/en_BR/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                </div>
            </div>

            <a href="index.php" class="btn btn-danger btn-lg"><?php echo $t['back']; ?></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>