<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'Email - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #FFE3E3 0%, #FFF5F5 100%);
        }
        .custom-shape {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="bg-white/80 backdrop-blur-lg rounded-[2.5rem] shadow-2xl w-full max-w-md p-8">
        <div class="flex items-center gap-2 mb-8">
            <div class="w-10 h-10 bg-[#FF6B6B] custom-shape"></div>
            <h1 class="text-2xl font-bold text-[#2F2E41]">PetsCape</h1>
        </div>

        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-[#2F2E41]">Vérifiez votre adresse e-mail</h2>

            @if (session('resent'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                    Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                </div>
            @endif

            <p class="text-gray-600">
                Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification.
                Si vous n'avez pas reçu l'e-mail, cliquez sur le bouton ci-dessous pour en recevoir un nouveau.
            </p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-all duration-300">
                    Renvoyer l'email de vérification
                </button>
            </form>

            <p class="text-center text-sm text-gray-600">
                <a href="/" class="text-[#FF6B6B] hover:text-[#FF8787]">
                    Retour à l'accueil
                </a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
