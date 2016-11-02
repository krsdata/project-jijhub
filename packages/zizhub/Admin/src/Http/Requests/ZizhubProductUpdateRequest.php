<?php

namespace Zizhub\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class ZizhubProductUpdateRequest extends Request {

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
                        'product_order' => "required|integer"                      
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
