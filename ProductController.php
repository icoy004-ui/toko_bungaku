<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //tampilkan products:
        $products = \App\Models\Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //menyimpan data:
        $request->validate(
            [
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
            ]
        );
        \App\Models\Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update product:
        $request->validate(
            [
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
            ]
        );
        //cari product berdasarkan ID
        $product = \App\Models\Product::findOrFail($id);
        //update data product
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data berdasarkan ID
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    //fungsi download pdf
    public function downloadPdf()
    {
        $products = \App\Models\product::all();
        $pdf = Pdf::loadView('products/product_pdf', compact('products'));
        return $pdf->download('Laporan Data Product MyFlorist.pdf');
    }
}
