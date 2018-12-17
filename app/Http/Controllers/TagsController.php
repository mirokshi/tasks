<?php

namespace App\Http\Controllers;


use App\Http\Requests\TagIndex;

use App\Http\Requests\UserTagsIndex;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{

    public function index(TagIndex $request)
    {
//        $tags = map_collection(Tag::all());
//        return view('tags',[
//            'tags' => $tags
//        ]);

        if (Auth::user()->can('tags.manage')){
            $tags = map_collection(Tag::orderBy('created_at','desc')->get());
            $uri = '/api/v1/tags';
        }else{
            $tags = map_collection($request->user()->tasks);
            $uri = '/api/v1/user/tags';
        }
        $users = map_collection(User::all());
        return view('tags',compact('tags','users','uri'));
    }

}
