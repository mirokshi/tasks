<?php

namespace App\Http\Controllers\Api\Changelog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Changelog\ListChangelog;
use App\Log;


/**
 * Class ChangelogController
 */
class ChangelogController extends Controller
{
    /**
     * @param ListChangelog $request
     *
     * @return mixed
     */
    public function index(ListChangelog $request)
    {
        return map_collection(Log::all());
    }
}
