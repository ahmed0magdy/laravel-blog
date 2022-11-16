<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            request()->validate([
                'title' => ['required', 'min:3'],
                'description' => ['required', 'min:5']
            ],[
                'title.required' => 'my custom validation error message',
                 'title.min' => 'we have made override for min'
         ]
            )
        ];
    }

    /**
 * Get the error messages for the defined validation rules.  NOT WORKING DONT KNOW WHY???
 *
 * @return array
 */
// public function messages()
// {
//     return [
//            'title.required' => 'my custom validation error message',
//             'title.min' => 'we have made override for min'
//     ];
// }

}
