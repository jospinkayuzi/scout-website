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
            background:
                radial-gradient(circle at 18% 20%, rgba(255,224,32,.12), transparent 18%),
                radial-gradient(circle at 82% 22%, rgba(32,64,128,.20), transparent 20%),
                linear-gradient(135deg, #10154c 0%, #1a2070 42%, #202080 72%, #204080 100%);
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle at 30% 40%, rgba(224,192,32,.10) 0%, transparent 50%),
                        radial-gradient(circle at 70% 60%, rgba(255,224,32,.06) 0%, transparent 40%);
            pointer-events: none;
        }
        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 920px;
            min-height: 540px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,.4);
            position: relative;
            z-index: 1;
        }
        .login-left {
            flex: 1;
            background: linear-gradient(180deg, rgba(32,32,128,.60) 0%, rgba(16,21,76,.84) 100%);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #e0c020, #ffe020, #e0c020);
        }
        .login-left img {
            width: 120px; height: 120px;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,.3));
        }
        .login-left h1 {
            font-size: 1.5rem; font-weight: 700; margin-bottom: .5rem;
            text-shadow: 0 2px 8px rgba(0,0,0,.3);
        }
        .login-left h1 span { color: #f4e58d; }
        .login-left p { font-size: .88rem; color: rgba(255,255,255,.65); max-width: 260px; line-height: 1.6; }
        .login-left .badge-gold {
            display: inline-flex; align-items: center; gap: .4rem;
            margin-top: 1.5rem; padding: .4rem 1rem;
            background: rgba(224,192,32,.15); border: 1px solid rgba(224,192,32,.35);
            border-radius: 20px; font-size: .75rem; font-weight: 600;
            color: #f4e58d; letter-spacing: .03em;
        }
        .login-right {
            flex: 1;
            background: linear-gradient(180deg, #ffffff 0%, #f7f9ff 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
        }
        .login-right h2 {
            font-size: 1.4rem; font-weight: 700; color: #202080;
            margin-bottom: .35rem;
        }
        .login-right .subtitle { font-size: .875rem; color: #6b7280; margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: .8rem; font-weight: 600; color: #374151; margin-bottom: .35rem; }
        .input-wrap {
            display: flex; align-items: center; gap: .6rem;
            border: 1.5px solid #d1d5db; border-radius: 10px; padding: 0 .85rem;
            transition: border-color .2s, box-shadow .2s; background: #fff;
        }
        .input-wrap:focus-within { border-color: #202080; box-shadow: 0 0 0 3px rgba(32,32,128,.1); }
        .input-wrap i { color: #9ca3af; font-size: .9rem; }
        .input-wrap input {
            flex: 1; border: none; outline: none; padding: .7rem 0;
            font-size: .9rem; font-family: inherit; background: transparent;
        }
        .input-wrap .toggle-pw { background: none; border: none; color: #9ca3af; cursor: pointer; font-size: .9rem; padding: .25rem; }
        .input-wrap .toggle-pw:hover { color: #6b7280; }
        .form-options { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem; }
        .remember-me { display: flex; align-items: center; gap: .4rem; font-size: .8rem; color: #4b5563; cursor: pointer; }
        .remember-me input { accent-color: #202080; width: 16px; height: 16px; }
        .btn-login {
            width: 100%; padding: .8rem; border: none; border-radius: 10px;
            background: linear-gradient(135deg, #202080, #204080);
            color: #fff; font-size: .95rem; font-weight: 600;
            font-family: inherit; cursor: pointer;
            transition: all .2s;
            display: flex; align-items: center; justify-content: center; gap: .5rem;
            box-shadow: 0 6px 18px rgba(32,32,128,.28);
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #10154c, #202080);
            box-shadow: 0 8px 22px rgba(32,32,128,.34);
            transform: translateY(-1px);
        }
        .btn-login i { color: #ffe020; }
        .separator {
            display: flex; align-items: center; gap: .75rem;
            margin-bottom: 1.25rem; color: #d1d5db; font-size: .78rem;
        }
        .separator::before, .separator::after {
            content: ''; flex: 1; height: 1px; background: #e5e7eb;
        }
        .error-box {
            background: #fef2f2; border: 1px solid #fca5a5; border-radius: 10px;
            padding: .65rem .85rem; margin-bottom: 1.25rem;
            font-size: .8rem; color: #991b1b; display: flex; align-items: center; gap: .4rem;
        }
        .back-link {
            display: block; text-align: center; margin-top: 1.5rem;
            font-size: .8rem; color: #6b7280; text-decoration: none;
            transition: color .15s;
        }
        .back-link:hover { color: #202080; }
        .gold-line {
            width: 40px; height: 3px; background: linear-gradient(90deg, #e0c020, #ffe020); border-radius: 2px;
            margin-bottom: 1.5rem;
        }
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
            <h1>Groupe Scout <span>Saint Nicolas</span></h1>
            <p>Panneau d'administration pour la gestion du site et des membres</p>
            <div class="badge-gold">
                <i class="fa-solid fa-fleur-de-lis"></i> Toujours Prêts
            </div>
        </div>
        <div class="login-right">
            <h2>Connexion</h2>
            <div class="gold-line"></div>
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
