<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - GSN Administration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f2419 0%, #1a3a2a 30%, #1a6b3c 70%, #22863a 100%);
            padding: 1rem;
        }
        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 520px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,.3);
        }
        .login-left {
            flex: 1;
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            color: #fff;
            text-align: center;
        }
        .login-left img { width: 100px; height: 100px; border-radius: 50%; margin-bottom: 1.5rem; }
        .login-left h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: .5rem; }
        .login-left p { font-size: .9rem; color: rgba(255,255,255,.7); max-width: 240px; line-height: 1.5; }
        .login-right {
            flex: 1;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
        }
        .login-right h2 { font-size: 1.4rem; font-weight: 700; color: #111827; margin-bottom: .35rem; }
        .login-right .subtitle { font-size: .875rem; color: #6b7280; margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: .8rem; font-weight: 600; color: #374151; margin-bottom: .35rem; }
        .input-wrap {
            display: flex; align-items: center; gap: .6rem;
            border: 1.5px solid #d1d5db; border-radius: 10px; padding: 0 .85rem;
            transition: border-color .2s, box-shadow .2s; background: #fff;
        }
        .input-wrap:focus-within { border-color: #1a6b3c; box-shadow: 0 0 0 3px rgba(26,107,60,.12); }
        .input-wrap i { color: #9ca3af; font-size: .9rem; }
        .input-wrap input {
            flex: 1; border: none; outline: none; padding: .7rem 0;
            font-size: .9rem; font-family: inherit; background: transparent;
        }
        .input-wrap .toggle-pw { background: none; border: none; color: #9ca3af; cursor: pointer; font-size: .9rem; padding: .25rem; }
        .input-wrap .toggle-pw:hover { color: #6b7280; }
        .form-options { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem; }
        .remember-me { display: flex; align-items: center; gap: .4rem; font-size: .8rem; color: #4b5563; cursor: pointer; }
        .remember-me input { accent-color: #1a6b3c; width: 16px; height: 16px; }
        .btn-login {
            width: 100%; padding: .8rem; border: none; border-radius: 10px;
            background: #1a6b3c; color: #fff; font-size: .95rem; font-weight: 600;
            font-family: inherit; cursor: pointer; transition: background .15s;
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .btn-login:hover { background: #134f2c; }
        .error-box {
            background: #fef2f2; border: 1px solid #fca5a5; border-radius: 10px;
            padding: .65rem .85rem; margin-bottom: 1.25rem;
            font-size: .8rem; color: #991b1b; display: flex; align-items: center; gap: .4rem;
        }
        .back-link {
            display: block; text-align: center; margin-top: 1.5rem;
            font-size: .8rem; color: #6b7280; text-decoration: none;
        }
        .back-link:hover { color: #1a6b3c; }
        @media (max-width: 640px) {
            .login-left { display: none; }
            .login-wrapper { max-width: 420px; }
            .login-right { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-left">
            <img src="{{ asset('images/logo-gsn.png') }}" alt="GSN">
            <h1>Scouts du Burundi</h1>
            <p>Panneau d'administration pour la gestion du site et des membres</p>
        </div>
        <div class="login-right">
            <h2>Connexion</h2>
            <p class="subtitle">Accédez au panneau d'administration</p>

            @if($errors->any())
                <div class="error-box">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Adresse e-mail</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@gsn.bi" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
                        <button type="button" class="toggle-pw" onclick="togglePassword()">
                            <i class="fa-solid fa-eye" id="pw-icon"></i>
                        </button>
                    </div>
                </div>
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Se souvenir de moi
                    </label>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i> Se connecter
                </button>
            </form>
            <a href="{{ url('/') }}" class="back-link"><i class="fa-solid fa-arrow-left"></i> Retour au site</a>
        </div>
    </div>
    <script>
    function togglePassword(){
        var p=document.getElementById('password'),i=document.getElementById('pw-icon');
        if(p.type==='password'){p.type='text';i.classList.replace('fa-eye','fa-eye-slash');}
        else{p.type='password';i.classList.replace('fa-eye-slash','fa-eye');}
    }
    </script>
</body>
</html>
