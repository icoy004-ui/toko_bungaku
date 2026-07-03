<!DOCTYPE html>
<html>
    <head>
        <title>Riwayat Transaksi - MyFlorist</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body class="bg-gray-50">
        @include('navbar')
        <div class="max-w-6xl mx-auto bg-white rounded-xl border border-gray-200 shadow-sm mt-9 p-6">
            <h2 class="text-xl font-bold mb-6 text-purple-900 flex items-center gap-2">
                <span class="material-icons text-purple-600">
                    history
                </span> Riwayat Transaksi
            </h2>
            
            @if ($history->isEmpty())
                <div class="text-center py-16 border border-dashed rounded-xl text-gray-400">
                    <span class="material-icons text-5xl mb-2 text-purple-300">receipt_long</span>
                    <p class="text-sm">Belum ada transaksi yang dilakukan.</p>
                </div>
            @else
                <div class="overflow-hidden rounded-xl border border-purple-100 shadow-sm">
                    <table class="w-full border-collapse bg-white text-left">
                        <thead>
                            <tr class="bg-purple-600 text-white text-sm font-semibold">
                                <th class="p-4 border-b border-purple-700">Waktu Transaksi</th>
                                <th class="p-3 border-b border-purple-700">No. Nota</th>
                                <th class="p-3 border-b border-purple-700">Daftar Item & QTY</th>
                                <th class="p-3 border-b border-purple-700">Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-200">
                            @foreach ($history as $h)
                                <tr class="hover:bg-purple-50/30 transition">
                                    <td class="p-4 text-gray-600">{{ $h->created_at->format('d M Y H:i') }} WIB</td>
                                    <td class="p-4 text-purple-700 font-semibold">{{ $h->n0_nota }}</td>
                                    <td class="p-4">
                                        <div class="flex flex-col gap-1.5">
                                            @foreach ($h->detail as $detail)
                                                <div class="bg-purple-50 text-purple-900 px-2.5 py-1 rounded-lg text-xs w-fit border border-purple-100">
                                                    {{ $detail->product->nama_barang ?? 'Produk Dihapus' }} 
                                                    <span class="text-purple-600 font-bold ml-1">x {{ $detail->qty }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="p-4 text-emerald-700 font-bold">Rp {{ number_format($h->jtotal_harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>       
    </body>       
</html>