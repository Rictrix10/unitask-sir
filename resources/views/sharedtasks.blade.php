<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sharedtasks.css') }}">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-dzIMZfvXXgXALa8YVXSL5nVcybRT6iWPS8F/hhP5i5n0e4CQsKo2n/fCTt8U+BnR" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Tarefa</title>
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
                        <li class="nav-item mx-2">
                            @if (Session::get('user_type') == 'Admin')
                                <a href="{{ route('homeadmin') }}">Homepage</a>
                            @else
                                <a href="{{ route('tasks') }}">Homepage</a>
                            @endif
                        </li>
                        <li class="nav-item mx-2 "><a href="{{ route('profile') }}">Meu Perfil</a></li>
                        <li class="nav-item mx-2"><a href="{{ route('shedule') }}">Calendário</a></li>
                        <li class="nav-item mx-2"><a class = "color" href="{{ route('sharedtasks') }}">Tarefas Partilhadas</a></li>
                        <li class="nav-item mx-2 "><a class ="logoutColor" data-bs-toggle="modal" data-bs-target="#exampleModal">Encerrar sessão</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Encerrar sessão</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Queres mesmo encerrar a sessão?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('login') }}'">Confirmar</button>
                </div>
                </div>
            </div>
        </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            @forelse ($sharedtasks as $sharedtask)
                @if (empty(request('search')) || Str::contains(strtolower($sharedtask['task']->name), strtolower(request('search'))))
                    <div class="col">
                        <div class="card">

                            @if ($sharedtask['task']->favorite)
                                <div class="star position-absolute top-0 end-0 mt-2 me-2">
                                    <h1><i class="input-icon uil uil-star"></i></h1>
                                </div>
                            @else
                            @endif

                            @if (!empty($sharedtask['task']->image))
                                <img src="{{ asset('images/' . $sharedtask['task']->image) }}" class="card-img-top" alt="...">
                            @else
                                <p class="text-center alert text-">Sem Imagem</p>
                            @endif

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p class="text-left card-text">
                                        <span class="fw-bold">Partilhada por:</span> {{$sharedtask['task']->getNickUserAttribute() }}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-left card-text">
                                        <span class="fw-bold">Nome da tarefa:</span> {{ $sharedtask['task']->name }}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-left card-text">
                                        <span class="fw-bold">Mensagem:</span> {{ $sharedtask['message'] }} 
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-left card-text">
                                        <span class="fw-bold">Data inicial:</span> {{ $sharedtask['task']->initial_date ? $sharedtask['task']->initial_date : 'N/A' }}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-left card-text">
                                        <span class="fw-bold">Data final</span> {{ $sharedtask['task']->finish_date ? $sharedtask['task']->finish_date : 'N/A' }}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-left card-text">
                                        <span class="fw-bold">Categoria:</span> {{ $sharedtask['task']->getCategoryNameAttribute() }}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-left card-text">
                                        <span class="fw-bold">Prioridade:</span> {{ $sharedtask['task']->getPriorityNameAttribute() }}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-left card-text">
                                        <span class="fw-bold">Estado:</span> {{ $sharedtask['task']->getStateNameAttribute() }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col text-center noshared">
                    <h2>Nenhuma tarefa encontrada.</h2>
                </div>
            @endforelse
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
