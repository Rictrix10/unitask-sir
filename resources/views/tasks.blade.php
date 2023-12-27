<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-dzIMZfvXXgXALa8YVXSL5nVcybRT6iWPS8F/hhP5i5n0e4CQsKo2n/fCTt8U+BnR" crossorigin="anonymous">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Tarefa</title>
</head>
    
<body>
    <header>
        <h1>Unitask (TAREFA)</h1>
    </header>

    <nav>
        <a href="{{ route('homepage') }}">Homepage</a>
        <a href="{{ route('profile') }}">Meu Perfil</a>
        <a href="{{ route('tasks') }}">Minhas Tarefas</a>
        <a href="#">Caixa de Entrada</a>
        <a href="#">Logout</a>
    </nav>

    <section>
        <a href="{{ route('createtask') }}">
            <button type="button" class="btn btn-success">Adicionar Tarefa</button>
        </a>
    </section>

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
        <form action="{{ route('tasks') }}" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Pesquisar por nome" name="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Pesquisar</button>
            </div>
        </form>

        @forelse ($tasks as $task)
        @if (empty(request('search')) || Str::contains(strtolower($task->name), strtolower(request('search'))))
            <div class="card">
                <div class="card-body">
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
                                    <button type="submit" class="btn btn-primary">Enviar</button>
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


    </section>
    
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
