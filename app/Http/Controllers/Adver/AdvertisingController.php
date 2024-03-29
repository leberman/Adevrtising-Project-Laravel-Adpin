<?php

declare(strict_types=1);

namespace App\Http\Controllers\Adver;

use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdvertisingController extends BaseController
{
    /**
     * list rules for check field input
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:32',
            'slug' => 'string|min:2|max:32',
            'brand' => 'required|integer',
            'model' => 'required|integer',
        ];
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules());
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        return true;
    }
}
