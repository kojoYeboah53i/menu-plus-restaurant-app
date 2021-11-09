<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Validator;

class ProductsPricingController extends Controller
{
    public function home()
    {
        $navs = [
            [
                [
                    'title' => 'Manage Products',
                    'link' => 'products.product.home',
                    'icon' => 'fas fa-cubes',
                ],
                [
                    'title' => 'Subscription Pricing',
                    'link' => 'products.pricing.home',
                    'icon' => 'fas fa-dollar',
                ],
            ],
        ];
        return view('pages.products_pricing.home', compact('navs'));
    }

    //Products Controllers.
    public function products()
    {
        $products = Product::all();
        $features_list = [];
        $greatest_width = 0;
        foreach ($products as $product) {
            $features_list[$product->name] = explode(PHP_EOL, $product->features);
            $count = count($features_list[$product->name]);
            $greatest_width = ($count > $greatest_width)? $count : $greatest_width;
        }

        $data = [
            'products' => $products,
            'features_list' => $features_list,
            'greatest_width' => $greatest_width,
        ];

        return view('pages.products_pricing.products.home', $data);
    }

    public function createProduct()
    {
        return view('pages.products_pricing.products.create-edit');
    }

    public function addProduct()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'features' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::create(request()->all());

        session()->flash(
            ($product ? 'success' : 'error') . '_message',
            $product
                ? 'You have successfully added the product: ' .
                    request()->name
                : 'Sorry, could not add product.'
        );

        return redirect()->route('products.product.home');
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('pages.products_pricing.products.create-edit', compact('product'));
    }

    public function updateProduct($id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'features' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($id);
        $product->name = request()->name;
        $product->features = request()->features;
        $product->save();

        session()->flash(
            ($product ? 'success' : 'error') . '_message',
            $product
                ? 'You have successfully updated the product: ' .
                    request()->name
                : 'Sorry, could not update product.'
        );

        return redirect()->route('products.product.home');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $name = $product->name;
        $product->delete();

        session()->flash(
            ($product ? 'success' : 'error') . '_message',
            $product
                ? 'You have successfully deleted the product: ' .
                $name
                : 'Sorry, could not delete product.'
        );

        return redirect()->route('products.product.home');
    }

    //Pricing Route Controllers
    public function pricing()
    {
        $products = Product::all();

        $plan_list = [];
        $greatest_width = 0;
        foreach ($products as $product) {
            $plan_list[$product->name] = SubscriptionPlan::where('product_id', $product->id)->get();
            $count = $plan_list[$product->name]->count();
            $greatest_width = ($count > $greatest_width)? $count : $greatest_width;
        }

        $data = [
            'products' => $products,
            'plan_list' => $plan_list,
            'greatest_width' => $greatest_width,
        ];

        return view('pages.products_pricing.pricing.home', $data);
    }

    public function createPricing()
    {
        $products = Product::all();
        return view('pages.products_pricing.pricing.create-edit', compact('products'));
    }

    public function addPricing()
    {
        $validator = Validator::make(request()->all(), [
            'product_id' => 'required|numeric',
            'name' => 'required|string',
            'duration' => 'required|string',
            'pricing' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $plan = SubscriptionPlan::create(request()->all());

        session()->flash(
            ($plan ? 'success' : 'error') . '_message',
            $plan
                ? 'You have successfully added the Plan: ' .
                    request()->name
                : 'Sorry, could not add Plan.'
        );

        return redirect()->route('products.pricing.home');
    }

    public function editPricing($id)
    {
        $products = Product::all();
        $plan = SubscriptionPlan::find($id);
        $data = [
            'products' => $products,
            'plan' => $plan,
        ];
        return view('pages.products_pricing.pricing.create-edit', $data);
    }

    public function updatePricing($id)
    {
        $validator = Validator::make(request()->all(), [
            'product_id' => 'required|numeric',
            'name' => 'required|string',
            'duration' => 'required|string',
            'pricing' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $plan = SubscriptionPlan::find($id);
        $plan->product_id = request()->product_id;
        $plan->name = request()->name;
        $plan->duration = request()->duration;
        $plan->pricing = request()->pricing;
        $plan->save();

        session()->flash(
            ($plan ? 'success' : 'error') . '_message',
            $plan
                ? 'You have successfully updated the Subscription Plan: ' .
                    request()->name
                : 'Sorry, could not update Subscription Plan.'
        );

        return redirect()->route('products.pricing.home');
    }

    public function deletePricing($id)
    {
        $plan = SubscriptionPlan::find($id);
        $name = $plan->name;
        $plan->delete();

        session()->flash(
            ($plan ? 'success' : 'error') . '_message',
            $plan
                ? 'You have successfully deleted the product: ' .
                $name
                : 'Sorry, could not delete product.'
        );

        return redirect()->route('products.pricing.home');
    }
}
