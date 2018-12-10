<?php

namespace App\Http\Controllers;


use App\Http\Requests\TagIndex;
use App\Http\Requests\UserTagsIndex;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{

    public function index(UserTagsIndex $request)
    {
        $tags =map_collection(Tag::all());
        if (Auth::user()->can('tags.manage')){
            $tags = map_collection(Tag::orderBy('created_at','desc') -> get());
            $uri = 'api/v1/tag/';
        }else {
            $tags = map_collection($request->user()->tasks);
            $uri = 'api/v1/user/tag/';
        }
        // MVC
        $users= User::all();
        return view('tags',compact('tags', 'uri'));
    }

}
