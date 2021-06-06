<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return response(Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:30',
            'type' => 'required',
            'color' => 'required',
        ]);

        $category = Category::create($request->all());

        return response($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {
        return response(Post::query()->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UpdatePostRequest $request, int $id)
    {
        $post = Post::query()->findOrFail($id);

        $post->update($request->only(['title', 'content']));

        return response($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        Post::query()->findOrFail($id)->delete();

        return response([], 204);
    }

}
