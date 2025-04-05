<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifestação ao Decreto-Lei Tajani</title>
    <link rel="icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .language-selector {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
        }

        .flag-icon {
            width: 24px;
            margin-right: 5px;
        }

        .content-section {
            transition: opacity 0.3s ease;
        }

        .hidden {
            opacity: 0;
            pointer-events: none;
            height: 0;
            overflow: hidden;
        }

        /* Estilos responsivos para mobile */
        @media (max-width: 767px) {
            header.py-4 {
                padding-top: 60px !important;
            }

            .language-selector {
                top: 10px;
                right: 10px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .form-container {
                padding: 15px;
            }

            /* Ajuste para as colunas dos campos de mensagem em mobile */
            .row.mb-3 .col {
                margin-bottom: 15px;
            }

            /* Ajustar o tamanho das bandeiras */
            header .d-flex img {
                width: 40px;
            }
        }

        /* Ajuste específico para telas muito pequenas */
        @media (max-width: 575px) {
            .row.mb-3 {
                flex-direction: column;
            }

            .row.mb-3 .col {
                width: 100%;
                padding: 0;
            }

            h1 {
                font-size: 1.5rem;
            }

            .alert-heading {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Seletor de idioma -->
    <div class="language-selector dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-globe"></i> <span id="current-language">Português</span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            <li><a class="dropdown-item" href="#" data-lang="pt"><img src="https://flagcdn.com/w20/br.png" class="flag-icon" alt="Português">Português</a></li>
            <li><a class="dropdown-item" href="#" data-lang="en"><img src="https://flagcdn.com/w20/gb.png" class="flag-icon" alt="English">English</a></li>
            <li><a class="dropdown-item" href="#" data-lang="it"><img src="https://flagcdn.com/w20/it.png" class="flag-icon" alt="Italiano">Italiano</a></li>
        </ul>
    </div>

    <!-- Conteúdo em Português -->
    <div id="content-pt" class="content-section">
        <header class="py-4 bg-danger text-white text-center">
            <h1>Manifestação coletiva contra ao Decreto-Lei Tajani</h1>
            <p>28 de março de 2025</p>
            <div class="d-flex justify-content-center">
                <img src="https://flagcdn.com/w320/it.png" alt="Itália" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/br.png" alt="Brasil" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/ar.png" alt="Argentina" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/ca.png" alt="Canadá" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/us.png" alt="Estados Unidos" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/fr.png" alt="França" class="m-2" width="60">
            </div>
        </header>

        <div class="container">
            <div class="alert alert-info mt-4" role="alert">
                <h4 class="alert-heading">Manifestação coletiva contra o Decreto-Lei Tajani</h4>
                <p>Este site é um espaço para <strong>descendentes de italianos</strong> que residem no <strong>Brasil, Argentina, Canadá, França, Estados Unidos e outros países </strong>participarem de uma <strong>manifestação coletiva</strong> contra o <strong>Decreto-Lei Tajani</strong>, que altera os critérios para a concessão de cidadania italiana.</p>
                <p>O referido decreto propõe mudanças significativas no sistema de cidadania <strong>jus sanguinis</strong>, limitando-o a <strong>filhos e netos de italianos nascidos na Itália</strong>, excluindo <strong>milhões de descendentes de italianos no exterior</strong>. Essa alteração ignora a <strong>rica história de emigração italiana</strong> e a <strong>contribuição contínua de suas comunidades no mundo todo</strong>. Além disso, a introdução do <strong>jus italiae</strong>, que concede cidadania a estrangeiros nascidos na Itália após <strong>10 anos de residência e conclusão do ciclo escolar</strong>, enquanto restringe o <strong>jus sanguinis</strong>, levanta preocupações sobre a definição de <strong>identidade nacional</strong> e a inclusão de <strong>milhões de ítalo-descendentes</strong>.</p>
                <p>Ao preencher seu <strong>nome</strong> e <strong>e-mail</strong> nos campos abaixo, sua mensagem será <strong>personalizada</strong> e enviada aos <strong>401 parlamentares italianos</strong>, solicitando a reconsideração deste decreto que ameaça desfazer <strong>gerações de história e cultura compartilhada</strong>. Sua participação é crucial para garantir que a <strong>diáspora italiana</strong> continue a ser reconhecida e valorizada.</p>
                <p>Preencha os campos abaixo e <strong>junte-se a nós nesta luta pela preservação de nossa história</strong>!</p>
            </div>

            <div class="form-container mx-auto my-5 p-4 bg-white shadow rounded">
                <h2>Manifestação coletiva contra o Decreto-Lei Tajani</h2>
                <form action="process.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label">País</label>
                        <select class="form-select" id="pais" name="pais" required>
                            <option value="" disabled selected>Selecione</option>
                            <option value="Brasileiro">Brasil</option>
                            <option value="Argentino">Argentina</option>
                            <option value="Canadenses">Canadá</option>
                            <option value="Americano">Estados Unidos</option>
                            <option value="Franceses">França</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="mensagem1" class="form-label">Português</label>
                            <textarea style="height: 600px; resize: none;" class="form-control" id="mensagem1" name="mensagem1" rows="4" required readonly><?php
                                                                                                                                                            $mensagem_pt = file_get_contents('mensagem_pt.html');
                                                                                                                                                            echo htmlspecialchars(strip_tags($mensagem_pt), ENT_QUOTES, 'UTF-8'); ?>
                            </textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="mensagem2" class="form-label">Italiano</label>
                            <textarea style="height: 600px; resize: none;" class="form-control" id="mensagem2-it" name="mensagem2-it" rows="4" required placeholder="Explique por que você se opõe ao Decreto-Lei Tajani..." readonly>
                                <?php
                                // Lê o conteúdo do arquivo
                                $mensagem_it = file_get_contents('mensagem_it.html');
                                // Remove as tags HTML e exibe apenas o texto
                                echo htmlspecialchars(strip_tags($mensagem_it), ENT_QUOTES, 'UTF-8');
                                ?>
                            </textarea>
                        </div>
                    </div>
                    <input type="hidden" name="language" value="pt">
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-info-circle"></i> Sua mensagem será enviada aos 401 parlamentares italianos.
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Enviar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- English Content -->
    <div id="content-en" class="content-section hidden">
        <header class="py-4 bg-danger text-white text-center">
            <h1>Collective manifesto against the Tajani Decree-Law</h1>
            <p>March 28, 2025</p>
            <div class="d-flex justify-content-center">
                <img src="https://flagcdn.com/w320/it.png" alt="Italy" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/br.png" alt="Brazil" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/ar.png" alt="Argentina" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/ca.png" alt="Canada" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/us.png" alt="United States" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/fr.png" alt="France" class="m-2" width="60">
            </div>
        </header>

        <div class="container">
            <div class="alert alert-info mt-4" role="alert">
                <h4 class="alert-heading">Collective manifesto against the Tajani Decree-Law</h4>
                <p>This site serves as a platform for citizens of <strong>Italian descent</strong> residing in <strong>Brazil, Argentina, Canada, France, United States, and other countries</strong> to speak out against the <strong>collective manifesto against the Tajani Decree-Law</strong>, which alters the criteria for granting Italian citizenship.</p>
                <p>The decree proposes significant changes to the <strong>jus sanguinis</strong> citizenship system, limiting it to <strong>children and grandchildren of Italians born in Italy</strong>, excluding <strong>millions of Italian descendants abroad</strong>. This change ignores the <strong>rich history of Italian emigration</strong> and the <strong>continuous contribution of its communities worldwide</strong>. Furthermore, the introduction of <strong>jus italiae</strong>, which grants citizenship to foreigners born in Italy after <strong>10 years of residence and completion of schooling</strong>, while restricting <strong>jus sanguinis</strong>, raises concerns about the definition of <strong>national identity</strong> and the inclusion of <strong>millions of Italian descendants</strong>.</p>
                <p>By filling in your <strong>name</strong> and <strong>email</strong> in the fields below, your message will be <strong>personalized</strong> and sent to <strong>401 Italian parliamentarians</strong>, requesting reconsideration of this decree that threatens to undo <strong>generations of shared history and culture</strong>. Your participation is crucial to ensure that the <strong>Italian diaspora</strong> continues to be recognized and valued.</p>
                <p>Fill in the fields below and <strong>join us in this fight to preserve our history</strong>!</p>
            </div>

            <div class="form-container mx-auto my-5 p-4 bg-white shadow rounded">
                <h2>Collective manifesto against the Tajani Decree-Law</h2>
                <form action="process.php" method="POST">
                    <div class="mb-3">
                        <label for="nome-en" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nome-en" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email-en" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email-en" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label">Country</label>
                        <select class="form-select" id="pais" name="pais" required>
                            <option value="" disabled selected>Select</option>
                            <option value="Brazilian">Brazil</option>
                            <option value="Argentinian">Argentina</option>
                            <option value="Canadian">Canada</option>
                            <option value="American">United States</option>
                            <option value="French">France</option>
                            <option value="Italian">Italy</option>
                        </select>
                    </div>

                    <!-- Na seção em Inglês (content-en) -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="mensagem1-en" class="form-label">English</label>
                            <textarea style="height: 600px; resize: none;" class="form-control" id="mensagem1-en" name="mensagem1-en" rows="4" required readonly><?php
                                                                                                                                                                $mensagem_en = file_get_contents('mensagem_en.html');
                                                                                                                                                                echo htmlspecialchars(strip_tags($mensagem_en), ENT_QUOTES, 'UTF-8');
                                                                                                                                                                ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="mensagem2-en" class="form-label">Italian</label>
                            <textarea style="height: 600px; resize: none;" class="form-control" id="mensagem2-it" name="mensagem2-it" rows="4" required readonly><?php
                                                                                                                                                                    $mensagem_it = file_get_contents('mensagem_it.html');
                                                                                                                                                                    echo htmlspecialchars(strip_tags($mensagem_it), ENT_QUOTES, 'UTF-8');
                                                                                                                                                                    ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="language" value="en">
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-info-circle"></i> Your message will be sent to the 401 Italian parliamentarians.
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Contenuto Italiano -->
    <div id="content-it" class="content-section hidden">
        <header class="py-4 bg-danger text-white text-center">
            <h1>Manifestazione collettiva contro il Decreto-Legge Tajani</h1>
            <p>28 marzo 2025</p>
            <div class="d-flex justify-content-center">
                <img src="https://flagcdn.com/w320/it.png" alt="Italia" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/br.png" alt="Brasile" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/ar.png" alt="Argentina" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/ca.png" alt="Canada" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/us.png" alt="Stati Uniti" class="m-2" width="60">
                <img src="https://flagcdn.com/w320/fr.png" alt="Francia" class="m-2" width="60">
            </div>
        </header>

        <div class="container">
            <div class="alert alert-info mt-4" role="alert">
                <h4 class="alert-heading">Manifestazione collettiva contro il Decreto-Legge Tajani</h4>
                <p>Questo sito funge da piattaforma per i cittadini <strong>di discendenza italiana</strong> residenti in <strong>Brasile, Argentina, Canada, Francia, Stati Uniti e altri paesi</strong> per esprimersi contro il <strong>Decreto-Legge proposto dal Ministro Antonio Tajani</strong>, che modifica i criteri per la concessione della cittadinanza italiana.</p>
                <p>Il decreto propone cambiamenti significativi al sistema di cittadinanza <strong>jus sanguinis</strong>, limitandolo a <strong>figli e nipoti di italiani nati in Italia</strong>, escludendo <strong>milioni di discendenti italiani all'estero</strong>. Questo cambiamento ignora la <strong>ricca storia dell'emigrazione italiana</strong> e il <strong>continuo contributo delle sue comunità in tutto il mondo</strong>. Inoltre, l'introduzione dello <strong>jus italiae</strong>, che concede la cittadinanza agli stranieri nati in Italia dopo <strong>10 anni di residenza e completamento del ciclo scolastico</strong>, mentre restringe lo <strong>jus sanguinis</strong>, solleva preoccupazioni sulla definizione di <strong>identità nazionale</strong> e sull'inclusione di <strong>milioni di italo-discendenti</strong>.</p>
                <p>Compilando il tuo <strong>nome</strong> e <strong>email</strong> nei campi sottostanti, il tuo messaggio sarà <strong>personalizzato</strong> e inviato ai <strong>401 parlamentari italiani</strong>, richiedendo la riconsiderazione di questo decreto che minaccia di annullare <strong>generazioni di storia e cultura condivisa</strong>. La tua partecipazione è fondamentale per garantire che la <strong>diaspora italiana</strong> continui ad essere riconosciuta e valorizzata.</p>
                <p>Compila i campi sottostanti e <strong>unisciti a noi in questa lotta per preservare la nostra storia</strong>!</p>
            </div>

            <div class="form-container mx-auto my-5 p-4 bg-white shadow rounded">
                <h2>Manifestazione collettiva contro il Decreto-Legge Tajani</h2>
                <form action="process.php" method="POST">
                    <div class="mb-3">
                        <label for="nome-it" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome-it" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email-it" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email-it" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label">Paese</label>
                        <select class="form-select" id="pais" name="pais" required>
                            <option value="" disabled selected>Seleziona</option>
                            <option value="Brasiliano">Brasile</option>
                            <option value="Argentino">Argentina</option>
                            <option value="Canadese">Canada</option>
                            <option value="Americano">Stati Uniti</option>
                            <option value="Francese">Francia</option>
                            <option value="Italiano">Italia</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="mensagem1-it" class="form-label">Italiano</label>
                            <textarea style="height: 600px; resize: none;" class="form-control" id="mensagem1-it" name="mensagem1" rows="4" required readonly><?php
                                                                                                                                                                $mensagem_it = file_get_contents('mensagem_it.html');
                                                                                                                                                                echo htmlspecialchars(strip_tags($mensagem_it), ENT_QUOTES, 'UTF-8');
                                                                                                                                                                ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="language" value="it">
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-info-circle"></i> Il tuo messaggio sarà inviato ai 401 parlamentari italiani.
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Invia</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Armazena os templates das mensagens em cada idioma
        const messageTemplates = {
            pt: `<?php echo htmlspecialchars(strip_tags(file_get_contents('mensagem_pt.html')), ENT_QUOTES, 'UTF-8'); ?>`,
            en: `<?php echo htmlspecialchars(strip_tags(file_get_contents('mensagem_en.html')), ENT_QUOTES, 'UTF-8'); ?>`,
            it: `<?php echo htmlspecialchars(strip_tags(file_get_contents('mensagem_it.html')), ENT_QUOTES, 'UTF-8'); ?>`
        };

        // Função para sincronizar o scroll de dois textareas
        function setupScrollSync() {
            // Pares de textareas para sincronizar (ids)
            const textareaPairs = [
                // Par português-italiano
                ['mensagem1', 'mensagem2-it'],
                // Par inglês-italiano 
                ['mensagem1-en', 'mensagem2-it']
            ];

            // Flag para prevenir loop infinito
            let isScrolling = false;

            // Para cada par, configuramos os listeners
            textareaPairs.forEach(pair => {
                const textarea1 = document.getElementById(pair[0]);
                const textarea2 = document.getElementById(pair[1]);

                // Se os dois elementos existem
                if (textarea1 && textarea2) {
                    // Adicionar event listener ao primeiro textarea
                    textarea1.addEventListener('scroll', function() {
                        // Se já estamos rolando, não faça nada para evitar loop
                        if (isScrolling) return;

                        // Definir flag para prevenir loop
                        isScrolling = true;

                        // Calcular a porcentagem de rolagem
                        const scrollPercentage = this.scrollTop / (this.scrollHeight - this.clientHeight);

                        // Aplicar a mesma porcentagem ao segundo textarea
                        textarea2.scrollTop = scrollPercentage * (textarea2.scrollHeight - textarea2.clientHeight);

                        // Resetar a flag depois de um breve delay
                        setTimeout(() => {
                            isScrolling = false;
                        }, 10);
                    });

                    // Adicionar event listener ao segundo textarea
                    textarea2.addEventListener('scroll', function() {
                        // Se já estamos rolando, não faça nada para evitar loop
                        if (isScrolling) return;

                        // Definir flag para prevenir loop
                        isScrolling = true;

                        // Calcular a porcentagem de rolagem
                        const scrollPercentage = this.scrollTop / (this.scrollHeight - this.clientHeight);

                        // Aplicar a mesma porcentagem ao primeiro textarea
                        textarea1.scrollTop = scrollPercentage * (textarea1.scrollHeight - textarea1.clientHeight);

                        // Resetar a flag depois de um breve delay
                        setTimeout(() => {
                            isScrolling = false;
                        }, 10);
                    });
                }
            });
        }

        // Função para atualizar todas as mensagens visíveis
        function updateAllMessages() {
            // Obtém o idioma ativo
            const activeSection = document.querySelector('.content-section:not(.hidden)');
            const activeLang = activeSection ? activeSection.id.split('-')[1] : 'pt';

            // Obtém os valores dos campos do formulário ativo
            const form = activeSection.querySelector('form');
            const nome = form.querySelector('[name="nome"]').value;
            const email = form.querySelector('[name="email"]').value;
            const pais = form.querySelector('[name="pais"]').value;
            const dataAtual = new Date().toLocaleDateString('pt-BR'); // Formato DD/MM/AAAA

            // Função para substituir placeholders
            const replacePlaceholders = (template) => {
                let mensagem = template;
                if (nome) mensagem = mensagem.replace(/\[\[Nome\]\]/g, nome);
                if (email) mensagem = mensagem.replace(/\[\[Email\]\]/g, email);
                if (pais) mensagem = mensagem.replace(/\[\[nacionalidade\]\]/g, pais.toLowerCase());
                mensagem = mensagem.replace(/\[\[Data\]\]/g, dataAtual);
                return mensagem;
            };

            // Atualiza todas as áreas de mensagem visíveis
            document.querySelectorAll('textarea[id^="mensagem"]').forEach(textarea => {
                const lang = textarea.id.split('-')[1] || textarea.id.replace('mensagem', '');
                const template = messageTemplates[lang] || messageTemplates.pt;
                textarea.value = replacePlaceholders(template);
            });
        }

        // Configura os event listeners para os campos de formulário
        function setupFormListeners() {
            document.addEventListener('input', function(e) {
                if (e.target.matches('input, select')) {
                    updateAllMessages();
                }
            });

            document.addEventListener('change', function(e) {
                if (e.target.matches('select[name="pais"]')) {
                    updateAllMessages();
                }
            });
        }

        // Função para trocar de idioma
        function changeLanguage(lang) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(`content-${lang}`).classList.remove('hidden');
            document.getElementById('current-language').textContent =
                lang === 'pt' ? 'Português' :
                lang === 'en' ? 'English' : 'Italiano';

            document.title =
                lang === 'pt' ? 'Manifestação ao Decreto-Lei Tajani' :
                lang === 'en' ? 'Collective Manifesto Against the Tajani Decree-Law' :
                'Manifestazione Collettiva contro il Decreto-Legge Tajani';

            updateAllMessages();
        }

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            setupFormListeners();
            updateAllMessages();
            setupScrollSync();

            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    changeLanguage(this.getAttribute('data-lang'));
                });
            });

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const nome = form.querySelector('[name="nome"]').value.trim();
                    const email = form.querySelector('[name="email"]').value.trim();

                    if (!nome || !email) {
                        e.preventDefault();
                        alert(
                            form.querySelector('[name="language"]').value === 'pt' ? 'Por favor, preencha todos os campos obrigatórios!' :
                            form.querySelector('[name="language"]').value === 'en' ? 'Please fill in all required fields!' :
                            'Si prega di compilare tutti i campi obbligatori!'
                        );
                    }
                });
            });
        });
    </script>

</body>

</html>