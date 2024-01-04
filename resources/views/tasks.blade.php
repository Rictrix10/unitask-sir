<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">

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
                        <li class="nav-item mx-2 "><a class = "color" href="{{ route('tasks') }}">Homepage</a></li>
                        <li class="nav-item mx-2 "><a href="{{ route('profile') }}">Meu Perfil</a></li>
                        <li class="nav-item mx-2"><a href="{{ route('calendar') }}">Calendário</a></li>
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

    @if(session('share_error'))
    <div class="modal fade" id="shareErrorModal" tabindex="-1" aria-labelledby="shareErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareErrorModalLabel">Erro ao Compartilhar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session('share_error') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <section class="card-container">
        <form action="{{ route('tasks', request()->except('page')) }}" method="get" class="mb-3">

        <div class="container text-center">
            <div class="row row-cols-1 row-cols-sm-5 row-cols-md-6">

                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Pesquisar por nome" name="search" value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col">
                    <!--Filter by Category -->
                    <select class="form-select" name="filterCategory">
                        <option value="" selected>Todas as Categorias</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id_category }}" {{ request('filterCategory') == $category->id_category ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <!-- Filter by State -->
                    <select class="form-select" name="filterState">
                        <option value="" selected>Todos os Estados</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id_state }}" {{ request('filterState') == $state->id_state ? 'selected' : '' }}>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="filterPriority">
                        <option value="" selected>Todas as Prioridades</option>
                        @foreach($priorities as $priority)
                            <option value="{{ $priority->id_priority }}" {{ request('filterPriority') == $priority->id_priority ? 'selected' : '' }}>{{ $priority->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-outline-secondary">Pesquisar</button>
                </div>

                <div class="col">
                    <a href="{{ route('createtask') }}">
                        <button type="button" class="btn btn-success">Adicionar Tarefa</button>
                    </a>
                </div>

            </div>
        </div>

        </form>
    </section>
            
        
        @forelse ($tasks as $task)
            @if (empty(request('search')) || Str::contains(strtolower($task->name), strtolower(request('search'))))
                <div class="card mb-3">
                        <h5 class="card-title">{{ $task->name }}</h5>
                        <p class="card-text">{{ $task->description }}</p>
                        <p class="card-text">Favorito: <input class="form-check-input" type="checkbox" value="" id="favorito" {{ $task->favorite ? 'checked' : '' }} disabled></p>
                        <p class="card-text">Data: {{ $task->initial_date ? $task->initial_date: 'N/A' }}</p>
                        <p class="card-text">Data de criação: {{ $task->created_at ? $task->created_at->format('d-m-Y H:i:s') : 'N/A' }}</p>
                        <p class="card-text">Data de finalização: {{ $task->finish_date ? $task->finish_date->format('d-m-Y H:i:s') : 'N/A' }}</p>
                        <p class="card-text">Categoria: {{ $task->getCategoryNameAttribute() }}</p>
                        <p class="card-text">Prioridade: {{ $task->getPriorityNameAttribute() }}</p>
                        <p class="card-text">Estado: {{ $task->getStateNameAttribute() }}</p>
                        <img src="{{ asset('images/' . $task->image) }}" alt="Task Image">
                        <div class="d-flex justify-content-end">

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('viewtask', ['id_task' => $task->id_task]) }}">
                                    <button type="button" class="btn btn-success">Editar Tarefa</button>
                                </a>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id_task }}">
                                    Eliminar Tarefa
                                </button>
                            </div>

                            <!-- Modal de confirmação de exclusão -->
                            <div class="modal fade" id="deleteModal{{ $task->id_task }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>

                                        <div class="modal-body">
                                            Tem certeza de que deseja excluir esta tarefa?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <!-- Botão de exclusão dentro do modal -->
                                            <form action="{{ route('delete.task', ['id_task' => $task->id_task]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                    <!-- Botão "Partilhar" que abre o modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shareModal{{ $task->id_task }}">
                                        Partilhar
                                    </button>
                                </div>
                                <div class="modal fade" id="shareModal{{ $task->id_task }}" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="shareModalLabel">Partilhar Tarefa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                
                                <div class="modal-body">
                                    <!-- Formulário para inserir os detalhes de partilha -->
                                    <form action="{{ route('share.task', ['id_task' => $task->id_task]) }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email">Email do destinatário:</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="message">Mensagem:</label>
                                            <textarea class="form-control" id="message" name="message" required></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-pribmary">Enviar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <p>Nenhuma tarefa encontrada.</p>
        @endforelse
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>
        var shareError = "{{ session('share_error') }}";
        console.log(shareError);

        jQuery(document).ready(function() {
            if (shareError) {
                jQuery('#shareErrorModal').modal('show');
            }
        });
    </script>
    </body>
</html>
