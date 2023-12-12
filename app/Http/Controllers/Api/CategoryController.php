<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiTrait;

class CategoryController extends Controller
{
    use ApiTrait;

    public function getCategories()
    {

        $Categories = Category::orderBy('id')->get();
        if ($Categories)
            return $this->apiResponse($Categories, 'fetch categories successfully.');

        return $this->apiResponse(null, 'not found categories', 404);

    }
}
