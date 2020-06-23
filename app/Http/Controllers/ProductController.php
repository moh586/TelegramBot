<?php

namespace App\Http\Controllers;


use App\Product;
use App\ProductColor;
use App\ProductPhoto;
use App\ProductSize;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function listProduct()
    {
        $products=Product::all()->sortByDesc('created_at');
        return view('layout/ui/product/productlist',compact('products'));
    }

    public function addProduct()
    {
        $sellers=User::getSellers();
        return view('layout/ui/product/addproduct',compact('sellers'));
    }

    public function storeProduct(Request $request)
    {

        try {


            $product = Product::create([
                'name' => $request->input('productname'),
                'seller_id' => $request->input('seller'),
                'keywords' => $request->input('keywords'),
                'brand' => $request->input('brand'),
                'sold_by' => $request->input('soldby'),
                'price' => $request->input('price'),
                'price_to_pay' => $request->input('pay'),
                'max_order' => $request->input('maxorder'),
                'description' => $request->input('description'),
                'total' => $request->input('total'),
                'coupon' => $request->input('coupon'),
                'review_type' => $request->input('review'),
                'refund_type' => $request->input('refund'),
                'commission' => $request->input('commission'),
                'instructions' => $request->input('instructions'),
                'product_links' => $request->input('productlink'),
                'asin' => $request->input('asin'),
                'no_of_rating' => $request->input('rate')
            ]);

            if ($request->has('colors')) {

                $colors = $request->input('colors');
                foreach ($colors as $color) {
                    $product_color = ProductColor::create([
                        'product_id' => $product->id,
                        'color' => $color
                    ]);

                }
            }

            //
            if ($request->has('colosizesrs')) {
                $sizes = $request->input('sizes');
                foreach ($sizes as $size) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size' => $size
                    ]);
                }
            }

            //
            $images = $request->file('image');
            $path = storage_path("app/public/products/" . $product->id);
            Log::info(json_encode($path));
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }


            if ($request->hasfile('image')) {
                Log::debug(json_encode($request->file('image')));
                foreach ($request->file('image') as $image) {

                    if ($image != null) {
                        try {
                            $imageName = time() . '.' . $image->extension();

                            $image->move($path, $imageName);
                            ProductPhoto::create([
                                'product_id' => $product->id,
                                'path' => $path . "/" . $imageName
                            ]);
                        } catch (\Throwable $e) {
                            continue;
                        }

                    }
                }
            }


            return redirect(route('product_list'))->with('success', 'Product Added Successfully');
        }
        catch (\Throwable $e)
        {
            return Redirect::back()->withErrors("Operation Failed.Try Again!");
        }
    }

    public function productTypehead($filter)
    {
        $products=Product::where('activated', '=',1)
            ->where(function ($query) use ($filter) {
                $query->where('name','like',"%".$filter."%")
                    ->orWhere('brand','like',"%".$filter."%")
                    ->orWhere('keywords','like',"%".$filter."%");
            });


        $products=$products->take(10)->get(['name','brand','price','id']);
        return response()->json($products);
    }

    public function activeProduct(Request $request)
    {
        if ($request->ajax()) {
            try {
                $product = Product::find($request->product_id);
                //$branch=Branch::find($request->bid)->get();
                $product->activated = !$product->activated;
                $product->save();
                if ($product->activated)
                    return response()->json(array('message' => $product->name . " Activated", "status" => 1, "statustext" => 'Suspend'), 200);
                else
                    return response()->json(array('message' => $product->name . " Suspended", "status" => 0, "statustext" => 'Active'), 200);
            } catch
            (\Throwable $e) {
                return response()->json(array('message' => "Operation Failed.Try Again!", "status" => -1, "statustext" => 'Active'), 200);
            }
        }
    }

    public function deleteProduct(Request$request)
    {
        if ($request->ajax()) {
            try {
                $product = Product::find($request->product_id);
                if($product!=null)
                    $product->delete();
                    return response()->json(array('message' => $product->name . " deleted successfully", "status" => 1), 200);
            } catch
            (\Throwable $e) {
                return response()->json(array('message' => "Operation Failed.Try Again!", "status" => 0), 200);
            }
        }
    }

}
