<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Color;
use App\Language;
use Illuminate\Support\Str;
class ColorAttributeController extends Controller
{
    public function index(Request $request)
    {
        $sort_search =null;
        $colors = Color::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $colors = $colors->where('name', 'like', '%'.$sort_search.'%');
        }
        
        $colors = $colors->paginate(10);
        return view('colors.index', compact('colors', 'sort_search'));
    }
    /* public function Color(Request $request)
    {
        $color = new color;
        $color->user_id = Auth::user()->id;
        $color->name = $request->color_name;
        $color->code = $request->color_code;
        $color->save();
    } */

    public function create()
    {
        return view('colors.create');
    }

    public function store(Request $request)
    {
        if(count(Color::where('code', $request->code)->get()) > 0){
            flash('Color already exist!')->error();
            return back();
        }
        $color = new color;
        $color->name = $request->color_name;
        $color->code = $request->code;
        if($color->save()){
            flash(__('color has been inserted successfully'))->success();
            return redirect()->route('colors.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function edit($id)
    {
      $color = Color::findOrFail(decrypt($id));
      return view('colors.edit', compact('color'));
    }

    public function update(Request $request)
    {
        $color = Color::findOrFail($request->id);
        $color->name = $request->color_name;
        $color->code = $request->code;

      if ($color->save()) {
        flash('Color has been saved successfully')->success();
        return redirect()->route('colors.index');
        }
        else{
            flash('Something went wrong')->danger();
            return back();
        }
    }

    public function destroy($id)
    {
        $color = Color::findOrFail($id);
        if(Color::destroy($id)){
            flash('color has been deleted successfully')->success();
            return redirect()->route('colors.index');
        }

        flash('Something went wrong')->error();
        return back();
    }
}
