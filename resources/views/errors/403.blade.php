<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès refusé - GSN</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #f9fafb; margin: 0; }
        .box { text-align: center; max-width: 420px; padding: 2rem; }
        .box i.icon { font-size: 3rem; color: #dc2626; margin-bottom: 1rem; }
        .box h1 { font-size: 1.5rem; color: #111827; margin-bottom: .5rem; }
        .box p { color: #6b7280; font-size: .9rem; line-height: 1.6; margin-bottom: 1.5rem; }
        .box a { display: inline-flex; align-items: center; gap: .4rem; padding: .6rem 1.2rem; background: #1a6b3c; color: #fff; border-radius: 8px; text-decoration: none; font-size: .875rem; font-weight: 500; }
        .box a:hover { background: #134f2c; }
    </style>
</head>
<body>
    <div class="box">
        <i class="fa-solid fa-shield-halved icon"></i>
        <h1>Accès non autorisé</h1>
        <p>Vous n'avez pas les permissions nécessaires pour accéder à cette page. Contactez un administrateur si vous pensez qu'il s'agit d'une erreur.</p>
        <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i> Retour au site</a>
    </div>
</body>
</html>
