<?php

namespace Modules\PaySubscriptions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|numeric',
            'package_id' => 'required|numeric',
            'status' => 'required|in:approved,waiting,declined',
            'start_date' => 'required|date',
            'trial_end_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'created_id' => 'nullable|numeric',
            'package_price' => 'nullable|numeric',
            'package_details' => 'nullable|string',
            'paid_via' => 'nullable|string',
            'payment_transaction_id' => 'nullable|string',
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
