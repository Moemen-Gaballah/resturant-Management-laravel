<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Menu;
class ItemController extends Controller
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
//        $items = Item::all();
           $items = Item::paginate(20);
        return view('items.items', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::pluck('title', 'id');
        return view('items.create', compact('menus'));
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
            $input['image'] = 'img/items/default.png';
        }
        $input['user_id'] = \Auth::user()->id;
//        dd($input);
        $item = item::create($input);
        $menus = Menu::pluck('title', 'id');
        return redirect('/items');
//        return view("items.edit", compact('item','$menus'));
    }

    public function upload ($file){
        $extension = $file->getClientOriginalExtension();
        $filename = time()."_".$file->getClientOriginalName();
        $path = public_path('img/items');
        $file->move($path, $filename);
        return 'img/items/'.$filename;
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
        $menus = Menu::pluck('title', 'id');
        $item = Item::findOrFail($id);

        return view('items.edit', compact('item','menus'));
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
        Item::findOrFail($id)->update($input);
        return redirect('/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id)->delete();
        return redirect()->back();
    }
}
