<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\FinancialInstitution\FinancialInstitutionResource;
use App\Models\FinancialInstitution;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class FinancialInstitutionController extends Controller
{
    //list all
    public function index() : AnonymousResourceCollection
    {
        $fis = FinancialInstitution::all();
        return FinancialInstitutionResource::collection($fis);
    }
}
