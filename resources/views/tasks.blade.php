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

    <section class="card-container">
        <!-- Search Bar -->
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
                    <p class="card-text">ID: {{ $task->id_task }}</p>
                    <p class="card-text">Favorito: <input class="form-check-input" type="checkbox" value="" id="favorito" {{ $task->favorite ? 'checked' : '' }} disabled></p>
                    <p class="card-text">Data de criação: {{ $task->created_at ? $task->created_at->format('d-m-Y') : 'N/A' }}</p>
                    <p class="card-text">Data de finalização: {{ $task->finish_date ? $task->finish_date->format('d-m-Y') : 'N/A' }}</p>
                    <p class="card-text">Prioridade: {{ $task->priority }}</p>
                    <img src="{{ asset('images/' . $task->image) }}" alt="Task Image">
                    <!-- Buttons for Partilhar, Editar, and Eliminar -->
                    <div class="d-flex justify-content-end">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('viewtask', ['id_task' => $task->id_task]) }}">
                                <button type="button" class="btn btn-success">Ver Tarefa</button>
                            </a>
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
</body>
</html>
