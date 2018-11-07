<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTag;
use App\Http\Requests\StoreTag;
use App\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{
    public function index(Request $request)
    {
        return Tag::orderBy('created_at')->get();

    }

    public function show(Request $request, Tag $tag)
    {
        return $tag->map();

    }

    //DELETE
    public function destroy(Request $request, Tag $tag)
    {
        $tag->delete();
    }

    //CREATE
    public function store(StoreTag $request)
    {

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color= $request->color;
        $tag->save();
        return $tag->map();
    }

    public function update(UpdateTag $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        return $tag->map();
    }

}
