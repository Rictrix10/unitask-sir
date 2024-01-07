<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edittask.css') }}">
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
                        <li class="nav-item mx-2 "><a class = "color" href="{{ route('tasks') }}">Homepage</a></li>
                        <li class="nav-item mx-2 "><a href="{{ route('profile') }}">Meu Perfil</a></li>
                        <li class="nav-item mx-2"><a href="{{ route('sharedtasks') }}">Tarefas Partilhadas</a></li>
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
                    Queres mesmo encerrar a sessão? :()
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('login') }}'">Confirmar</button>
                </div>
                </div>
            </div>
        </div>
    </nav>

    <section>
        @php
            $task = session('current_task');
        @endphp
        <form action="{{ route('update.task', ['id_task' => $task->id_task]) }}" method="post">
            @csrf
            @if($task)
                <div class="container text-center">
                        <div class="row">
                            <!--coluna 1-->
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3 text-start">
                                    <label for="nome" class="form-label text-light">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="name" value="{{ $task->name }}" aria-describedby="nomeHelp">
                                </div>  

                                <div class="mb-3 text-start text-light">
                                    <label for="categoria">Categoria:</label>
                                    <select class="form-select" id="categoria" name="id_category">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id_category }}" {{ $task && $task->id_category == $category->id_category ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <p class="card-text text-start text-light">Data de criação: {{ $task->created_at ? $task->created_at->format('d-m-Y H:i:s') : 'N/A' }}</p>
                                <p class="card-text text-start text-light">Data de finalização: {{ $task->finish_date ? $task->finish_date->format('d-m-Y H:i:s') : 'N/A' }}</p>

                                <div class="input-group mb-3">
                                    <label class="form-check-label text-light me-2" for="favorito">Favorito:</label>
                                    <input class="form-check-input" type="checkbox" value="1" id="favorito" {{ $task->favorite ? 'checked' : '' }}  name="favorite">
                                </div> 

                                <button type="submit" class="btn btn-secondary">Editar</button>
                            </div>

                            <!--coluna 2-->
                            <div class="col-sm-12 col-md-6 text-start text-light">
                                <div class="mb-3">
                                    <label for="estado">Estado:</label>
                                    <select class="form-select" id="estado" name="id_state">
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id_state }}" {{ $task && $task->id_state == $state->id_state ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="Descricao" class="form-label">Descrição:</label>
                                    <textarea class="form-control" id="Descricao" name="description" aria-describedby="descricaoHelp">{{ $task->description }}</textarea>
                                </div>
                            </div>
                        </div>
                </div>
            @endif
        </from>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
