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
        <a href="{{ route('createtask') }}">
            <button type="button" class="btn btn-success">Adicionar Tarefa</button>
        </a>
        

    <section>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Favorito</th>
                    <th scope="col">Data de criação</th>
                    <th scope="col">Data de finalização</th>
                    <th scope="col">Prioridade</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemplos de linhas da tabela -->
                <tr>
                    <th scope="row">1</th>
                    <td>Sir</td>
                    <td>boostrap web.app</td>
                    <td><input class="form-check-input" type="checkbox" value="" id="favorito" checked disabled></td>
                    <td>22-09-2023</td>
                    <td>08-10-2023</td>
                    <td>Alta</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>IS</td>
                    <td>Freitas trabalha</td>
                    <td><input class="form-check-input" type="checkbox" value="" id="favorito" disabled></td>
                    <td>20-09-2023</td>
                    <td>08-11-2023</td>
                    <td>Normal</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>P3</td>
                    <td>Melhor trabalho de sempre</td>
                    <td><input class="form-check-input" type="checkbox" value="" id="favorito" checked disabled></td>
                    <td>19-08-2020</td>
                    <td>14-01-2024</td>
                    <td>Baixa</td>
                </tr>
            </tbody>
        </table>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
