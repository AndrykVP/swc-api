<?php

namespace AndrykVP\Rancor\Forums\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use AndrykVP\Rancor\Forums\Models\Category;
use AndrykVP\Rancor\Forums\Http\Resources\CategoryResource;
use AndrykVP\Rancor\Forums\Http\Requests\CategoryForm;

class CategoryController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('groups')->paginate(config('rancor.config'));

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AndrykVP\Rancor\Forums\Http\Requests\CategoryForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryForm $request)
    {
        $this->authorize('create',Category::class);
        
        $data = $request->validated();
        $category;
        DB::transaction(function () use(&$category, $data) {
            $category = Category::create($data);
            $category->groups()->sync($data['groups']);
        });

        return response()->json([
            'message' => 'Category "'.$category->name.'" has been created'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AndrykVP\Rancor\Forums\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $this->authorize('view',$category);

        return new CategoryResource($category->load('boards','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AndrykVP\Rancor\Forums\Http\Requests\CategoryForm  $request
     * @param  \AndrykVP\Rancor\Forums\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryForm $request, Category $category)
    {
        $this->authorize('update',$category);
        $data = $request->validated();
        DB::transaction(function () use(&$category, $data) {
            $category->update($data);
            $category->groups()->sync($data['groups']);
        });

        return response()->json([
            'message' => 'Category "'.$category->name.'" has been updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AndrykVP\Rancor\Forums\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete',$category);
        
        DB::transaction(function () use($category) {
            $category->groups()->detach();
            $category->delete();
        });

        return response()->json([
            'message' => 'Category "'.$category->name.'" has been deleted'
        ], 200);        
    }

    /**
     * Display the results that match the search query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->authorize('viewAny',Category::class);
        
        $categories = Category::with('groups')->where('name','like','%'.$request->search.'%')->paginate(config('rancor.pagination'));

        return CategoryResource::collection($categories);
    }
}