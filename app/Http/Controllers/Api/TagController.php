<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagIndex;
use App\Http\Requests\TagStore;
use App\Http\Requests\TagUpdate;
use App\Http\Requests\UpdateTag;
use App\Http\Requests\StoreTag;
use App\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{
    public function index(TagIndex $request)
    {
        $tags = map_collection(Tag::orderBy('created_at','desc')->get());
        return $tags;

    }

    public function show(Tag $tag)
    {
        $tag = Tag::findOrFail($tag->id);
        return $tag->map();

    }

    //DELETE
    public function destroy( Tag $tag)
    {
        Tag::destroy($tag->id);
        return $tag->map();
    }

    //CREATE
    public function store(TagStore $request)
    {

        $tag = Tag::create($request->all());
        return $tag->map();
    }

    public function update(TagUpdate $request, Tag $tag)
    {
        $tag->update($request->only(['name','description','color','user_id']));
        $tag->save();
        return $tag->map();
    }

}
