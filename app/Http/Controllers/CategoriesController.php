<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;
use Image;
use App\Product;

class CategoriesController extends Controller
{

    public function listCategory () {
        $categorias = Category::all();

        return view('categories.list',
            [
                'categories' => $categorias
            ]
        );
    }

    public function view ($id) {
        $category = Category::find($id);

        return view('categories.view',
            [
                'category' => $category
            ]
        );
    }

    public function add () {
        return view('categories.add');
    }

    public function edit ($id) {
        $categoria = Category::find($id);
        return view('categories.edit',
            [
                'categoria' => $categoria
            ]
        );
    }

    public function save (Request $request) {
        $inputs = $request->except('_token');
        $rules = [
            'name_br' => 'required',
            'name_en' => 'required',
            'name_es' => 'required',
            'image_br' => 'required',
            'image_en' => 'required',
            'image_es' => 'required'
        ];

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails())
            return redirect('/categories/add')->withInput()->withErrors($validator);


        $category = new Category();
        $category->name_br = $request->name_br;
        $category->name_en = $request->name_en;
        $category->name_es = $request->name_es;

        foreach ($request->files as $key => $value) {
            $imageName = uniqid() . time();

            $image = Image::make($request->$key);
            $image->save($this->getSaveImagePath() . "{$imageName}.jpg");
            $image->destroy();

            $this->saveImage($request->$key, "{$imageName}_30.jpg", 0.3);
            $this->saveImage($request->$key, "{$imageName}_50.jpg", 0.5);

            $category->$key = $imageName;
        }

        $category->save();

        return redirect('/categories');

    }

    public function update (Request $request) {
        $inputs = $request->except('_token');
        $rules = [
            'name_br' => 'required',
            'name_en' => 'required',
            'name_es' => 'required',
            'image_br' => 'required',
            'image_en' => 'required',
            'image_es' => 'required'
        ];

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails())
            return redirect('/categories/edit/' . $request->id)->withInput()->withErrors($validator);


        $category = Category::find($request->id);
        $category->name_br = $request->name_br;
        $category->name_en = $request->name_en;
        $category->name_es = $request->name_es;

        $this->deleteImageAndThumb($this->getSaveImagePath() . $category->image_br, $this->getSaveImageThumbPath() . $category->image_br);
        $this->deleteImageAndThumb($this->getSaveImagePath() . $category->image_en, $this->getSaveImageThumbPath() . $category->image_en);
        $this->deleteImageAndThumb($this->getSaveImagePath() . $category->image_es, $this->getSaveImageThumbPath() . $category->image_es);

        foreach ($request->files as $key => $value) {
            $imageName = uniqid() . time();

            $image = Image::make($request->$key);
            $image->save($this->getSaveImagePath() . "{$imageName}.jpg");
            $image->destroy();

            $this->saveImage($request->$key, "{$imageName}_30.jpg", 0.3);
            $this->saveImage($request->$key, "{$imageName}_50.jpg", 0.5);

            $category->$key = $imageName;
        }

        $category->save();

        return redirect('/categories');
    }

    public function remove ($id) {
        $category = Category::find($id);
        //Product::where('category_id', $category->id)->delete();

        $this->deleteImageAndThumb($this->getSaveImagePath() . $category->image_br, $this->getSaveImageThumbPath() . $category->image_br);
        $this->deleteImageAndThumb($this->getSaveImagePath() . $category->image_en, $this->getSaveImageThumbPath() . $category->image_en);
        $this->deleteImageAndThumb($this->getSaveImagePath() . $category->image_es, $this->getSaveImageThumbPath() . $category->image_es);

        $category->delete();

        return redirect('/categories');
    }

    private function saveImage ($imageSrc, $name, $percent) {
        $image = Image::make($imageSrc);
        $imageH = $image->height() * $percent;
        $imageW = $image->width() * $percent;

        $image->resize($imageW, $imageH)->save($this->getSaveImageThumbPath() . $name);

        $image->destroy();
    }

    private function deleteImageAndThumb ($imagePath, $thumbPath) {
        unlink($imagePath . '.jpg');
        unlink($thumbPath . '_30.jpg');
        unlink($thumbPath . '_50.jpg');
    }

    private function getSaveImagePath () {
        return public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
    }

    private function getSaveImageThumbPath () {
        return public_path() . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR;
    }

}
