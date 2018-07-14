<?php

namespace App\Http\Controllers;

use App\Menu;
use App\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::all();
        return view('product.index', ['products' => product::all(), 'menu'=>$this->getMenu1(), 'menu2'=>$this->getMenu2()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create', ['menu'=>$this->getMenu1(), 'menu2'=>$this->getMenu2()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $avatar = $request['avatar'];
        $avatar = $this->uploadFile($avatar);
//                        dd(array_merge($request->except('avatar', '_token'), ['avatar'=>$avatar]));

        $product = product::create(array_merge($request->except('avatar', '_token'), ['avatar'=>$avatar]));

        return view('product.index', ['products' => product::all(), 'menu2'=>$this->getMenu2()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('product.edit', ['product' => $product, 'menu'=>$this->getMenu1(), 'menu2'=>$this->getMenu2()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $avatar = $request['avatar'];//$request->file('avatar');
//                dd($avatar);
        if ($avatar != null) {
            $avatar = $this->uploadFile($avatar);
            $update = $product->update(array_merge($request->except('avatar'), ['avatar'=>$avatar]));
        } else {
            $update = $product->update($request->except('avatar'));
        }
        return view('product.index', ['products' => product::all(), 'menu2'=>$this->getMenu2()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
//        dd($product);
        $product->delete();

        return view('product.index', ['products' => product::all(), 'menu2'=>$this->getMenu2()]);
    }

    public function search($title, $level1, $level2) {
//        dd($title.'|'.$level1.'|'.$level2);
        $products = Product::where('title', 'like', '%'.$title.'%')
                ->orWhere('subtitle', 'like', '%'.$title.'%');
        if ($level1 != 100) {
            $products = $products->where('level1', $level1);
            if ($level2 != null) {
                $products = $products->where('level2', $level2);
            }
        }
        $products = $products->get();
//        dd($products);
        return view('product.index', ['products' => $products, 'menu'=>$this->getMenu1(), 'menu2'=>$this->getMenu2()]);
    }


    private function uploadFile($file) {
        $destPath = 'images/product/';
        $fileName = $file->getClientOriginalName();
        $saveFile = $file->move($destPath, $fileName);
//        dd($saveFile);
        if ($saveFile != null)
            return '/'.$destPath.$fileName;
        else
            return null;
    }

    private function getMenu1() {
        $menu = Menu::all();
        $menu1 = array();
        for ($i=0; $i<count($menu); $i++) {
            array_push($menu1, $menu[$i]['name']);
        }
        return $menu1;
    }

    private function getMenu2() {
        $menu = Menu::all();
        $menu2 = array();
        for ($i=0; $i<count($menu); $i++) {
            $subMenus = array();
            if ($menu[$i]['level2_contents'] != null) {
                $subMenus = explode(',', $menu[$i]['level2_contents']);
            }
            array_push($menu2, $subMenus);

        }

        return $menu2;
    }

//    public function syncAbout() {
//        $products = product::where('level1_seq', 0)->get();
//        $menus = Menu::all();
//        if (count($menus) > 0) {
//            return ['success' => true, 'menus' => $menus, 'products' => $products];
//        } else
//            return ['success' => false];
//    }

    public function syncProducts($level1) {
        $products = product::where('level11', $level1)->get();
        $menus = Menu::all();
        if (count($menus) > 0) {
            return ['success' => true, 'menus' => $menus, 'products' => $products];
        } else
            return ['success' => false];
    }

    public function syncMenuProducts() {

    }
}
