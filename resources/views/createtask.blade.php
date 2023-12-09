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
            <br>  
            <form action="{{ route('create.task') }}" method="post" enctype="multipart/form-data">   
                @csrf <!-- Adiciona o token CSRF para proteção contra ataques CSRF -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                    <input type="text" class="form-control" name="name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-text">Descrição</span>
                    <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
                </div> 
                <br>
                <div class="mb-3">
                    <label for="image">Escolha uma imagem:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="favorito" name="favorite">
                    <label class="form-check-label" for="favorito">
                        Favorito
                    </label>
                </div>
                <br>
                <button type="submit" class="btn btn-secondary">Criar</button>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
