<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Product
            </h2>
            <a href="{{ route('admin.products.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-200">
                ← Back to Products
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Name -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-neuro-gold focus:outline-none @error('name') border-red-500 @enderror"
                                       placeholder="Enter product name">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Original Price (₹) *</label>
                                <input type="number"
                                       name="price"
                                       id="price"
                                       value="{{ old('price') }}"
                                       step="0.01"
                                       min="0"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-neuro-gold focus:outline-none @error('price') border-red-500 @enderror"
                                       placeholder="0.00">
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discounted Price -->
                            <div>
                                <label for="discounted_price" class="block text-sm font-medium text-gray-700 mb-2">Discounted Price (₹)</label>
                                <input type="number"
                                       name="discounted_price"
                                       id="discounted_price"
                                       value="{{ old('discounted_price') }}"
                                       step="0.01"
                                       min="0"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-neuro-gold focus:outline-none @error('discounted_price') border-red-500 @enderror"
                                       placeholder="0.00">
                                @error('discounted_price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Leave blank if no discount</p>
                            </div>

                            <!-- Product Image -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-neuro-gold transition duration-200">
                                    <input type="file"
                                           name="image"
                                           id="image"
                                           accept="image/*"
                                           class="hidden"
                                           onchange="previewImage(event)">
                                    <div id="image-preview" class="hidden mb-4">
                                        <img id="preview-img" src="" alt="Preview" class="max-w-xs max-h-48 mx-auto rounded-lg">
                                    </div>
                                    <label for="image" class="cursor-pointer">
                                        <div class="text-gray-400 text-4xl mb-2">📷</div>
                                        <p class="text-gray-600">Click to upload image</p>
                                        <p class="text-xs text-gray-400">JPG, PNG, GIF up to 2MB</p>
                                    </label>
                                </div>
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Short Description -->
                            <div class="md:col-span-2">
                                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Short Description *</label>
                                <textarea name="short_description"
                                          id="short_description"
                                          rows="3"
                                          maxlength="500"
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-neuro-gold focus:outline-none @error('short_description') border-red-500 @enderror"
                                          placeholder="Brief description for product cards...">{{ old('short_description') }}</textarea>
                                <div class="flex justify-between">
                                    @error('short_description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @else
                                        <p class="text-xs text-gray-500 mt-1">Maximum 500 characters</p>
                                    @enderror
                                    <span id="short-desc-count" class="text-xs text-gray-400">0/500</span>
                                </div>
                            </div>

                            <!-- Long Description -->
                            <div class="md:col-span-2">
                                <label for="long_description" class="block text-sm font-medium text-gray-700 mb-2">Detailed Description *</label>
                                <textarea name="long_description"
                                          id="long_description"
                                          rows="10"
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-neuro-gold focus:outline-none @error('long_description') border-red-500 @enderror">{{ old('long_description') }}</textarea>
                                @error('long_description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Detailed product information with rich formatting</p>
                            </div>

                            <!-- Status Options -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox"
                                               name="is_active"
                                               value="1"
                                               {{ old('is_active', true) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-neuro-gold focus:border-neuro-gold focus:ring-neuro-gold">
                                        <span class="ml-2 text-sm text-gray-700">Active (visible on website)</span>
                                    </label>
                                    {{-- <label class="flex items-center">
                                        <input type="checkbox"
                                               name="is_featured"
                                               value="1"
                                               {{ old('is_featured') ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-neuro-gold focus:border-neuro-gold focus:ring-neuro-gold">
                                        <span class="ml-2 text-sm text-gray-700">Featured product</span>
                                    </label> --}}
                                </div>
                            </div>

                            <!-- Sort Order -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                                <input type="number"
                                       name="sort_order"
                                       id="sort_order"
                                       value="{{ old('sort_order', 0) }}"
                                       min="0"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-neuro-gold focus:outline-none @error('sort_order') border-red-500 @enderror">
                                @error('sort_order')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.products.index') }}"
                               class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="bg-neuro-gold text-white px-6 py-2 rounded-lg hover:bg-neuro-orange transition duration-200"
                                    id="submit-btn">
                                Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @push('scripts') --}}

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#long_description'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });

        // Image preview function
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        // Character count for short description
        const shortDesc = document.getElementById('short_description');
        const shortDescCount = document.getElementById('short-desc-count');

        shortDesc.addEventListener('input', function() {
            const count = this.value.length;
            shortDescCount.textContent = `${count}/500`;

            if (count > 450) {
                shortDescCount.classList.add('text-orange-600');
            } else if (count > 500) {
                shortDescCount.classList.add('text-red-600');
            } else {
                shortDescCount.classList.remove('text-orange-600', 'text-red-600');
            }
        });

        // Update character count on page load
        shortDesc.dispatchEvent(new Event('input'));

        // Form validation
        document.getElementById('product-form').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.textContent = 'Creating...';
            submitBtn.disabled = true;
        });
    </script>
{{--
    @endpush --}}
</x-app-layout>
