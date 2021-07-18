<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SubcategoryController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $categories = Category::all();
        return view('addsubcategory')->with(compact(['categories']));
    }
    public function show()
    {
        $subcategories = Subcategory::join('categories', 'categories.id', '=', 'subcategories.categories_id')
        ->select(['subcategories.*', 'categories.name as cname'])->paginate(3);
        return view('subcategory')->with(compact(['subcategories']));
    }
    public function search(Request $request)
    {
       
        $search = $request->input('search');
        
       
        $subcategories = Subcategory::join('categories', 'categories.id', '=', 'subcategories.categories_id')
        ->select(['subcategories.*', 'categories.name as cname'])->where('subcategories.name', 'LIKE', '%' . $search . '%')
        ->orwhere('categories.name', 'LIKE', '%' . $search . '%')
        ->orwhere('subcategories.created_at', 'LIKE', '%' . $search . '%')
        ->orwhere('subcategories.updated_at', 'LIKE', '%' . $search . '%')
        ->orwhere('subcategories.categories_id', 'LIKE', '%' . $search . '%')
        ->orwhere('subcategories.id', 'LIKE', '%' . $search . '%')->paginate(3);
      
        
        return view('subcategory', ['subcategories' => $subcategories]);
    }
    public function create(Request $request)
    {
        $request->validate([
           'category' => ['required'],
            'name' => ['required', 'alpha']
        ]);
        $subcategories = new Subcategory();

        $subcategories->categories_id =  $request['category'] ? Category::find($request['category'])->id : $request['category'];
        $subcategories->name = $request->name;
        $subcategories->save();
        return redirect('subcategory')->with('message', 'New SubCategory Added Successfully!');
    }

    public function destroy($id)
    {
        $subcategories = Subcategory::findorfail($id);
        $subcategories->delete();
        return redirect('subcategory')->with('message', 'Sub-Category deleted Successfully!');
    }

    public function edit($id, Request $request)
    {   
        $categories =Category::all();
        $subcategories = Subcategory::findorfail($id);
   

        return view('editsubcategory', compact('subcategories', 'id','categories'));
    }


    public function update(Request $request, $id)
    {
        $categories =Category::all();
        $subcategories = Subcategory::findorfail($id);

        $rules = [
            'category' =>'required',
            'name' => ['required'],
        ];

        $vali = Validator::make($request->all(), $rules);

        if ($vali->fails()) {
            return view('editsubcategory', compact('subcategories', 'categories','id'))->withErrors($vali);
        } else {
            $subcategories = SubCategory::findorfail($id);
            $subcategories->categories_id =  $request['category'] ? Category::find($request['category'])->id : $request['category'];
            $subcategories->name = $request->input('name');
            $subcategories->updated_at= Carbon::now();
            $subcategories->update();

            return redirect('subcategory')->with('message', 'Category updated Successfully!');
        }
    }
}
