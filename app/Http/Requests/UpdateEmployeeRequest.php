<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\HeadValidationRule;
use App\Rules\HierarchyRule;
use App\Rules\SalaryMaximumRule;

class UpdateEmployeeRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:2|max:256',
            'email' => 'required|email:rfc',
            'phone' => 'required',
            'salary' => [new SalaryMaximumRule(), 'gte:0', 'required'],
            'position_id' => 'required',
            'photo' => 'mimes:jpg,png|max:5000|dimensions:min_width=300,min_height=300',
            'employment_date' => 'required|before_or_equal:today|date_format:d.m.y',
        ];

        $all = $this->all();

        if ($all['head'] !== null) {
           $rules['head'] = [new HeadValidationRule(), new HierarchyRule()];
        }

        return $rules;
    }
}
