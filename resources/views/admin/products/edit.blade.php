<x-admin-layout>
    <x-slot:header>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Produk</h2>
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-800 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>
    </x-slot:header>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Produk</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}" required placeholder="e.g. Aplikasi Kasir Restaurant" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <input type="text" name="category" value="{{ old('category', $product->category) }}" placeholder="e.g. Website, Aplikasi Desktop, Mobile" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
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
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea name="description" rows="5" placeholder="Jelaskan tentang produk ini..." class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $product->description) }}</textarea>
                                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Fitur Produk</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fitur <span class="text-gray-400 text-xs">(satu per baris)</span></label>
                            <textarea name="features" rows="6" placeholder="Fitur 1&#10;Fitur 2&#10;Fitur 3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 font-mono text-sm">{{ old('features', $product->features ? implode("\n", $product->features) : '') }}</textarea>
                            @error('features')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Konten / Review Produk</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi panjang <span class="text-gray-400 text-xs">(gambar, teks, tabel — bebas)</span></label>
                            <textarea name="content" id="editor" rows="12" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('content', $product->content) }}</textarea>
                            @error('content')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Gambar Thumbnail</h3>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-indigo-400 transition cursor-pointer" id="image-dropzone">
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

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Galeri Produk</h3>

                        @if($product->images)
                            <div class="grid grid-cols-3 gap-3 mb-4" id="existing-gallery">
                                @foreach($product->images as $i => $img)
                                    <div class="relative group">
                                        <img src="{{ Storage::url($img) }}" class="w-full h-28 object-cover rounded-lg border border-gray-200">
                                        <a href="{{ route('admin.products.deleteImage', [$product, $i]) }}" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition" onclick="return confirm('Hapus gambar ini?')">&times;</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition cursor-pointer" id="gallery-dropzone">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-gray-500">Klik untuk tambah gambar baru</p>
                            <p class="text-xs text-gray-400 mt-1">Bisa pilih beberapa gambar sekaligus</p>
                            <input type="file" name="images[]" accept="image/jpeg,image/png,image/webp" class="hidden" id="gallery-input" multiple>
                        </div>
                        <div id="gallery-previews" class="grid grid-cols-3 gap-3 mt-4"></div>
                        @error('images.*')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="sr-only peer" id="is_active">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700" id="status-label">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </label>
                        <p class="text-xs text-gray-400 mt-2">Nonaktifkan untuk menyembunyikan produk dari toko</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            Update Produk
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="w-full block text-center mt-2 border border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
                img.className = 'w-full h-28 object-cover rounded-lg border border-gray-200';
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
