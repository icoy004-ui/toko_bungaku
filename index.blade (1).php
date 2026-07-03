<!DOCTYPE html>
<html>
    <head>
        <title>Transaksi - MyFlorist</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body class="bg-gray-50">
        @include('navbar')
        <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl border border-gray-200 shadow-sm mt-10">
            <h1 class="text-2xl font-bold mb-5 text-purple-900 flex items-center gap-2">
                <span class="material-icons text-purple-600">
                    shopping_cart
                </span> Transaksi Baru
            </h1>
            
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2.5 rounded-xl text-sm mb-4 font-medium flex items-center gap-2">
                    <span class="material-icons text-sm">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            
            @error('qty_error')
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-2.5 rounded-xl text-sm mb-4 font-medium flex items-center gap-2">
                    <span class="material-icons text-sm">error</span>
                    {{ $message }}
                </div>
            @enderror
            
            <form action="{{ route('transactions.store') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="product_id" class="text-xs font-semibold text-gray-600 uppercase block mb-2">Pilih Produk Bunga</label>
                    <select name="product_id" class="w-full border border-gray-300 p-2.5 mb-4 rounded-xl bg-gray-50 focus:bg-white focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition text-sm" required>
                        <option value="">-- Pilih Item --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->nama_barang }} (Stok: {{ $product->stok }}) - Rp {{ number_format($product->harga,0,',','.') }}
                            </option>
                        @endforeach
                    </select>
                    
                    <label for="qty" class="text-xs font-semibold text-gray-600 uppercase block mb-2">Jumlah (Qty)</label>
                    <input type="number" name="qty" min="1" value="1" placeholder="Jumlah" class="w-full border border-gray-300 p-2.5 mb-6 rounded-xl bg-gray-50 focus:bg-white focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition text-sm" required>

                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white w-full py-3 rounded-2xl font-semibold transition shadow-sm flex items-center justify-center gap-1.5">
                        <span class="material-icons text-lg">save</span> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>