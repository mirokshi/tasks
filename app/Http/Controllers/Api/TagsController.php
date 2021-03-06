<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagDestroy;
use App\Http\Requests\TagIndex;
use App\Http\Requests\TagShow;
use App\Http\Requests\TagStore;
use App\Http\Requests\TagUpdate;
use App\Tag;

class TagsController extends Controller
{
    public function index(TagIndex $request)
    {
        return map_collection(Tag::orderBy('created_at', 'desc')->get());
    }

    public function show(TagShow $request, Tag $tag)
    {
        return $tag->map();
    }

    //DELETE
    public function destroy(TagDestroy $request, Tag $tag)
    {
        $tag->delete();
        return $tag;
    }

    //CREATE
    public function store(TagStore $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();

        return $tag->map();
    }

    public function update(TagUpdate $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();

        return $tag->map();
    }

}
