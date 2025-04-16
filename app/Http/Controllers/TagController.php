<?php
namespace App\Http\Controllers;

use App\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->all();
        return view('admin.tags', compact('tags'));
    }

    // public function create()
    // {
    //     return view('admin.tags.create');
    // }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string',
        ]);

        $data = $this->tagRepository->create($validated);

        // dd($data);

        return redirect()->route('admin.tags')->with('success', 'Tag created successfully.');
    }

    public function show($id)
    {
        $tag = $this->tagRepository->find($id);
        return view('admin.tags.show', compact('tag'));
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);
        return $tag;
        // return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string',
        ]);

        $this->tagRepository->update($id, $validated);

        return redirect()->route('admin.tags')->with('success', 'Tag updated successfully.');
    }

    public function destroy($id)
    {
        $this->tagRepository->delete($id);
        return redirect()->route('admin.tags')->with('success', 'Tag deleted successfully.');
    }
}
