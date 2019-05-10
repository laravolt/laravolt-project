<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravolt\Suitable\Tables\BasicTable;
use Modules\Post\Http\Requests\Store;
use Modules\Post\Http\Requests\Update;
use Modules\Post\Models\Post;
use Modules\Post\TableView\PostTableView;

class PostController extends Controller
{
    public function index()
    {
        $items = Post::autoSort()->latest()->search(request('search'))->paginate();

        return (PostTableView::make($items))->view('post::index');
    }

    public function create()
    {
        return view('post::create');
    }

    public function store(Store $request)
    {
        Post::create($request->all());

        return redirect()->route('post.index')->withSuccess('Post saved');
    }

    public function show(Post $post)
    {
        return view('post::show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post::edit', compact('post'));
    }

    public function update(Update $request, Post $post)
    {
        $post->update($request->all());

        return redirect()->back()->withSuccess('Post saved');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.index')->withSuccess('Post deleted');
    }
}
