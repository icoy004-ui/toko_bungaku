<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Produk - MyFlorist</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
         <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="p-4 bg-gray-50">
        @include('navbar')
        
        <div class="flex gap-2 mb-5 mt-4">
            <button type="button" onclick="toggle_modal()" class="bg-purple-600 text-white px-4 py-2 rounded-2xl hover:bg-purple-700 transition font-medium shadow-sm"> + Tambah Item</button>
            <a href="{{ route('products.pdf') }}" class="bg-rose-600 text-white px-4 py-2 rounded-2xl font-medium flex items-center gap-1 hover:bg-rose-700 transition shadow-sm">
                <span class="material-icons text-sm">picture_as_pdf</span>Simpan sebagai pdf   
            </a>
        </div>
        
        <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
            <table class="table-auto w-full text-left border-collapse bg-white">
                <thead>
                    <tr class="bg-purple-600 text-white text-sm font-semibold">
                        <th class="p-3 border-b border-purple-700">Nama Item</th>
                        <th class="p-3 border-b border-purple-700">Harga</th>
                        <th class="p-3 border-b border-purple-700">Stok</th>
                        <th class="p-3 border-b border-purple-700">Deskripsi</th>
                        <th class="p-3 border-b border-purple-700 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr class="hover:bg-purple-50/50 transition">
                            <td class="p-3 font-medium text-gray-900">{{ $product->nama_barang }}</td>
                            <td class="p-3 text-gray-700">Rp {{ number_format($product->harga,0,',','.') }}</td>
                            <td class="p-3 text-gray-700">
                                @if($product->stok <= 10)
                                    <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-semibold">{{ $product->stok }} (Tipis)</span>
                                @else
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">{{ $product->stok }}</span>
                                @endif
                            </td>
                            <td class="p-3 text-gray-500 italic">{{ $product->deskripsi }}</td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    <button onclick='toggle_modal_edit(@json($product))' class="text-purple-600 hover:text-purple-900 font-medium transition">
                                        <span class="material-icons">edit</span>
                                    </button>
                                    <button onclick="if(confirm('Yakin ingin menghapus item ini?')) {document.getElementById('form-delete{{ $product->id }}').submit();}" class="text-rose-600 hover:text-rose-900 font-medium transition">
                                        <span class="material-icons">delete</span>
                                    </button>
                                    <form id="form-delete{{ $product->id }}" action="{{ route('products.destroy',$product->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- modal tambah: --}}
        <div id="modal-tambah-item" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-6 rounded-2xl shadow-xl w-96 transform transition-all">
                <h2 class="text-xl font-bold mb-4 text-purple-900">Tambah Item Baru</h2>
                <form action="{{ route('products.store')}}" method="post">
                    @csrf
                        <label for="nama_barang" class="text-xs font-semibold text-gray-600 uppercase">Nama Barang:</label>
                        <input type="text" name="nama_barang" class="w-full border border-gray-300 p-2 mb-3 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500" required>
                        
                        <label for="harga" class="text-xs font-semibold text-gray-600 uppercase">Harga:</label>
                        <input type="number" name="harga" class="w-full border border-gray-300 p-2 mb-3 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500" required>
                        
                        <label for="stok" class="text-xs font-semibold text-gray-600 uppercase">Stok:</label>
                        <input type="number" name="stok" class="w-full border border-gray-300 p-2 mb-3 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500" required>
                        
                        <label for="deskripsi" class="text-xs font-semibold text-gray-600 uppercase">Deskripsi:</label>
                        <textarea name="deskripsi" class="w-full border border-gray-300 p-2 mb-3 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500" required></textarea>
                        
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" onclick="toggle_modal()" class="text-gray-500 hover:text-gray-700 font-medium">Batal</button>
                        <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded-2xl hover:bg-purple-700 transition shadow-sm font-medium">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- modal edit: --}}
        <div id="modal-edit-item" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-6 rounded-2xl shadow-xl w-96 transform transition-all">
                <h2 class="text-xl font-bold mb-4 text-purple-900">Edit Item</h2>
                <form id="form-edit" method="post">
                    @csrf
                    @method('PUT')
                        <label for="nama_barang" class="text-xs font-semibold text-gray-600 uppercase">Nama Barang:</label>
                        <input type="text" id="edit_nama_barang" name="nama_barang" class="w-full border border-gray-300 p-2 mb-3 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500" required>
                        
                        <label for="harga" class="text-xs font-semibold text-gray-600 uppercase">Harga:</label>
                        <input type="number" id="edit_harga" name="harga" class="w-full border border-gray-300 p-2 mb-3 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500" required>
                        
                        <label for="stok" class="text-xs font-semibold text-gray-600 uppercase">Stok:</label>
                        <input type="number" id="edit_stok" name="stok" class="w-full border border-gray-300 p-2 mb-3 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500" required>
                        
                        <label for="deskripsi" class="text-xs font-semibold text-gray-600 uppercase">Deskripsi:</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="w-full border border-gray-300 p-2 mb-3 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500" required></textarea>
                        
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" onclick="document.getElementById('modal-edit-item').classList.replace('flex','hidden')" class="text-gray-500 hover:text-gray-700 font-medium">Batal</button>
                        <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded-2xl hover:bg-purple-700 transition shadow-sm font-medium">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function toggle_modal() {
                const modal = document.getElementById('modal-tambah-item');
                modal.classList.toggle('hidden');
                modal.classList.toggle('flex');
            }
            function toggle_modal_edit(item) {
                const modal = document.getElementById('modal-edit-item');

                //mengatur route pada action form secara dinamis
                document.getElementById('form-edit').action = '/products/' + item.id;

                //mengisi value input form dengan data item yang dipilih:
                document.getElementById('edit_nama_barang').value = item.nama_barang;
                document.getElementById('edit_harga').value = item.harga;
                document.getElementById('edit_stok').value = item.stok;
                document.getElementById('edit_deskripsi').value = item.deskripsi;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        </script>
    </body>
</html>