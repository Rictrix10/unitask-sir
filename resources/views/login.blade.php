<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/background.css') }}">
</head>

<body class="bg-transparent">

    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h1 class="mb-4 pb-3">Iniciar sessão</h1>
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" class="form-style" name="username"
                                                        id="username" placeholder="Nome">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" id="password"
                                                        class="form-style" placeholder="Palavra-passe">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="space">
                                                @if(session('error'))
                                                    <div class="textcolor">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-dark loginButton">Login
                                                </button>
                                            </form>
                                                <p class="haveregister">Não tens conta? Clica <a onclick="window.location.href='{{ url('/register') }}'" class="text-reset aqui">aqui</a>.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
