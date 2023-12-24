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
          <h6 class="mb-0 pb-3"><span>Login</span><span>Registar</span></h6>
          <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
          <label for="reg-log"></label>
          <div class="card-3d-wrap mx-auto">
            <div class="card-3d-wrapper">
              <div class="card-front">
                <div class="center-wrap">
                  <div class="section text-center">
                    <h1 class="mb-4 pb-3">Login</h1>
                    <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="form-group">
                        <input type="text" class="form-style" name="username" id="username" placeholder="Nome">
                        <i class="input-icon uil uil-at"></i>
                      </div>
                      <div class="form-group mt-2">
                        <input type="password" name="password" id="password" class="form-style" placeholder="Palavra-passe">
                        <i class="input-icon uil uil-lock-alt"></i>
                      </div>
                      <div class="space">
                        @if(session('error'))
                            <div class="textcolor">
                                {{ session('error') }}
                            </div>
                        @endif
                      </div>
                      <button type="submit" class="btn btn-dark loginButton">Login</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="card-back">
                <div class="center-wrap">
                  <div class="section text-center">
                    <form method="POST" action="{{ route('register') }}">
                      <h1 class="mb-3 pb-3">Registar</h1>
                      @csrf
                      <div class="form-group">
                        <input type="text" name="name" id="name" class="form-style" placeholder="Nome">
                        <i class="input-icon uil uil-user"></i>
                      </div>
                      <div class="form-group mt-2">
                        <input type="text" name="username" id="signup-username" class="form-style" placeholder="Nome de utilizador">
                        <i class="input-icon uil uil-user"></i>
                      </div>
                      <div class="form-group mt-2">
                        <input type="email" name="email" id="email" class="form-style" placeholder="Email">
                        <i class="input-icon uil uil-at"></i>
                      </div>
                      
                      <div class="form-group mt-2">
                          <input type="password" name="password" id="signup-password" class="form-style" placeholder="Palavra-Passe">
                            <i class="input-icon uil uil-lock-alt"></i>
                            <i type="button" id="showPasswordBtn" class="toggle-password input-icon uil uil-eye eye"></i>
                      </div>
                      
                      <div class="space">
                        @if(session('error2'))
                            <div class="textcolor">
                                {{ session('error2') }}
                            </div>
                        @endif
                      </div>
                      <button type="submit" class="btn btn-dark loginButton">Registar</button>
                    </form>
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

<script>
  document.getElementById("showPasswordBtn").addEventListener("click", function() {
    var passwordInput = document.getElementById("signup-password");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  });</script>
</body>
</html>
