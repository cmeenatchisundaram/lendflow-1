<?php

namespace App\Http\Requests;

use App\Rules\AuthorRule;
use App\Rules\IsbnRule;
use App\Rules\OffsetRule;
use App\Rules\TitleRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NytBestSellersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // params for the getbestsellersrequest
            'author'    => [new AuthorRule()],
            'isbn'      => [new IsbnRule()],
            'title'     => [new TitleRule()],
            'offset'    => [new OffsetRule()]
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation Errors',
            'data'      => $validator->errors()
        ],422));
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'author'    => 'The author validation fails',
            'isbn'      => 'The isbn validation fails',
            'title'     => 'The title validation fails',
            'offset'    => 'The offset validation fails'
        ];
    }
}
