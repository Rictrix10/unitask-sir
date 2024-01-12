<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/homeadmin.css') }}">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-dzIMZfvXXgXALa8YVXSL5nVcybRT6iWPS8F/hhP5i5n0e4CQsKo2n/fCTt8U+BnR" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Homepage</title>
</head>
    
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>

                <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="sidebar bg-dark offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                <div class="offcanvas-header text-white">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body d-flex flex-column p-4">
                    <ul class="navbar-nav justify-content-center align-itens-top fs-6 flex-grow-1 pe-3">
                        <li class="nav-item mx-2 "><a class = "color" href="{{ route('homeadmin') }}">Homepage</a></li>
                        <li class="nav-item mx-2 "><a href="{{ route('profile') }}">Meu Perfil</a></li>
                        <li class="nav-item mx-2"><a href="{{ route('shedule') }}">Calendário</a></li>
                        <li class="nav-item mx-2"><a href="{{ route('sharedtasks') }}">Tarefas Partilhadas</a></li>
                        <li class="nav-item mx-2 "><a class ="logoutColor" data-bs-toggle="modal" data-bs-target="#exampleModal">Encerrar sessão</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>


        <div class="container mt-4">
            <div class="row">
                <div class="col-sm-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('path-to-your-user-image.jpg') }}" class="card-img-top" alt="Utilizador">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('allusers') }}">Utilizadores</a></h5>
                            <p class="card-text">Faça a gestão de todos os utilizadores registados no site</p>
                        </div>
                    </div>
                </div>
                <!-- Card: Tarefa -->
                <div class="col-sm-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('path-to-your-task-image.jpg') }}" class="card-img-top" alt="Tarefa">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('alltasks') }}">Tarefas</a></h5>
                            <p class="card-text">Faça a gestão de todas as tarefas registadas no site</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('path-to-your-task-image.jpg') }}" class="card-img-top" alt="Tarefa Partilhada">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('allsharedtasks') }}">Tarefas Partilhadas</a></h5>
                            <p class="card-text">Visualize todas as partilhas no site</p>
                        </div>
                    </div>
                </div>
    
    
                <!-- Card: Estatísticas -->
                <div class="col-sm-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('path-to-your-stats-image.jpg') }}" class="card-img-top" alt="Estatísticas">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('adminstatistics') }}">Estatísticas</a></h5>
                            <p class="card-text">Visualize dados estatísticos no site</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>