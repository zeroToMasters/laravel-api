<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListadoDeVideosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'limit' => 'integer',
        ];
    }

    public function getLimit()
    {
        return $this->get('limit');
    }
}
