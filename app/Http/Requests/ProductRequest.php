<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    protected $product_rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|integer',
        'quantity' => 'required|integer'
    ];


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
     * @return array<string, mixed>
     */


    public function rules(): array
    {
        return match ($this->method()) {
            'PUT' => $this->updateProductRules(),
            default => $this->dose_rules,
        };
    }


    private function updateProductRules(): array
    {
        return $this->product_rules;
    }
}
