<?php

namespace App\Http\Controllers;


use App\Http\Requests\TagIndex;

use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{

    public function index(TagIndex $request)
    {
        $tags = map_collection(Tag::all());
        return view('tags',[
            'tags' => $tags
        ]);
    }

}
