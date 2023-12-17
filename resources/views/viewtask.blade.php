<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
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
        <div class="modal-content">
            @php
                $task = session('current_task');
            @endphp
            <br>  
            <form action="{{ route('update.task', ['id_task' => $task->id_task]) }}" method="post">
                @csrf
                @if($task)
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                        <input type="text" class="form-control" name="name" value="{{ $task->name }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Descrição</span>
                        <input type="text" class="form-control" name="description" value="{{ $task->description }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-check-input" type="checkbox" value="1" id="favorito" {{ $task->favorite ? 'checked' : '' }}  name="favorite">
                        <label class="form-check-label" for="favorito">
                            Favorito
                        </label>
                    </div>                    
                    <p class="card-text">Data de criação: {{ $task->created_at ? $task->created_at->format('d-m-Y H:i:s') : 'N/A' }}</p>
                    <p class="card-text">Data de finalização: {{ $task->finish_date ? $task->finish_date->format('d-m-Y H:i:s') : 'N/A' }}</p>
                    <div class="mb-3">
                        <label for="categoria">Categoria:</label>
                        <select class="form-select" id="categoria" name="id_category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id_category }}" {{ $task && $task->id_category == $category->id_category ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="prioridade">Prioridade:</label>
                        <select class="form-select" id="prioridade" name="id_priority">
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority->id_priority }}" {{ $task && $task->id_priority == $priority->id_priority ? 'selected' : '' }}>
                                    {{ $priority->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
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
                @endif
                <br>
                <button type="submit" class="btn btn-secondary">Editar</button>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
