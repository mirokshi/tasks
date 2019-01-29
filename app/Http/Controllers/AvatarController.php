<?php

namespace App\Http\Controllers;


use App\Avatar;
use App\Http\Requests\Photos\AvatarStore;


class AvatarController extends Controller
{

    public function store(AvatarStore $request)
    {
        $extension = $request->file('avatar')->getClientOriginalExtension();
        $path = $request->file('avatar')->storeAs(
            'photos', $request->user()->id. '.'. $extension
        );
        $request->file('avatar')->storeAs(
            '',$request->user()->id. '.'. $extension,'google'
        );
        if ($photo = Avatar::where('user_id',$request->user()->id)->first()) {
            $photo->url = $path;
            $photo->save();
        } else {
            Avatar::create([
                'url' => $path,
                'user_id' => $request->user()->id
            ]);
        }
        return back();
    }

    public function storeExamples(AvatarStore $request)
    {
        //Nom definit per Laravel amb un sistema per evitar colisions:
        $path = $request->file('avatar')->store('photos');
//        $path = Storage::putFile('photos', $request->file('avatar'));
        //CustomFileName
        $path = $request->file('avatar')->storeAs(
            'photos', $request->user()->id
        );
        //CustomFileName with extension
        $path = $request->file('avatar')->storeAs(
            'photos', $request->user()->id
        );
        // Specificar un disk
//        $path = $request->file('avatar')->store(
//            'photos/'.$request->user()->id, 's3'
//        );
        dump($path);
        return Avatar::create([
            'url' => $path
        ]);
    }
}
