<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Traits\ApiTrait;

class AudioController extends Controller
{
    use ApiTrait;

    public function getAudios()
    {

        $Audios = Audio::leftJoin('categories', 'categories.id', 'audios.category_id')
            ->select('audios.*', 'categories.name as category_name', 'categories.name_ar as category_name_ar')
            ->get();

        if ($Audios)
            return $this->apiResponse($Audios, 'fetch audios successfully.');

        return $this->apiResponse(null, 'not found audios', 404);

    }
}
