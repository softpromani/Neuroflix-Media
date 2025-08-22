<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-neuro-gold bg-opacity-20">
                            <svg class="w-8 h-8 text-neuro-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Total Products</h3>
                            <p class="text-3xl font-bold text-neuro-gold">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Active Products</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $activeProducts }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                            <div class="mt-4 space-y-2">
                                <a href="{{ route('admin.products.create') }}"
                                   class="block bg-neuro-gold text-white px-4 py-2 rounded text-center hover:bg-neuro-orange transition duration-200">
                                    Add Product
                                </a>
                                <a href="{{ route('admin.products.index') }}"
                                   class="block bg-gray-600 text-white px-4 py-2 rounded text-center hover:bg-gray-700 transition duration-200">
                                    Manage Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Products -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Products</h3>
                </div>
                <div class="p-6">
                    @if($recentProducts->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentProducts as $product)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="w-12 h-12 object-cover rounded-lg">
                                        @else
                                            <div class="w-12 h-12 bg-neuro-gold rounded-lg flex items-center justify-center">
                                                <span class="text-white font-bold text-sm">{{ substr($product->name, 0, 2) }}</span>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <h4 class="font-semibold text-gray-900">{{ $product->name }}</h4>
                                            <p class="text-sm text-gray-600">
                                                ₹{{ number_format($product->discounted_price ?? $product->price, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="text-neuro-gold hover:text-neuro-orange">Edit</a>
                                        <a href="{{ route('admin.products.show', $product) }}"
                                           class="text-gray-600 hover:text-gray-800">View</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No products created yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
