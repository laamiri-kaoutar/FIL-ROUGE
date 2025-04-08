<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->categoryRepository->create($validated);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->categoryRepository->update($id, $validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
