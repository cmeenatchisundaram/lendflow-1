<?php

namespace App\Http\Controllers;

use App\Http\Requests\NytBestSellersRequest;
use App\Services\Nyt\NytBestSellersDataService;
use Illuminate\Http\JsonResponse;

class NytBestSellersController extends Controller
{
    /**
     * calling from /api/1/nyt/best-sellers to collect the data from nyt endpoints
     *
     * @param NytBestSellersRequest $request
     * @return JsonResponse
     */
    public function getBestSellers(NytBestSellersRequest $request) : JsonResponse
    {
        return NytBestSellersDataService::make($request)->getAll();
    }
}
