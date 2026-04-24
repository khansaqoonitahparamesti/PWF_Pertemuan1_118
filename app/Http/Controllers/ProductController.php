<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // <--- WAJIB ADA JIKA PAKAI Auth::...
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

// Import Facades agar bisa dipanggil langsung
use Illuminate\Support\Facades\Log; 


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
    // 1. Validasi data (biar gak kosong)
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'qty' => 'required|numeric',
    ],[
        'name.required' => 'Nama produk wajib diisi.',
        'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

        'qty.required' => 'Jumlah (kuantitas) produk wajib diisi.',
        'qty.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',

        'price.required' => 'Harga produk wajib diisi.',
        'price.numeric' => 'Harga produk harus berupa angka yang valid.',
    ]);

    $validated['user_id'] = Auth::id();

    try {
        Product::create($validated);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product created successfully.');
            
    } catch (QueryException $e) {
        Log::error('Product store database error', [
            'message' => $e->getMessage(),
        ]);

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Database error while creating product.');
    } catch (\Throwable $e) {
        Log::error('Product store unexpected error', [
            'message' => $e->getMessage(),
        ]);

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Unexpected error occurred.');
    }

    // 2. Simpan data + masukin ID user yang lagi login
    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'qty' => $request->qty,
        'user_id' => auth()->id(), // <--- INI KUNCINYA! Biar user_id gak kosong
    ]);

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambah!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success','Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success','Product deleted');
    }

        public function export()
    {
        return "Halaman Export Berhasil Diakses oleh Admin!";
    }

    
        
}

// public function store(Request $request)
// {
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'quantity' => 'required|integer',
//         'price' => 'required|numeric',
//     ], [
//         'name.required' => 'Nama produk wajib diisi.',
//         'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

//         'quantity.required' => 'Jumlah (kuantitas) produk wajib diisi.',
//         'quantity.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',

//         'price.required' => 'Harga produk wajib diisi.',
//         'price.numeric' => 'Harga produk harus berupa angka yang valid.',
//     ]);

//     $validated['user_id'] = Auth::id();

//     try {
//         Product::create($validated);

//         return redirect()
//             ->route('product.index')
//             ->with('success', 'Product created successfully.');
//     } catch (QueryException $e) {
//         Log::error('Product store database error', [
//             'message' => $e->getMessage(),
//         ]);

//         return redirect()
//             ->back()
//             ->withInput()
//             ->with('error', 'Database error while creating product.');
//     } catch (\Throwable $e) {
//         Log::error('Product store unexpected error', [
//             'message' => $e->getMessage(),
//         ]);

//         return redirect()
//             ->back()
//             ->withInput()
//             ->with('error', 'Unexpected error occurred.');
//     }
// }