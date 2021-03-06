<?php

namespace App\Http\Requests\VerifyMobile;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class VerifyMobileStore.
 *
 * @package App\Http\Requests\SMS
 */
class VerifyMobileStore  extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|max:6'
        ];
    }
}
