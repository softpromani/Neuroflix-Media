<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeuroflixMedia - AI Platform Subscriptions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-neuro-gold">NeuroflixMedia</h1>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-neuro-gold">Admin</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-neuro-gold">Logout</button>
                        </form>
                    @else
                        {{-- <a href="{{ route('login') }}" class="text-gray-700 hover:text-neuro-gold">Login</a> --}}
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-neuro-gold to-neuro-orange text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Power Your Content with AI
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                Premium AI platform subscriptions for YouTubers and creators. Get access to Gemini Pro, ElevenLabs, and more at discounted prices.
            </p>
            <a href="#products" class="bg-white text-neuro-gold px-8 py-3 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300">
                Explore Products
            </a>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Our AI Platforms
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Choose from our curated selection of premium AI tools and platforms
                </p>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover rounded-t-xl">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-neuro-gold to-neuro-orange rounded-t-xl flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ substr($product->name, 0, 2) }}</span>
                                </div>
                            @endif

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $product->name }}</h3>

                                <div class="flex items-center space-x-2 mb-4">
                                    @if($product->discounted_price)
                                        <span class="text-2xl font-bold text-neuro-gold">
                                            ₹{{ number_format($product->discounted_price, 2) }}
                                        </span>
                                        <span class="text-lg text-gray-500 line-through">
                                            ₹{{ number_format($product->price, 2) }}
                                        </span>
                                        @if($product->discount_percentage > 0)
                                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded">
                                                {{ $product->discount_percentage }}% OFF
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-2xl font-bold text-neuro-gold">
                                            ₹{{ number_format($product->price, 2) }}
                                        </span>
                                    @endif
                                </div>

                                <p class="text-gray-600 mb-6">{{ $product->short_description }}</p>

                                <div class="flex space-x-3">
                                    <a href="{{ route('products.show', $product) }}"
                                       class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-center font-semibold hover:bg-gray-200 transition duration-300">
                                        View Details
                                    </a>
                                    <a href="https://wa.me/+919807371859?text={{ $product->whatsapp_message }}"
                                       target="_blank"
                                       class="flex-1 bg-neuro-gold text-white px-4 py-2 rounded-lg text-center font-semibold hover:bg-neuro-orange transition duration-300">
                                        Buy Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">📦</div>
                    <h3 class="text-2xl font-semibold text-gray-600 mb-2">No Products Available</h3>
                    <p class="text-gray-500">Products will appear here once they are added by the admin.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold text-neuro-gold mb-4">NeuroflixMedia</h3>
                <p class="text-gray-300 mb-6">
                    Empowering creators with premium AI platform subscriptions
                </p>
                <p class="text-gray-400">
                    © {{ date('Y') }} NeuroflixMedia. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
