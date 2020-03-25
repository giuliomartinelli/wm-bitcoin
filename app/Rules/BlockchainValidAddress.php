<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Blockchain\Blockchain;

class BlockchainValidAddress implements Rule
{
    private $blockchain;
    private $msg;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->blockchain = new Blockchain();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $address = $this->blockchain->Explorer->getHash160Address($value);
            return true;
        } catch (\Exception $e) {
            $this->msg = $e->getMessage();
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
