<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(20);
        return view('menus.menus', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if(isset($input['image']))
        {
            // upload $inputt['image']
            $input['image'] = $this->upload($input['image']);
        }else {
            $input['image'] = 'img/menus/default.png';
        }
        $input['user_id'] = \Auth::user()->id;
//        dd($input);
        Menu::create($input);
        return redirect()->back();
    }

    public function upload ($file){
        $extension = $file->getClientOriginalExtension();
        $filename = time()."_".$file->getClientOriginalName();
        $path = public_path('img/menus');
        $file->move($path, $filename);
        return 'img/menus/'.$filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $input = $request->all();
        if(isset($input['image']))
        {
            // upload $inputt['image']
            $input['image'] = $this->upload($input['image']);
        }
//       dd($input);
        Menu::findOrFail($id)->update($input);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id)->delete();
        return redirect()->back();
    }
}
