<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OnlyGender implements Rule
{
   
    protected $allowedStrings;

    public function __construct(array $allowedStrings)
    {
       $this->allowedStrings = $allowedStrings;
    }

    
    
    public function passes($attribute, $value)
    {
        return in_array($value, $this->allowedStrings);
    }

  
    public function message()
    {
        return 'The :attribute must be one of the allowed values: ' . implode(', ', $this->allowedStrings);
    }
}
