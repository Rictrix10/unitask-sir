<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-dzIMZfvXXgXALa8YVXSL5nVcybRT6iWPS8F/hhP5i5n0e4CQsKo2n/fCTt8U+BnR" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Profile</title>
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
                        <li class="nav-item mx-2">
                            @if (Session::get('user_type') == 'Admin')
                                <a href="{{ route('homeadmin') }}">Página inicial</a>
                            @else
                                <a href="{{ route('tasks') }}">Página inicial</a>
                            @endif
                        </li>
                        <li class="nav-item mx-2 "><a class = "color" href="{{ route('profile') }}">Meu Perfil</a></li>
                        <li class="nav-item mx-2"><a href="{{ route('shedule') }}">Calendário</a></li>
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
                        Queres mesmo encerrar a sessão?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('login') }}'">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="modal fade" id="passModal" tabindex="-1" aria-labelledby="passModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('update.password.data') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="passModalLabel">Editar Palavra-passe</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
        
                        <div class="modal-body">
                            <p>Insira a nova palavra-passe</p>
                            <input type="password" class="form-control" id="password" name="password">
                            <br>
                            <p>Confirmar palavra-passe</p>
                            <input type="password" class="form-control" id="confirmpassword" name="confirm_password">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                            <button type="submit" class="btn btn-primary" name="pass">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

    <section>
        <h1 class="text-center text-light">Perfil</h1>
    </section>

    <section class="container">
        <div class="grid gap-3">
            <form class="row g-5" action="{{ route('update.user.data') }}" method="POST">
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>

                <div class="col-md-6">
                    <label for="username" class="form-label">Nome de utilizador</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="col-md-6">
                    <label for="address" class="form-label">Morada</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone_number }}">
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Palavra-Passe</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}">
                    <button type="button" id="openModalBtn" class="btn btn-primary btn-sm logoutColor" data-bs-toggle="modal" data-bs-target="#passModal" style="margin: 5px;">Editar Palavra-passe</button>

                </div>
                <div class="d-grid gap-2 col-2 mx-auto">
                    <button type="submit" class="btn btn-primary" name="dados">Editar dados</button>
                </div> 
            </form>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
