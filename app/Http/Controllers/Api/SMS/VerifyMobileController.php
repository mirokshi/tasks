<?php

namespace App\Http\Controllers\Api\SMS;


use App\CodeGenerator\MobileCodesGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyMobile\VerifyMobileStore;
use App\Notifications\VerifyMobile;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

/**
 * Class VerifyMobileController.
 *
 * @package App\Http\Controllers\Tenant\Api\SMS
 */
class VerifyMobileController extends Controller
{
    public function store(VerifyMobileStore $request, User $user)
    {
        if ($request->code === $user->mobile_verification_code) {
            $user->mobile_verified_at = Carbon::now();
            $user->mobile_verification_code = null;
            $user->save();
        }
        else abort(422,'El codi proporcionat no és correcte');
    }

    public function send(Request $request, User $user)
    {

        $code = MobileCodesGenerator::generate();
        $user->mobile_verification_code = $code;
        $user->save();

        $user->notify(new VerifyMobile($code));

    }
}
