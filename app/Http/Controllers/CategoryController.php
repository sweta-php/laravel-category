<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class CategoryController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate(3);
        return view('category')->with(compact(['categories']));
    }

    public function search(Request $request)
    {
       
        $search = $request->input('search');
        
       
       $categories= DB::table('categories')->where('name', 'LIKE', '%' . $search . '%')
        ->orwhere('created_at', 'LIKE', '%' . $search . '%')
        ->orwhere('updated_at', 'LIKE', '%' . $search . '%')
        ->orwhere('id', 'LIKE', '%' . $search . '%')->paginate(3);
      
        
        return view('category', ['categories' => $categories]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'alpha']
        ]);
               
        $categories = new Category();
        $categories->name = $request->name;
        $categories->save();
        return redirect('category')->with('message', 'New Category Added Successfully!');
    }

    public function destroy($id)
    {
        $categories = Category::findorfail($id);
        $categories->delete();
        return redirect('category')->with('message', 'Category deleted Successfully!');
    }

    public function edit($id, Request $request)
    {
             
        $categories = Category::findorfail($id);
            
        return view('editcategory', compact('categories', 'id'));
    }


    public function update(Request $request, $id)
    { 
        $categories = Category::findorfail($id);
         
         $rules = [
             'name' => ['required'],
                    ];
 
         $vali = Validator::make($request->all(), $rules);

         if ($vali->fails()) {
             return view('editcategory', compact('categories', 'id'))->withErrors($vali);
         } else {
             $categories = Category::findorfail($id);
           
             $categories->name = $request->input('name');
           $categories->updated_at= Carbon::now();
             $categories->update();

             return redirect('category')->with('message', 'Category updated Successfully!');
        }
    }
}