<?php

namespace SLIM\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Category\App\Http\Requests\CategoryRequest;
use SLIM\Category\App\Models\Category;
use SLIM\Category\Interfaces\CategoryServiceInterfaces;
use SLIM\Category\Service\CategoryService;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      protected CategoryServiceInterfaces $categoryServiceInterfaces;
       public function  __construct(CategoryServiceInterfaces $categoryServiceInterfaces)
       {
           $this->categoryServiceInterfaces=$categoryServiceInterfaces;

       }

    public function index(Request $request)
    {
        $categories = $this->categoryServiceInterfaces->getAllPaginated($request->all(), 15);
                if($request->ajax())
                    return view('category::partial',compact('categories'));
        return view('category::index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $categoryRequest)
    {
       $this->categoryServiceInterfaces->create($categoryRequest->all());
       return $this->index($categoryRequest);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $categoryRequest, Category $category)
    {
        $this->categoryServiceInterfaces->update($category,$categoryRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Request $request)
    {
        $this->categoryServiceInterfaces->delete($category);
        return $this->index($request);

    }
}
