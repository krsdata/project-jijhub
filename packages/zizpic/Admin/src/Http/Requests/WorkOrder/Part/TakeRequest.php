<?php

namespace Inventory\Admin\Http\Requests\WorkOrder\Part;

use Inventory\Admin\Http\Requests\Request as BaseRequest;

class TakeRequest extends BaseRequest
{
    /**
     * The take request validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|positive|greater_than:0|enough_quantity',
        ];
    }

    /**
     * Allows all users to attach stock to work orders.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
