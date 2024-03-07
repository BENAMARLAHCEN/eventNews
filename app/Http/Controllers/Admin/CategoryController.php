<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\updateCatRequest;
use Illuminate\Http\Request;
use App\Repositories\Category;
use App\Repository\Interface\ICategoryRepository;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(ICategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->list();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $this->category->storeOrUpdate($request->validated());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->category->findById($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function show($id)
    {
        $category = $this->category->findById($id);
        return view('admin.categories.show', compact('category'));
    }

    public function update(updateCatRequest $request, $id)
    {

        $this->category->storeOrUpdate($request->validated(), $id);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $this->category->destroyById($id);

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
