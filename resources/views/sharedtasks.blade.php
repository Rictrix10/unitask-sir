<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sharedtasks.css') }}">

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
                        <li class="nav-item mx-2 "><a href="{{ route('tasks') }}">Homepage</a></li>
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
