<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class ApiResponseMacrosServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data = [], int $code = Response::HTTP_OK, array $headers = []): JsonResponse {
            $response = ['meta' => ['status' => __('response.success')]];

            $response = array_merge(['data' => $data], $response);

            return response()->json($response, $code, $headers);
        });

        Response::macro('error', function ($message, $responseCode): JsonResponse {
            return response()->json([
                'meta' => [
                    'status' => __('response.error'),
                    'message' => $message,
                ]
            ], $responseCode);
        });
    }
}
