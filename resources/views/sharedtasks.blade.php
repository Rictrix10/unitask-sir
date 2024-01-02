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
    <nav>
        <a href="{{ route('tasks') }}">Homepage</a>
        <a href="{{ route('profile') }}">Meu Perfil</a>
        <a href="{{ route('sharedtasks') }}">Tarefas Partilhadas</a>
        <a href="#">Logout</a>
    </nav>

    <section class="card-container">
        <form action="{{ route('tasks') }}" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Pesquisar por nome" name="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Pesquisar</button>
            </div>
        </form>

        @forelse ($sharedtasks as $sharedtask)
        @if (empty(request('search')) || Str::contains(strtolower($sharedtask->name), strtolower(request('search'))))
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Partilhado por: {{ $sharedtask->getUserNameAttribute() }}</h5>
                    <p class="card-text">Nome da Tarefa: {{ $sharedtask->name }}</p>
                    <p class="card-text">Descriçao: {{ $sharedtask->description }}</p>
                    <p class="card-text">Favorito: <input class="form-check-input" type="checkbox" value="" id="favorito" {{ $sharedtask->favorite ? 'checked' : '' }} disabled></p>
                    <p class="card-text">Data: {{ $sharedtask->initial_date ? $sharedtask->initial_date: 'N/A' }}</p>
                    <p class="card-text">Data de criação: {{ $sharedtask->created_at ? $sharedtask->created_at->format('d-m-Y H:i:s') : 'N/A' }}</p>
                    <p class="card-text">Data de finalização: {{ $sharedtask->finish_date ? $sharedtask->finish_date->format('d-m-Y H:i:s') : 'N/A' }}</p>
                    <p class="card-text">Categoria: {{ $sharedtask->getCategoryNameAttribute() }}</p>
                    <p class="card-text">Prioridade: {{ $sharedtask->getPriorityNameAttribute() }}</p>
                    <p class="card-text">Estado: {{ $sharedtask->getStateNameAttribute() }}</p>
                    <img src="{{ asset('images/' . $sharedtask->image) }}" alt="Task Image">
                    <div class="d-flex justify-content-end">
            </div>
        @endif
    @empty
        <p>Nenhuma tarefa partilhada.</p>
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
