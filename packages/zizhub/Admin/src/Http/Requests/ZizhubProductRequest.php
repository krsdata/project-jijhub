<?php

namespace Zizhub\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class ZizhubProductRequest extends Request {

    /**
     * The metric validation rules.
     *
     * @return array
     */
    public function rules() {
        //if ( $metrics = $this->metrics ) {
        switch ( $this->method() ) {
            case 'GET':
            case 'DELETE': {
                    return [ ];
                }
            case 'POST': {
                    return [
                        'pname'         => "required|max:250" ,
                        'product_order' => "required|integer" ,
                        'product_img'   => "image|mimes:png,jpg,jpeg|required"
                    ];
                }
            case 'PUT':
            case 'PATCH': {

                    return [
                        'name'       => 'required' ,
                        'exp_date'   => 'required|date' ,
                        'used_limit' => "required" ,
                        'amount_usd' => "required" ,
                        'amount_nis' => "required" ,
                        'package'    => "required" ,
                    ];
                }
            default:break;
        }
        //}
    }

    /**
     * The
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
