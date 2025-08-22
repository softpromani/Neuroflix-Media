<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - NeuroflixMedia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-neuro-gold">NeuroflixMedia</a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-neuro-gold">← Back to Home</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-96 object-cover rounded-xl">
                    @else
                        <div class="w-full h-96 bg-gradient-to-r from-neuro-gold to-neuro-orange rounded-xl flex items-center justify-center">
                            <span class="text-white text-6xl font-bold">{{ substr($product->name, 0, 2) }}</span>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                    <div class="flex items-center space-x-4 mb-6">
                        @if($product->discounted_price)
                            <span class="text-4xl font-bold text-neuro-gold">
                                ₹{{ number_format($product->discounted_price, 2) }}
                            </span>
                            <span class="text-2xl text-gray-500 line-through">
                                ₹{{ number_format($product->price, 2) }}
                            </span>
                            @if($product->discount_percentage > 0)
                                <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                                    {{ $product->discount_percentage }}% OFF
                                </span>
                            @endif
                        @else
                            <span class="text-4xl font-bold text-neuro-gold">
                                ₹{{ number_format($product->price, 2) }}
                            </span>
                        @endif
                    </div>

                    <p class="text-xl text-gray-600 mb-8">{{ $product->short_description }}</p>

                    <div class="mb-8">
                        <a href="https://wa.me/+919648041515?text={{ $product->whatsapp_message }}"
                           target="_blank"
                           class="w-full bg-neuro-gold text-white px-8 py-4 rounded-xl text-xl font-bold text-center block hover:bg-neuro-orange transition duration-300">
                            🛒 Buy Now via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Long Description -->
            <div class="mt-12 border-t pt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Product Details</h2>
                <div class="prose max-w-none">
                    {!! $product->long_description !!}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
