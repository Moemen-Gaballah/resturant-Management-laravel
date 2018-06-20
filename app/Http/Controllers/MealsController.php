<?php

namespace App\Http\Controllers;

use App\Meal;
use App\MealItem;
use App\Menu;
use Illuminate\Http\Request;

class MealsController extends Controller
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
//        $meals = meal::all();
        $meals = Meal::paginate(20);
        return view('meals.meals', compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('meals.create', compact('menus'));
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
            $input['image'] = 'img/meals/default.png';
        }
        $input['user_id'] = \Auth::user()->id;
//        dd($input);
        $meal = Meal::create($input);
        $input['discount'];
        MealItem::create(['meal_id' => $meal->id, 'item_id' => $item, 'discount' => $input['discount'][$item]]);

        $menus = Menu::all();
        $mealItems = MealItem::where('meal_id', $meal->id)->get();
        $mealItemsIDs = array();

        foreach ($mealItems as $mealItem)
        {
            $mealItemsIDs[] = $mealItem->item_id;
        }

//        return redirect('/meals');
        return view("meals.edit", compact('meal','menus', 'mealItems'));
    }

    public function upload ($file){
        $extension = $file->getClientOriginalExtension();
        $filename = time()."_".$file->getClientOriginalName();
        $path = public_path('img/meals');
        $file->move($path, $filename);
        return 'img/meals/'.$filename;
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
        $meal = Meal::findOrFail($id);
        $menus = Menu::all();
        $mealItems = MealItem::where('meal_id', $meal->id)->get();
        $mealItemsIDs = array();

        foreach ($mealItems as $mealItem)
        {
            $mealItemsIDs[] = $mealItem->item_id;
        }

        return view('meals.edit', compact('meal','menus', 'mealItemsIDs'));
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
        $meal =  Meal::findOrFail($id)->update($input);

        MealItem::where('meal_id', $id)->delete();

        foreach ($input['items'] as $item){
            MealItem::create(['meal_id' => $id, 'item_id' => $item, 'discount' => $input['discount'][$item]]);
        }
            return redirect('/meals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal = Meal::findOrFail($id)->delete();
        return redirect()->back();
    }
}
