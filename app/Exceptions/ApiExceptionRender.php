<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ApiExceptionRender
{
    /**
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function default(\Exception $exception)
    {
        $data = [
            'meta' => [
                'status' => __('response.error'),
                'message' => $exception->getMessage(),
            ]
        ];

        return response()->json($data, $exception->getCode());
    }

    /**
     * Exception for ValidationException
     *
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationException(\Exception $exception)
    {
        $data = [
            'meta' => [
                'status' => __('response.error'),
                'message' => $exception->getMessage(),
            ]
        ];
        $fields = $exception->errors();

        if ($fields) {
            $errors = [];
            foreach ($fields as $key => $value) {
                $errors[$key] = reset($value);
            }

            $data['meta']['errors'] = $errors;
        }

        return response()->json($data, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticationException(\Exception $exception)
    {
        $data = [
            'meta' => [
                'status' => __('response.error'),
                'message' => $exception->getMessage(),
            ]
        ];

        return response()->json($data, \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
    }

    public function invalidPasswordException(\Exception $exception)
    {
        return $this->default($exception);
    }

    public function authorizationException(\Exception $exception)
    {
        $data = [
            'meta' => [
                'status' => __('response.error'),
                'message' => $exception->getMessage(),
            ]
        ];

        return response()->json($data, \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
    }
}
