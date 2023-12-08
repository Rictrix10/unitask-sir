<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>profile</title>
    </head>

    <body>
        <header>
            <h1>Unitask (PROFILE)</h1>
        </header>

        <nav>
            <a href="{{ route('homepage') }}">Homepage</a>
            <a href="{{ route('profile') }}">Meu Perfil</a>
            <a href="{{ route('tasks') }}">Minhas Tarefas</a>
            <a href="#">Caixa de Entrada</a>
            <a href="#">Logout</a>
        </nav>

        <section>
            <h1 class="text-center">Conteudo da conta</h1>
        </section>

        <section class="container">
            <div class="grid gap-3">
                <form class="form-floating">
                    <input type="text" class="form-control" id="name" placeholder="Nome" value="taremi">
                    <label for="name">Nome</label>
                </form>

                <form class="form-floating">
                    <input type="text" class="form-control" id="username" placeholder="Username" value="taremiKING">
                    <label for="username">Username</label>
                </form>

                <form class="form-floating">
                    <input type="email" class="form-control" id="email" placeholder="Email" value="taremi@example.com">
                    <label for="email">Email</label>
                </form>

                <form class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Password" value="********">
                    <label for="password">Password</label>
                </form>

                <form class="form-floating">
                    <input type="text" class="form-control" id="phone" placeholder="964159478" value="964126102">
                    <label for="phone">Telefone</label>
                </form>

                <form class="form-floating">
                    <input type="text" class="form-control" id="address" placeholder="Endereço" value="Rua Exemplo, 123">
                    <label for="address">Endereço</label>
                </form>

                <button type="button" class="btn btn-primary">Editar dados alterados</button>
        </section>
    </body>
</html>