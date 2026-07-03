<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\transaction;
use App\Models\transaction_detail;

class TransactionController extends Controller
{
    //tampilan from transaksi
    public function index(){
        $products = product::where([['stok', '>', 0]])->get();
        return view('transactions.index', compact('products'));
    }
    public function history(){
        $history = transaction::with('detail.product')->latest()->get();
        return view('transactions.history', compact('history'));
    }
    public function store(Request $request){
        $request->validate(
            [
                'product_id' => 'required|exists:products,id',
                'qty' => 'required|numeric|min:1',
            ]
        );

        //ambil product berdasarkan product_id
        $product = product::findOrFail($request->product_id);
    
        if ( $product->stok < $request->qty ) {
            return back()->withErrors(['qty_error' => 'Stok tidak mencukupi.']);
        }
    
        // eksekusi simpan transaksi menggunakan DB::transaction untuk memastikan integritas data
        DB::transaction(function() use ($request, $product) {
            // create data transaksi
            $subtotal = $product->harga * $request->qty;
            $no_nota = 'TRX - '. strtoupper(uniqid());

            $transaction = transaction::create([
                'n0_nota' => $no_nota,
                'jtotal_harga' => $subtotal,
            ]);

            // create data transaction detail
            transaction_detail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'harga_satuan' => $product->harga,
                'subtotal' => $subtotal,
            ]);

            //potong stok product
            $product->decrement('stok', $request->qty);
        });
        
        return redirect()->route('transactions.index')->with('success', 'Transaction completed successfully.');
    }
}
