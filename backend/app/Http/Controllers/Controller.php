<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Returns request input data
     *
     * @param array $fields
     * @return array
     */
    protected function input(array $fields = []): array
    {
        return $fields ? request()->only($fields) : json_decode(request()->getContent(),true);
    }

    /**
     * Returns successful response as JSON
     *
     * @param array $response_data
     * @param int $code
     * @return JsonResponse
     */
    protected function success(mixed $response_data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'data' => $response_data
        ], $code);
    }

    /**
     * Returns error response as JSON
     *
     * @param array|string $error_data
     * @param int $code
     * @return JsonResponse
     */
    protected function error(array|string $error_data, int $code = 400): JsonResponse
    {
        return response()->json([
            'status' => 'nok',
            'errors' => is_array($error_data) ? $error_data : ['message' => $error_data]
        ], $code);
    }

    /**
     * Validates current request input data. If $model is provided, then model's validation rules
     * are also taken into account
     *
     * @param array $input
     * @param array $custom_rules
     * @param Model|null $model
     * @return array|null
     */
    protected function validateInput(array $input, array $rules = [], ?Model $model = null): array|null
    {
        if ($model)
        {
            if (method_exists($model, 'getValidationRules'))
            {
                $rules += $model->getValidationRules();
            }
        }

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return $validator->getMessageBag()->toArray();
        }

        return null;
    }

    protected function searchInput(array $fields = []): array
    {
        return $fields ? request()->only($fields) : json_decode(request()->getContent(),true);
    }
}
