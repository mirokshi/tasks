<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GitIndex;
use Cache;

/**
 * Class GitController.
 */
class GitController extends Controller
{
    /**
     * Index.
     *
     * @param GitIndex $request
     *
     * @return mixed
     */
    public function index(GitIndex $request)
    {
        Cache::forget('git_info');

        return git();
    }
}
