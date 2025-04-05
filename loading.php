<?php
// Se não existir uma sessão, redirecionar para a página inicial
session_start();
if (!isset($_SESSION['processing_data'])) {
    header("Location: index.php");
    exit();
}

// Recuperar dados da sessão
$nome = $_SESSION['processing_data']['nome'];
$email = $_SESSION['processing_data']['email'];
$pais = $_SESSION['processing_data']['pais'];
$language = $_SESSION['processing_data']['language'];

// Textos multilíngues
$texts = [
    'pt' => [
        'title' => 'Enviando manifestação',
        'heading' => 'Enviando sua manifestação',
        'subheading' => 'Por favor, aguarde enquanto enviamos sua mensagem aos parlamentares italianos.',
        'progress' => 'Progresso:',
        'emails_sent' => 'E-mails enviados:',
        'wait' => 'Por favor, não feche esta página...',
        'success' => 'Envio concluído com sucesso!',
        'back' => 'Voltar para a página inicial',
        'thank_you' => 'Obrigado por participar desta manifestação!',
        'share' => 'Compartilhe esta iniciativa com seus amigos e familiares.',
        'donation_title' => 'Apoie nossa iniciativa independente',
        'donation_text' => 'Somos uma organização independente e todo dinheiro arrecadado será destinado à luta contra o Decreto-Lei Tajani. Sua contribuição nos ajudará a ampliar nossas ações.',
        'donate_button' => 'Contribuir via PayPal',


    ],
    'en' => [
        'title' => 'Sending manifesto',
        'heading' => 'Sending your manifesto',
        'subheading' => 'Please wait while we send your message to Italian parliamentarians.',
        'progress' => 'Progress:',
        'emails_sent' => 'Emails sent:',
        'wait' => 'Please do not close this page...',
        'success' => 'Sending completed successfully!',
        'back' => 'Back to homepage',
        'thank_you' => 'Thank you for participating in this manifesto!',
        'share' => 'Share this initiative with your friends and family.',
        'donation_title' => 'Support our independent initiative',
        'donation_text' => 'We are an independent organization and all money raised will be used to fight against the Tajani Decree-Law. Your contribution will help us expand our actions.',
        'donate_button' => 'Donate via PayPal',
    ],
    'it' => [
        'title' => 'Invio della manifestazione',
        'heading' => 'Invio della tua manifestazione',
        'subheading' => 'Attendere mentre inviamo il tuo messaggio ai parlamentari italiani.',
        'progress' => 'Progresso:',
        'emails_sent' => 'Email inviate:',
        'wait' => 'Per favore, non chiudere questa pagina...',
        'success' => 'Invio completato con successo!',
        'back' => 'Torna alla pagina iniziale',
        'thank_you' => 'Grazie per aver partecipato a questa manifestazione!',
        'share' => 'Condividi questa iniziativa con i tuoi amici e familiari.',
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

        .loading-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .progress {
            height: 25px;
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
            font-size: 60px;
            margin-bottom: 20px;
        }

        .hidden {
            display: none;
        }

        .pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .social-icons a {
            font-size: 24px;
            margin: 0 10px;
            color: #555;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #CD212A;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="loading-container text-center">
            <div class="italian-flag"></div>

            <!-- Ícone de carregamento -->
            <div id="loading-icon" class="status-icon text-danger pulse">
                <i class="fas fa-paper-plane"></i>
            </div>

            <!-- Ícone de sucesso (inicialmente escondido) -->
            <div id="success-icon" class="status-icon text-success hidden">
                <i class="fas fa-check-circle"></i>
            </div>

            <h2><?php echo $t['heading']; ?></h2>
            <p class="mb-4"><?php echo $t['subheading']; ?></p>

            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span><?php echo $t['progress']; ?></span>
                    <span id="progress-percentage">0%</span>
                </div>
                <div class="progress mb-3">
                    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 0%"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <span><?php echo $t['emails_sent']; ?></span>
                    <span id="emails-counter">0/0</span>
                </div>
            </div>

            <p id="waiting-message" class="text-muted">
                <i class="fas fa-spinner fa-spin me-2"></i>
                <?php echo $t['wait']; ?>
            </p>

            <!-- Seção de sucesso (inicialmente escondida) -->
            <div id="success-section" class="hidden mt-4">
                <div class="alert alert-success">
                    <h4><?php echo $t['success']; ?></h4>
                    <p><?php echo $t['thank_you']; ?></p>
                    <p><?php echo $t['share']; ?></p>
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
                <a href="index.php" class="btn btn-danger"><?php echo $t['back']; ?></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Iniciar o processo de envio
            fetchProgress();

            // Verificar o progresso a cada 2 segundos
            const progressInterval = setInterval(fetchProgress, 2000);

            function fetchProgress() {
                fetch('process_emails.php')
                    .then(response => response.json())
                    .then(data => {
                        updateProgress(data);

                        // Se o processo estiver completo, parar de verificar
                        if (data.completed) {
                            clearInterval(progressInterval);
                            showCompletionMessage(data);
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar progresso:', error);
                    });
            }

            function updateProgress(data) {
                const totalEmails = data.total;
                const sentEmails = data.sent;
                const percentage = Math.round((sentEmails / totalEmails) * 100) || 0;

                document.getElementById('progress-bar').style.width = percentage + '%';
                document.getElementById('progress-percentage').textContent = percentage + '%';
                document.getElementById('emails-counter').textContent = sentEmails + '/' + totalEmails;
            }

            function showCompletionMessage(data) {
                // Esconder ícone de carregamento e mensagem de espera
                document.getElementById('loading-icon').classList.add('hidden');
                document.getElementById('waiting-message').classList.add('hidden');

                // Mostrar ícone de sucesso e seção de sucesso
                document.getElementById('success-icon').classList.remove('hidden');
                document.getElementById('success-section').classList.remove('hidden');

                // Adicionar classe de sucesso à barra de progresso
                document.getElementById('progress-bar').classList.remove('progress-bar-animated');
                document.getElementById('progress-bar').classList.remove('bg-danger');
                document.getElementById('progress-bar').classList.add('bg-success');
            }
        });
    </script>
</body>

</html>