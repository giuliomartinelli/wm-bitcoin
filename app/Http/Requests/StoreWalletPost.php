<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\BlockchainValidAddress;

class StoreWalletPost extends FormRequest
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
            'public_key' => ['required', 'unique:wallets', 'max:34', 'min:34', new BlockchainValidAddress()],
            'name' => ['required', 'max:32', 'min:1']
        ];
    }
}
