<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Image;

class ProductsController extends Controller
{
    public function listProduct (Request $request) {
        if ($request->path() == 'products/br')
            $products = Product::whereIn('marketed', [1, 3])->get();
        else if ($request->path() == 'products/us')
            $products = Product::whereIn('marketed', [2, 3])->get();
        else
            $products = Product::all();

        return view('products.list', ['products' => $products]);
    }

    public function view ($id) {
        $product = Product::find($id);
        return view('products.view', ['product' => $product]);
    }

    public function add () {
        $categories = Category::all();
        return view('products.add', ['categories' => $categories]);
    }

    public function edit ($id) {
        $product = Product::find($id);
        $categories = Category::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function save (Request $request) {
        $rules = array('category_id' => 'required', 'marketed' => 'required');
        $inputs = $request->except('_token');
        $verify = true;

        if (
            isset($request->name_br) ||
            isset($request->image_br) ||
            isset($request->advantages_br) ||
            isset($request->characteristics_br) ||
            isset($request->packing_br)
        ) {
            $rules['name_br'] = 'required';
            $rules['image_br'] = 'required';
            $rules['advantages_br'] = 'required';
            $rules['characteristics_br'] = 'required';
            $rules['packing_br'] = 'required';
        } else {
            $verify = false;
        }

        if (
            isset($request->name_en) ||
            isset($request->image_en) ||
            isset($request->advantages_en) ||
            isset($request->characteristics_en) ||
            isset($request->packing_en)
        ) {
            $rules['name_en'] = 'required';
            $rules['image_en'] = 'required';
            $rules['advantages_en'] = 'required';
            $rules['characteristics_en'] = 'required';
            $rules['packing_en'] = 'required';
        } else {
            $verify = $verify ? true : false;
        }

        if (
            isset($request->name_es) ||
            isset($request->image_es) ||
            isset($request->advantages_es) ||
            isset($request->characteristics_es) ||
            isset($request->packing_es)
        ) {
            $rules['name_es'] = 'required';
            $rules['image_es'] = 'required';
            $rules['advantages_es'] = 'required';
            $rules['characteristics_es'] = 'required';
            $rules['packing_es'] = 'required';
        } else {
            $verify = $verify ? true : false;
        }

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails() || !$verify)
            return redirect('/products/add')->withInput()->withErrors($validator);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->marketed = $request->marketed;

        if (isset($request->name_br)) {
            $product->name_br = $request->name_br;
            $product->advantages_br = $request->advantages_br;
            $product->characteristics_br = $request->characteristics_br;
        }

        if (isset($request->name_en)) {
            $product->name_en = $request->name_en;
            $product->advantages_en = $request->advantages_en;
            $product->characteristics_en = $request->characteristics_en;
        }

        if (isset($request->name_es)) {
            $product->name_es = $request->name_es;
            $product->advantages_es = $request->advantages_es;
            $product->characteristics_es = $request->characteristics_es;
        }

        foreach ($request->files as $key => $value) {
            $imageName = uniqid() . time();
            $image = Image::make($request->$key);
            $image->save($this->getSaveImagePath() . "{$imageName}.jpg");
            $image->destroy();

            $product->$key = $imageName;
        }

        $product->save();

        return redirect('/products');

    }

    public function update (Request $request) {
        $rules = array('category_id' => 'required', 'marketed' => 'required', 'id' => 'required');
        $inputs = $request->except('_token');
        $verify = true;

        if (
            isset($request->name_br) ||
            isset($request->image_br) ||
            isset($request->advantages_br) ||
            isset($request->characteristics_br) ||
            isset($request->packing_br)
        ) {
            $rules['name_br'] = 'required';
            $rules['image_br'] = 'required';
            $rules['advantages_br'] = 'required';
            $rules['characteristics_br'] = 'required';
            $rules['packing_br'] = 'required';
        } else {
            $verify = false;
        }

        if (
            isset($request->name_en) ||
            isset($request->image_en) ||
            isset($request->advantages_en) ||
            isset($request->characteristics_en) ||
            isset($request->packing_en)
        ) {
            $rules['name_en'] = 'required';
            $rules['image_en'] = 'required';
            $rules['advantages_en'] = 'required';
            $rules['characteristics_en'] = 'required';
            $rules['packing_en'] = 'required';
        } else {
            $verify = $verify ? true : false;
        }

        if (
            isset($request->name_es) ||
            isset($request->image_es) ||
            isset($request->advantages_es) ||
            isset($request->characteristics_es) ||
            isset($request->packing_es)
        ) {
            $rules['name_es'] = 'required';
            $rules['image_es'] = 'required';
            $rules['advantages_es'] = 'required';
            $rules['characteristics_es'] = 'required';
            $rules['packing_es'] = 'required';
        } else {
            $verify = $verify ? true : false;
        }

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails() || !$verify)
            return redirect('/products/edit/' . $request->id)->withInput()->withErrors($validator);

        $product = Product::find($request->id);
        $product->category_id = $request->category_id;
        $product->marketed = $request->marketed;

        $product->name_br = $request->name_br;
        $product->advantages_br = $request->advantages_br;
        $product->characteristics_br = $request->characteristics_br;

        $product->name_en = $request->name_en;
        $product->advantages_en = $request->advantages_en;
        $product->characteristics_en = $request->characteristics_en;

        $product->name_es = $request->name_es;
        $product->advantages_es = $request->advantages_es;
        $product->characteristics_es = $request->characteristics_es;

        $this->deleteImages($product->image_br);
        $this->deleteImages($product->image_en);
        $this->deleteImages($product->image_es);

        $this->deleteImages($product->packing_br);
        $this->deleteImages($product->packing_en);
        $this->deleteImages($product->packing_es);

        $product->image_br = null;
        $product->image_en = null;
        $product->image_es = null;

        $product->packing_br = null;
        $product->packing_en = null;
        $product->packing_es = null;

        foreach ($request->files as $key => $value) {
            $imageName = uniqid() . time();
            $image = Image::make($request->$key);
            $image->save($this->getSaveImagePath() . "{$imageName}.jpg");
            $image->destroy();

            $product->$key = $imageName;
        }

        $product->save();

        return redirect('/products');
    }

    public function remove ($id) {
        $product = Product::find($id);

        $this->deleteImages($product->image_br);
        $this->deleteImages($product->image_en);
        $this->deleteImages($product->image_es);

        $this->deleteImages($product->packing_br);
        $this->deleteImages($product->packing_es);
        $this->deleteImages($product->packing_en);

        $product->delete();

        return redirect('/products');
    }

    private function deleteImages ($name) {
        $path = $this->getSaveImagePath() . $name . '.jpg';
        if (file_exists($path)) unlink($path);
    }


    private function getSaveImagePath () {
        return public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
    }

}
