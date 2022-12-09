<?php
namespace App\Services\Nyt;

use App\Http\Requests\NytBestSellersRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

final class NytBestSellersDataService
{
    /**
     * @var Collection|null
     */
    private ?Collection $params = null;

    /**
     * @param NytBestSellersRequest $request
     */
    private function __construct(NytBestSellersRequest $request)
    {
        $this->params = $request->safe()->collect(['author','isbn','title','offset']);
    }

    /**
     * @param NytBestSellersRequest $request
     * @return static
     */
    public static function make(NytBestSellersRequest $request) : self
    {
        return new self($request);
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        try
        {
            //making http get request with nyt endpoint
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->get(env('NYT_API_ENDPOINT'),
                $this->params->merge([
                    //attaching the api key to the body
                    'api-key'=>env('NYT_API_KEY'),
                ])->toArray()
            );

            return response()->json(['response'=>$response->json()],200);
        }
        catch(\Exception $e)
        {
            if(app()->environment() != 'production')
            {
                return response()->json([
                    'error'     => 'Something went wrong while trying to get all data !. Please try again later',
                    'message'   => $e->getMessage()
                ],500);
            }
            else
            {
                return response()->json(['error' => 'Something went wrong while trying to get all data !. Please try again later'],500);
            }
        }
    }
}
