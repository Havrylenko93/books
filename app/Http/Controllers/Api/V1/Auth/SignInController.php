<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SignInRequest;
use App\Http\Resources\SignInResource;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Response;

class SignInController extends Controller
{
    /** @var AuthServiceInterface  */
    protected $authService;

    /**
     * SignInController constructor.
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param SignInRequest $request
     * @return mixed
     */
    public function __invoke(SignInRequest $request)
    {
        return Response::success(new SignInResource($this->authService->ApiSignIn($request->all())));
    }
}
