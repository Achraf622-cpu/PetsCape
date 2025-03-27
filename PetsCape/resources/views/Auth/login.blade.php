<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
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
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
<div class="min-h-screen flex items-center justify-center p-6">
    <!-- Card principale -->
    <div class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-5xl flex overflow-hidden relative">

        <!-- Section gauche (formulaire) -->
        <div class="w-full lg:w-1/2 p-12 lg:p-16">
            <div class="flex items-center gap-2 mb-12">
                <div class="w-10 h-10 bg-[#FF6B6B] custom-shape"></div>
                <h1 class="text-2xl font-bold text-[#2F2E41]">PetsCape</h1>
            </div>

            <div class="space-y-6">
                <div>
                    <h2 class="text-3xl font-bold text-[#2F2E41] mb-2">Bon retour! 🐾</h2>
                    <p class="text-gray-600">Connectez-vous pour retrouver vos compagnons préférés</p>
                </div>

                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Affichage des erreurs de session -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <label class="block text-[#2F2E41] font-semibold" for="email">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full px-6 py-4 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none transition-colors @error('email') border-red-500 @enderror"
                            placeholder="votre@email.com"
                            required
                            autofocus
                        >
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[#2F2E41] font-semibold" for="password">
                            Mot de passe
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full px-6 py-4 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none transition-colors @error('password') border-red-500 @enderror"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" id="remember" class="w-5 h-5 accent-[#FF6B6B]">
                            <span class="text-gray-600">Se souvenir de moi</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-[#FF6B6B] hover:text-[#FF8787]">
                            Mot de passe oublié?
                        </a>
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-all duration-300 transform hover:scale-105">
                        Se connecter
                    </button>


                    <p class="text-center text-gray-600">
                        Pas encore membre?
                        <a href="#" class="text-[#FF6B6B] hover:text-[#FF8787] font-semibold">
                            Créer un compte
                        </a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Section droite (décorative) -->
        <div class="hidden lg:block w-1/2 bg-[#FFF5F5] relative overflow-hidden">
            <!-- Cercles décoratifs -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#FFE3E3] rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#FFD1D1] rounded-full translate-y-1/2 -translate-x-1/2"></div>

            <!-- Animation centrale -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-96 h-96 floating">
                    <lottie-player
                        src="https://assets2.lottiefiles.com/private_files/lf30_hxqbp1i3.json"
                        background="transparent"
                        speed="1"
                        loop
                        autoplay>
                    </lottie-player>
                </div>
            </div>

            <!-- Message inspirant -->
            <div class="absolute bottom-12 left-0 right-0 text-center">
                <p class="text-[#2F2E41] text-xl font-bold">
                    "Chaque connexion rapproche un animal <br>de son futur foyer"
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Animation subtile des inputs
    const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('transform', 'scale-105');
        });
        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('transform', 'scale-105');
        });
    });
</script>
</body>
</html>
