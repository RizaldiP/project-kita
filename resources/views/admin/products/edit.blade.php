<x-admin-layout>
    <x-slot:header>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Produk</h2>
                    <p class="text-sm text-gray-500">{{ $product->name }}</p>
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-800 text-sm flex items-center gap-1 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>
    </x-slot:header>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PATCH')
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-indigo-600">
                        <h3 class="font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Informasi Produk
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required placeholder="e.g. Aplikasi Kasir Restaurant" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="category" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Pilih kategori...</option>
                                    <option value="Website Laravel" @selected(old('category', $product->category) == 'Website Laravel')>Website Laravel</option>
                                    <option value="Python" @selected(old('category', $product->category) == 'Python')>Python</option>
                                    <option value="Program C" @selected(old('category', $product->category) == 'Program C')>Program C</option>
                                    <option value="Code Igniter" @selected(old('category', $product->category) == 'Code Igniter')>Code Igniter</option>
                                    <option value="Java" @selected(old('category', $product->category) == 'Java')>Java</option>
                                </select>
                                @error('category')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required step="0.01" min="0" placeholder="0" class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                            <textarea name="description" rows="3" placeholder="Jelaskan tentang produk ini..." class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $product->description) }}</textarea>
                            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600">
                        <h3 class="font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            Fitur Produk
                        </h3>
                    </div>
                    <div class="p-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fitur <span class="text-gray-400 text-xs">(satu per baris)</span></label>
                        <textarea name="features" rows="5" placeholder="Fitur 1&#10;Fitur 2&#10;Fitur 3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 font-mono text-sm">{{ old('features', $product->features ? implode("\n", $product->features) : '') }}</textarea>
                        @error('features')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-violet-500 to-violet-600">
                        <h3 class="font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            Konten / Review Produk
                        </h3>
                    </div>
                    <div class="p-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi panjang <span class="text-gray-400 text-xs">(gambar, teks, tabel — bebas)</span></label>
                        <textarea name="content" id="editor" rows="12" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('content', $product->content) }}</textarea>
                        @error('content')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-amber-500 to-amber-600">
                        <h3 class="font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Gambar Thumbnail
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-amber-400 transition cursor-pointer" id="image-dropzone">
                            <div id="image-placeholder" class="{{ $product->image ? 'hidden' : '' }}">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-sm text-gray-500">Klik untuk upload thumbnail</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 2MB</p>
                            </div>
                            <img id="image-preview" class="{{ $product->image ? 'w-full rounded-lg object-cover max-h-48' : 'hidden' }}" src="{{ $product->image ? Storage::url($product->image) : '' }}">
                            <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="hidden" id="image-input">
                        </div>
                        @error('image')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-rose-500 to-rose-600">
                        <h3 class="font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Galeri Produk
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($product->images)
                            <div class="grid grid-cols-2 gap-2 mb-4" id="existing-gallery">
                                @foreach($product->images as $i => $img)
                                    <div class="relative group">
                                        <img src="{{ Storage::url($img) }}" class="w-full h-24 object-cover rounded-lg border border-gray-200">
                                        <a href="{{ route('admin.products.deleteImage', [$product, $i]) }}" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition" onclick="return confirm('Hapus gambar ini?')">&times;</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-rose-400 transition cursor-pointer" id="gallery-dropzone">
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-gray-500">Klik untuk tambah gambar baru</p>
                            <p class="text-xs text-gray-400 mt-1">Bisa pilih beberapa gambar sekaligus</p>
                            <input type="file" name="images[]" accept="image/jpeg,image/png,image/webp" class="hidden" id="gallery-input" multiple>
                        </div>
                        <div id="gallery-previews" class="grid grid-cols-2 gap-2 mt-4"></div>
                        @error('images.*')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-cyan-500 to-cyan-600">
                        <h3 class="font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="sr-only peer" id="is_active">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-cyan-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-cyan-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700" id="status-label">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </label>
                        <p class="text-xs text-gray-400 mt-2">Nonaktifkan untuk menyembunyikan produk dari toko</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-sm p-6">
                    <button type="submit" class="w-full bg-white text-indigo-700 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Update Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="w-full block text-center mt-3 text-white/80 hover:text-white py-2 text-sm transition">Batal</a>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@latest/dist/ckeditor.min.js"></script>
    <script>
        const dropzone = document.getElementById('image-dropzone');
        const imageInput = document.getElementById('image-input');
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');

        dropzone.addEventListener('click', () => imageInput.click());
        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    preview.src = ev.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        const galleryDropzone = document.getElementById('gallery-dropzone');
        const galleryInput = document.getElementById('gallery-input');
        const galleryPreviews = document.getElementById('gallery-previews');

        galleryDropzone.addEventListener('click', () => galleryInput.click());
        galleryInput.addEventListener('change', (e) => {
            Array.from(e.target.files).forEach((file) => {
                const reader = new FileReader();
                const wrapper = document.createElement('div');
                wrapper.className = 'relative group';
                const img = document.createElement('img');
                img.className = 'w-full h-24 object-cover rounded-lg border border-gray-200';
                wrapper.appendChild(img);
                galleryPreviews.appendChild(wrapper);
                reader.onload = (ev) => { img.src = ev.target.result; };
                reader.readAsDataURL(file);
            });
        });

        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'bulletedList', 'numberedList', '|',
                        'alignment', '|',
                        'link', 'imageUpload', 'blockQuote', 'insertTable', '|',
                        'undo', 'redo', '|',
                        'sourceEditing'
                    ]
                },
                image: {
                    toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    @endpush
</x-admin-layout>
