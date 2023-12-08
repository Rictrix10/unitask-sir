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
        <h1 class="text-center">Perfil</h1>
    </section>

    <section class="container">
        <div class="grid gap-3">
            <form class="row g-3" action="{{ route('update.user.data') }}" method="POST">
                @csrf <!-- Adicione o token CSRF para proteção contra ataques -->

                <div class="col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>

                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}">
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone_number }}">
                </div>

                <div class="col-md-6">
                    <label for="address" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Editar dados</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
