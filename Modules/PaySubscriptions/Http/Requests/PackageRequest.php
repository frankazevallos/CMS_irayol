<?php

namespace Modules\PaySubscriptions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'description' => 'required|string|min:1',
            'interval' => 'required|in:days,weeks,months,years',
            'interval_count' => 'required|integer',
            'trial_days' => 'required|integer',
            'price' => 'required|numeric',
            'sort_order' => 'integer',
            'is_active' => 'nullable|boolean',
            'is_private' => 'nullable|boolean',
            'is_one_time' => 'nullable|boolean',
            'enable_custom_link' => 'nullable|boolean',
            'custom_link' => 'nullable|string|min:1|max:255',
            'custom_link_text' => 'nullable|string|min:1|max:255',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
