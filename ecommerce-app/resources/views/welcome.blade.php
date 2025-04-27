<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Market - Votre destination shopping premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-bg {
            background-image: url('{{ asset("img/home.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        @media (max-width: 768px) {
            .hero-bg {
                background-position: 60% center;
            }
        }
    </style>
</head>
<body class="font-poppins antialiased bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-orange-500">E-Market</h1>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-orange-500 transition">Accueil</a>
                    <a href="#" class="text-gray-600 hover:text-orange-500 transition">Produits</a>
                    <a href="#" class="text-gray-600 hover:text-orange-500 transition">Catégories</a>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Rechercher un produit..."
                            class="w-64 px-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        />
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>

                    <div class="flex items-center space-x-2">
                        <a href="#" class="p-2 text-gray-600 hover:text-orange-500">
                            <i class="fas fa-shopping-cart text-xl"></i>
                        </a>
                        <a href="#" class="p-2 text-gray-600 hover:text-orange-500">
                            <i class="fas fa-heart text-xl"></i>
                        </a>
                    </div>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                                Tableau de bord
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="px-4 py-2 text-gray-600 hover:text-orange-500 transition">
                                Connexion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                                    Inscription
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-bg h-[600px] relative">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="text-white max-w-2xl">
                <h1 class="text-5xl font-bold mb-6 leading-tight">
                    Découvrez des produits incroyables à des prix imbattables
                </h1>
                <p class="text-xl mb-8 text-gray-100">
                    Achetez parmi des milliers de produits avec une livraison rapide et un paiement sécurisé.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="px-8 py-3 bg-white text-orange-500 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Acheter maintenant
                    </a>
                    <a href="#" class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-orange-500 transition">
                        En savoir plus
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Acheter par catégorie</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group cursor-pointer">
                    <div class="bg-blue-500 rounded-lg p-8 text-center transform transition duration-300 group-hover:scale-105">
                        <i class="fas fa-laptop text-white text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-white">Électronique</h3>
                    </div>
                </div>
                <div class="group cursor-pointer">
                    <div class="bg-pink-500 rounded-lg p-8 text-center transform transition duration-300 group-hover:scale-105">
                        <i class="fas fa-tshirt text-white text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-white">Mode</h3>
                    </div>
                </div>
                <div class="group cursor-pointer">
                    <div class="bg-green-500 rounded-lg p-8 text-center transform transition duration-300 group-hover:scale-105">
                        <i class="fas fa-home text-white text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-white">Maison & Déco</h3>
                    </div>
                </div>
                <div class="group cursor-pointer">
                    <div class="bg-purple-500 rounded-lg p-8 text-center transform transition duration-300 group-hover:scale-105">
                        <i class="fas fa-basketball-ball text-white text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-white">Sports</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Produits phares</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('img/still-life-with-classic-shirts-hanger.jpg') }}" alt="Produit" class="w-full h-64 object-cover transform transition duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Habit</h3>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                            <span class="ml-2 text-sm text-gray-500">(4,5)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-orange-500">199 €</span>
                            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('img/How Long Do the Appliances Last in Your Home_.jpg') }}" alt="Produit" class="w-full h-64 object-cover transform transition duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Electroménager</h3>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                            <span class="ml-2 text-sm text-gray-500">(4,5)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-orange-500">1000 €</span>
                            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('img/model-career-kit-still-life.jpg') }}" alt="Produit" class="w-full h-64 object-cover transform transition duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Escarpin/Sac</h3>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                            <span class="ml-2 text-sm text-gray-500">(4,5)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-orange-500">250 €</span>
                            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('img/scandinavian-vintage-wood-cabinet-with-chair-by-dark-blue-wall.jpg') }}" alt="Produit" class="w-full h-64 object-cover transform transition duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Meuble</h3>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                            <span class="ml-2 text-sm text-gray-500">(4,5)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-orange-500">2500 €</span>
                            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Répéter pour  produits -->
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-orange-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Inscrivez-vous à notre newsletter</h2>
            <p class="text-white mb-8">Recevez les dernières nouveautés et promotions</p>
            <div class="max-w-md mx-auto">
                <div class="flex">
                    <input
                        type="email"
                        placeholder="Entrez votre email"
                        class="flex-1 px-4 py-3 rounded-l-lg focus:outline-none"
                    />
                    <button class="px-6 py-3 bg-gray-900 text-white rounded-r-lg hover:bg-gray-800 transition">
                        S&#39;inscrire
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-orange-500 mb-4">E-Market</h3>
                    <p class="text-gray-400">Votre destination premium pour des produits de qualité et un service exceptionnel.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">FAQs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Politique de livraison</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Service client</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Mon compte</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Suivi de commande</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Liste de souhaits</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-orange-500 transition">Retours</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 E-Market. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
