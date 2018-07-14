<?php

namespace App\Http\Controllers;

use App\Menu;
use Faker\Provider\File;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($menuid)
    {
        $menu = Menu::findorFail($menuid);
//        dd($menu);
        return view('menu.edit', ['menu'=>$menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $avatar = $request['avatar'];//$request->file('avatar');
//                dd($avatar);
        if ($avatar != null) {
            $avatar = $this->uploadFile($avatar);
            $update = $menu->update(array_merge($request->except('avatar'), ['avatar'=>$avatar]));
        } else {
            $update = $menu->update($request->except('avatar'));
        }
//        dd($update);
//        redirect('menus');
        return view('menu.index', ['menus' => Menu::all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }

    public function setVisible($menuid, $visible) {
        $menu = Menu::findorFail($menuid);
        $menu->update(['visible'=>$visible]);
    }

    private function uploadFile($file) {
        $destPath = 'images/menu/';
        $fileName = $file->getClientOriginalName();
        $saveFile = $file->move($destPath, $fileName);
//        dd($saveFile);
        if ($saveFile != null)
            return '/'.$destPath.$fileName;
        else
            return null;
    }



    public function syncData() {
        $menus = Menu::all();
        if (count($menus) > 0) {
            return ['success' => true, 'menus' => $menus];
        } else
            return ['success' => false];
    }
}
