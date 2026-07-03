<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Produk MyFlorist</title>
        <style>
            @page {
                margin: 40px 50px;
            }
            body {
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 11px;
                color: #2c3e50;
                line-height: 1.5;
            }
            /* Desain Header Kreatif */
            .header-container {
                width: 100%;
                margin-bottom: 25px;
                padding-bottom: 15px;
                border-bottom: 2px dashed #a78bfa; 
            }
            .brand-name {
                font-size: 24px;
                font-weight: bold;
                color: #5b21b6; /* Diubah menjadi warna Ungu Gelap */
                letter-spacing: 1px;
            }
            .report-title {
                font-size: 14px;
                font-weight: bold;
                color: #4b5563;
                text-transform: uppercase;
                margin-top: 5px;
            }
            .meta-info {
                float: right;
                text-align: right;
                color: #6b7280;
                font-size: 10px;
                margin-top: -35px;
            }

            /* Kartu Ringkasan Data (Insight) */
            .summary-box {
                margin-bottom: 25px;
                width: 100%;
            }
            .card {
                background-color: #f3e8ff; 
                border-left: 4px solid #8b5cf6;
                padding: 10px 15px;
                display: inline-block;
                width: 30%;
                border-radius: 4px;
            }
            .card-title {
                font-size: 9px;
                color: #6b7280;
                text-transform: uppercase;
                font-weight: bold;
            }
            .card-value {
                font-size: 16px;
                font-weight: bold;
                color: #4c1d95;
            }

            /* Desain Tabel Modern */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }
            th {
                background-color: #6d28d9; /* Warna Utama Ungu */
                color: #ffffff;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 10px;
                border: 1px solid #6d28d9;
                padding: 10px 8px;
                text-align: left;
            }
            td {
                border-bottom: 1px solid #e5e7eb;
                padding: 10px 8px;
                color: #374151;
            }
            tr:nth-child(even) {
                background-color: #f9fafb; /* Baris selang-seling */
            }
            
            /* Penanda khusus (Badge) jika stok tipis */
            .badge-warning {
                background-color: #fef3c7;
                color: #d97706;
                padding: 2px 6px;
                border-radius: 10px;
                font-weight: bold;
                font-size: 10px;
            }
            .badge-safe {
                background-color: #d1fae5;
                color: #059669;
                padding: 2px 6px;
                border-radius: 10px;
                font-size: 10px;
            }

            /* Utilitas Teks */
            .text-center { text-align: center; }
            .text-right { text-align: right; }
            .font-bold { font-weight: bold; }

            /* Bagian Tanda Tangan */
            .footer-sign {
                margin-top: 50px;
                width: 100%;
            }
            .sign-space {
                float: right;
                text-align: center;
                width: 200px;
            }
            .sign-line {
                margin-top: 60px;
                border-top: 1px solid #4b5563;
                padding-top: 5px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        
        <div class="header-container">
            <div class="brand-name">MyFlorist 🌸</div>
            <div class="report-title">Laporan Data Stok Produk</div>
            <div class="meta-info">
                Tanggal Cetak: {{ now()->format('d F Y') }}<br>
                Oleh: Admin Florist
            </div>
        </div>

        <div class="summary-box">
            <div class="card">
                <div class="card-title">Total Varian Bunga</div>
                <div class="card-value">{{ count($products) }} Item</div>
            </div>
            <div class="card" style="margin-left: 15px; background-color: #ecfdf5; border-left-color: #10b981;">
                <div class="card-title" style="color: #065f46;">Total Akumulasi Stok</div>
                <div class="card-value" style="color: #065f46;">{{ $products->sum('stok') }} Pcs</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 5%" class="text-center">No</th>
                    <th style="width: 30%">Nama Produk Bunga</th>
                    <th style="width: 20%" class="text-right">Harga Satuan</th>
                    <th style="width: 12%" class="text-center">Stok</th>
                    <th style="width: 33%">Deskripsi Karakteristik</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <td class="text-center" style="color: #6b7280;">{{ $key + 1 }}</td>
                        <td class="font-bold" style="color: #1e1b4b;">{{ $product->nama_barang }}</td>
                        <td class="text-right font-bold">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($product->stok <= 10)
                                <span class="badge-warning">{{ $product->stok }} (Tipis)</span>
                            @else
                                <span class="badge-safe">{{ $product->stok }}</span>
                            @endif
                        </td>
                        <td style="color: #4b5563; font-style: italic;">{{ $product->deskripsi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer-sign">
            <div class="sign-space">
                <div>Jakarta, {{ now()->format('d F Y') }}</div>
                <div style="margin-top: 5px; color: #6b7280;">Manajer Operasional</div>
                <div class="sign-line">Admin Florist</div>
            </div>
        </div>

    </body>
</html>