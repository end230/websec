<?php
namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;

class ProductsController extends Controller {

	use ValidatesRequests;

	public function __construct()
    {
        $this->middleware('auth:web')->except('list');
    }

	public function list(Request $request) {

		$query = Product::select("products.*");

		$query->when($request->keywords, 
		fn($q)=> $q->where("name", "like", "%$request->keywords%"));

		$query->when($request->min_price, 
		fn($q)=> $q->where("price", ">=", $request->min_price));
		
		$query->when($request->max_price, fn($q)=> 
		$q->where("price", "<=", $request->max_price));
		
		$query->when($request->order_by, 
		fn($q)=> $q->orderBy($request->order_by, $request->order_direction??"ASC"));

		$products = $query->get();

		return view('products.list', compact('products'));
	}

	public function edit(Request $request, Product $product = null) {

		if(!auth()->user() || !auth()->user()->hasAnyRole(['Admin', 'Employee'])) {
			abort(401, 'Unauthorized');
		}

		$product = $product??new Product();

		return view('products.edit', compact('product'));
	}

	public function save(Request $request, Product $product = null) {

		if(!auth()->user() || !auth()->user()->hasAnyRole(['Admin', 'Employee'])) {
			abort(401, 'Unauthorized');
		}

		$this->validate($request, [
	        'code' => ['required', 'string', 'max:32'],
	        'name' => ['required', 'string', 'max:128'],
	        'model' => ['required', 'string', 'max:256'],
	        'description' => ['required', 'string', 'max:1024'],
	        'price' => ['required', 'numeric'],
	    ]);

		$product = $product??new Product();
		$product->fill($request->all());
		$product->save();

		return redirect()->route('products_list');
	}

	public function delete(Request $request, Product $product) {

		if(!auth()->user() || !auth()->user()->hasAnyRole(['Admin', 'Employee'])) {
			abort(401, 'Unauthorized');
		}

		$product->delete();

		return redirect()->route('products_list');
	}
// buy function
	public function buy(Request $request, Product $product)
	{
		if(!auth()->check()) {
			return redirect()->route('login');
		}

		$user = auth()->user();

		// Check if user has enough credits
		if(!$user->credit || $user->credit < $product->price) {
			return redirect()->back()->with('error', 'Not enough credits to buy this product');
		}

		// Check if product is in stock
		if($product->stock <= 0) {
			return redirect()->back()->with('error', 'Product is out of stock');
		}

		// Start transaction
		DB::beginTransaction();
		try {
			// Deduct credits from user
			$user->credit -= $product->price;
			$user->save();

			// Reduce product stock
			$product->stock -= 1;
			$product->save();

			// Record the purchase
			Purchase::create([
				'user_id' => $user->id,
				'product_id' => $product->id,
				'price' => $product->price,
				'purchased_at' => now()
			]);

			DB::commit();
			return redirect()->back()->with('success', 'Product purchased successfully!');
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with('error', 'An error occurred during the purchase');
		}
	}

	// purchases
	public function myPurchases(Request $request)
	{
		if(!auth()->check()) {
			return redirect()->route('login');
		}

		$purchases = auth()->user()->purchases()->with('product')->latest()->get();
		return view('products.purchases', compact('purchases'));
	}

	public function hold(Request $request, Product $product)
	{
		if(!auth()->user()->hasRole(['Employee','Admin']) ) {
			abort(401, 'Unauthorized');
		}

		$product->hold = true;
		$product->save();

		return redirect()->back()->with('success', 'Product is now on hold.');
	}

	public function unhold(Request $request, Product $product)
	{
		if(!auth()->user()->hasRole(['Employee','Admin'])) {
			abort(401, 'Unauthorized');
		}

		$product->hold = false;
		$product->save();

		return redirect()->back()->with('success', 'Product is now available.');
	}
} 