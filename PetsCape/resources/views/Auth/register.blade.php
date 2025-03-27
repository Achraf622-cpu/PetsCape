<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #FFE3E3 0%, #FFF5F5 100%);
        }
        .paw-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='52' viewBox='0 0 52 52' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M26 20.8C27.1 20.8 28 19.9 28 18.8C28 17.7 27.1 16.8 26 16.8C24.9 16.8 24 17.7 24 18.8C24 19.9 24.9 20.8 26 20.8ZM30 16.8C31.1 16.8 32 15.9 32 14.8C32 13.7 31.1 12.8 30 12.8C28.9 12.8 28 13.7 28 14.8C28 15.9 28.9 16.8 30 16.8ZM22 16.8C23.1 16.8 24 15.9 24 14.8C24 13.7 23.1 12.8 22 12.8C20.9 12.8 20 13.7 20 14.8C20 15.9 20.9 16.8 22 16.8ZM32.9 21.1C31.8 20.8 30.7 21.4 30.4 22.5C30.1 23.6 30.7 24.7 31.8 25C32.9 25.3 34 24.7 34.3 23.6C34.6 22.4 34 21.4 32.9 21.1ZM19.1 21.1C18 21.4 17.4 22.5 17.7 23.6C18 24.7 19.1 25.3 20.2 25C21.3 24.7 21.9 23.6 21.6 22.5C21.3 21.4 20.2 20.8 19.1 21.1Z' fill='%23FFB6B6' fill-opacity='0.4'/%3E%3C/svg%3E");
        }
        .custom-shape {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg paw-pattern">
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="bg-white/80 backdrop-blur-lg rounded-[2.5rem] shadow-2xl w-full max-w-6xl p-8 lg:p-0 flex flex-col lg:flex-row overflow-hidden">
        <!-- Section gauche (décorative) -->
        <div class="hidden lg:flex lg:w-5/12 relative bg-[#FFF5F5] flex-col items-center justify-center p-12">
            <div class="absolute top-0 left-0 w-64 h-64 bg-[#FFD1D1] rounded-full -translate-x-1/2 -translate-y-1/2 blur-2xl"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-[#FFE3E3] rounded-full translate-x-1/2 translate-y-1/2 blur-2xl"></div>

            <div class="relative z-10 text-center space-y-8">
                <div class="w-16 h-16 bg-[#FF6B6B] custom-shape mx-auto"></div>
                <h2 class="text-3xl font-bold text-[#2F2E41]">Rejoignez notre communauté</h2>
                <p class="text-gray-600">Créez votre compte et commencez votre voyage vers l'adoption responsable</p>

                <div class="flex flex-col gap-4 mt-8">
                    <div class="flex items-center gap-3 bg-white/80 p-4 rounded-xl">
                        <div class="w-12 h-12 bg-[#FFE3E3] rounded-full flex items-center justify-center">
                            🏠
                        </div>
                        <p class="text-sm text-[#2F2E41]">Plus de 1000 animaux ont trouvé leur foyer pour toujours</p>
                    </div>
                    <div class="flex items-center gap-3 bg-white/80 p-4 rounded-xl">
                        <div class="w-12 h-12 bg-[#FFE3E3] rounded-full flex items-center justify-center">
                            ❤️
                        </div>
                        <p class="text-sm text-[#2F2E41]">Une communauté bienveillante de passionnés d'animaux</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section droite (formulaire) -->
        <div class="lg:w-7/12 p-8 lg:p-12">
            <div class="max-w-md mx-auto space-y-8">
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-[#2F2E41] font-semibold" for="firstname">Prénom</label>
                            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" required class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none transition-colors" placeholder="Jean">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[#2F2E41] font-semibold" for="lastname">Nom</label>
                            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none transition-colors" placeholder="Dupont">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[#2F2E41] font-semibold" for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none transition-colors" placeholder="votre@email.com">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[#2F2E41] font-semibold" for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none transition-colors" placeholder="8+ caractères">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[#2F2E41] font-semibold" for="password_confirmation">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none transition-colors" placeholder="8+ caractères">
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="terms" required class="w-5 h-5 accent-[#FF6B6B]">
                        <span class="text-gray-600 text-sm">
                        J'accepte les <a href="#" class="text-[#FF6B6B] hover:text-[#FF8787]">conditions d'utilisation</a>
                        et la <a href="#" class="text-[#FF6B6B] hover:text-[#FF8787]">politique de confidentialité</a>
                    </span>
                    </label>

                    <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-all duration-300 transform hover:scale-105">
                        Créer mon compte
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600">
                    En vous inscrivant, vous rejoignez une communauté engagée pour le bien-être animal
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Animation des champs du formulaire
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('transform', 'scale-[1.02]');
        });
        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('transform', 'scale-[1.02]');
        });
    });
    // Validation du formulaire côté client
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Les mots de passe ne correspondent pas !');
            return false;
        }
    });

    // Validation basique du formulaire
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (password !== confirmPassword) {
            alert('Les mots de passe ne correspondent pas !');
            return;
        }
        // Ajoutez ici votre logique d'envoi du formulaire
    });
</script>
</body>
</html>
