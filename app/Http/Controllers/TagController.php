<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagCreateUpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function store(TagCreateUpdateRequest $request)
    {
        $data = $request->validated();
        return Tag::create($data);
    }

    public function show(Tag $tag)
    {
        return $tag;
    }

    public function update(TagCreateUpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
        return $tag;
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json();
    }
}
