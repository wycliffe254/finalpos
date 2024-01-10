<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Constructor and other methods remain unchanged...
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        //$this->middleware('adminonly');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = Product::query();
    
        if (!empty($search)) {
            $products->where(function ($query) use ($search) {
                $query->where('product_name', 'LIKE', '%' . $search . '%')
                      ->orWhere('brand', 'LIKE', '%' . $search . '%');
            });
        }
    
        $products = $products->paginate(5);
    
        return view('products.index', compact('products'));
    }
    

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'brand' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);
    
        $existingProduct = Product::where('product_name', $validatedData['product_name'])
            ->where('brand', $validatedData['brand'])
            ->first();
    
        if ($existingProduct) {
            // If the product with the same name and brand already exists,
            // update its quantity and price if the provided price is different
            if ($existingProduct->price != $validatedData['price']) {
                $existingProduct->price = $validatedData['price'];
            }
            $existingProduct->quantity += $validatedData['quantity'];
            $existingProduct->save();
    
            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        }
    
        // If the product doesn't exist with the same name and brand, create a new one
        $product = Product::create($validatedData);
    
        if ($product) {
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        }
    
        return redirect()->back()->with('error', 'Product creation failed');
    }
    
    
    

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'brand' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);

        // Update product details
        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
