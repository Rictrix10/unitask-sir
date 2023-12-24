<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UniTask</title>

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/background.css') }}">
    <script defer src="Scripts/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    
</head>
    <body class="bg-transparent">
        <header>
            <section>
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div>
            </section>
            <nav>
                <div class="p-3 mb-2 bg-transparent text-white">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item">
                                    <div class="nav-link">
                                    <form method="get" action="{{ url('/login') }}">
                                        <button type="submit" class="shadow-lg btn btn-dark">Iniciar Sessão</button>
                                    </form>
                                    </div>
                                </li>
                                <li class="nav-item">
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <section class="container icon" id="home">
                <div class="container text-center">
                    <img src="Images/icon.png" class="img-fluid mx-auto my-1" alt="Imagem responsiva">
                </div>
                <div class="container">
                    <div class="blockquote text-center">
                        <div id="title">
                            <span>UniTask</span>
                            <br>
                            <span class="span2 text-md text-lg text-sm">
                                A solução perfeita para gerir as suas tarefas de forma completa e eficiente
                            </span>
                        </div>
                    </div>
                </div>
            </section>    
        </header>

        <main>
            <div class="container zone" id="conta">
                <div class="row hidden">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6 text-center">
                            <br>
                            <h3 class="text-monospace subTitle h">Crie uma Conta Personalizada:</h3>
                            <p class="text-justify">Desfrute de uma experiência personalizada ao criar sua própria conta. Com uma conta personalizada, você terá acesso a recursos exclusivos, poderá salvar suas configurações preferidas e receber recomendações personalizadas com base no seu histórico de atividades. Sua conta é a chave para desbloquear todo o potencial da nossa plataforma de gestão de tarefas.</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="Images/criarConta.png" class="img-fluid" alt="Imagem responsiva">                            
                        </div>
                    </div>
                </div>
            </div>               

            <div class="container zone" id="organizar">
                <div class="row hidden">
                    <div class="row justify-content-around align-items-center">
                        <div class="col-md-6 text-center">
                            <br>
                            <h3 class="text-monospace subTitle h">Organize suas Tarefas com Categorização:</h3>
                            <p class="text-justify">Simplifique a gestão do seu fluxo de trabalho categorizando suas tarefas de forma intuitiva. Agrupe tarefas relacionadas sob categorias específicas para uma visão organizada e estruturada. A categorização facilita a identificação rápida de áreas prioritárias e ajuda na distribuição eficiente das suas responsabilidades.</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="Images/categorias.png" class="img-fluid" alt="Imagem responsiva">                       
                        </div>
                    </div>
                </div>
            </div>
        
            <section>
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div>
            </section>
            
            <div class="container zone" id="documentos">
                <div class="row hidden">
                    <div class="row justify-content-around align-items-center">
                        <div class="col-md-6 text-center">
                            <br>
                            <h3 class="text-monospace subTitle h">Anexe Documentos e Ficheiros às Suas Tarefas!</h3>
                            <p class="text-justify">Vá além das simples descrições e enriqueça suas tarefas com a capacidade de anexar documentos e ficheiros importantes. Mantenha todas as informações relevantes centralizadas, garantindo que você e sua equipe tenham acesso fácil a recursos essenciais para a conclusão bem-sucedida de cada tarefa.</p>
                        </div>
                        <div class="col-md-6 text-center">
                                <img src="Images/calendario.png" class="img-fluid" alt="Imagem responsiva">
                        </div>
                    </div>
                </div>
            </div>    
           
            <div class="container zone" id="compartilhar">
                <div class="row hidden">
                    <div class="row justify-content-around align-items-center">
                        <div class="col-md-6 text-center">
                            <br>
                            <h3 class="text-monospace subTitle h">Compartilhe Suas Tarefas com Outros Utilizadores!</h3>
                            <p class="text-justify">Colabore de forma eficaz compartilhando tarefas com outros utilizadores. Atribua responsabilidades, promova a transparência e melhore a comunicação ao permitir que membros da equipe visualizem e contribuam para o progresso das tarefas compartilhadas. Uma gestão de tarefas verdadeiramente colaborativa.</p>
                        </div>
                        <div class="col-md-6 text-center">
                                <img src="Images/compartilhar.png" class="img-fluid" alt="Imagem responsiva"> 
                        </div>
                    </div>
                </div>
            </div>   
            <div class="container zone" id="sobrenos">
                <div class="row hidden"> 
                    <div class="row justify-content-around align-items-center">
                        <div class="col-md-6 text-center">
                            <br>
                            <h3 class="text-monospace subTitle h">Sobre nós</h3>
                            <p class="text-justify">Desenvolvemos estratégias personalizadas para organizar suas tarefas, otimizando o tempo e aumentando a eficácia do seu trabalho. Seja para projetos pessoais ou corporativos, estamos aqui para ajudar a criar roteiros de sucesso.</p>
                            <button onclick="location.href='mailto:unitaskoficial@gmail.com'" class="shadow-lg btn btn-dark">Contacte-nos</button>
                        </div>
                        <div class="col-md-6 text-center">
                                <img src="Images/aboutus.png" class="img-fluid" alt="Imagem responsiva">
                        </div>
                    </div>
                </div>
            </div>  
    </main>

    <footer class="footerZone">
        <br>
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm text-center">
                        <h5 class="footerp">Trabalho realizado por:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#home" class="badge badge-dark custom-link custom-badge">Gonçalo Fonte</a>
                            </li>
                            <li>
                                <a href="#home" class="badge badge-dark custom-link custom-badge">Ricardo Gonçalves</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm text-center">
                        <h5 class="footerp">Tópicos:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#home" class="badge badge-dark custom-link custom-badge">Inicio</a>
                            </li>
                            <li>
                                <a href="#conta" class="badge badge-dark custom-link custom-badge">Conta</a>
                            </li>
                            <li>
                                <a href="#organizar" class="badge badge-dark custom-link custom-badge">Organizar</a>
                            </li>
                            <li>
                                <a href="#compartilhar" class="badge badge-dark custom-link custom-badge">Compartilhar</a>
                            </li>
                            <li>
                                <a href="#sobrenos" class="badge badge-dark custom-link custom-badge">Sobre nós</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm text-center">
                        <h5 class="footerp">Contactos:</h5>
                        <ul class="list-unstyled text-center">
                            <li>
                                <a href="https://www.instagram.com/unitaskoficial/" class="social-icons"><i class="ri-instagram-fill"></i> Instagram</a>
                            </li>
                            <li>
                                <a href="https://github.com/Fonntes/Trabalho-sir" class="social-icons"><i class="ri-github-fill"></i>GitHub</a>
                            </li>
                            <li>
                                <a href="#" class="social-icons"><i class="ri-facebook-fill"></i>Facebook</a>
                            </li>
                        </ul>
                    </div>
                    <h10 >©2023-2024 Unitask. Todos os direitos reservados. Instituto Politécnico de Viana do Castelo.</h10>
                </div>
            </div>
    </footer>
    </body>
</html>