<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyMobile\VerifyMobileIndex;


/**
 * Class VerifyMobileController.
 *
 * @package App\Http\Controllers\Tenant\Web
 */
class VerifyMobileController extends Controller
{
    /**
     * @param ShowUsersManagement $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(VerifyMobileIndex $request)
    {
        return view('users.sms.index');
    }

}
