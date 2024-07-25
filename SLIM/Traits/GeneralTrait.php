<?php


namespace SLIM\Traits;


use SLIM\Constants\HttpStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

Trait GeneralTrait
{
    public function returnError($message, $code): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }

    public function returnSuccessMessage($message = ""): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message
        ], HttpStatus::OK);

    }

    public function returnData($value, $message): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'Data' => $value
        ], HttpStatus::OK);
    }

    public function returnDateWithPaginate($value,$resourcePath,$message)
    {

        return response()->json([
            'success' => 'true',
            'message' => $message,
            'items' => $resourcePath::collection($value),
            'size' => $value->count(),
            'page' => $value->currentPage(),
            'total_pages' => $value->lastPage(),
            'total_size' =>$value->total(),
            'per_page' => $value->perPage(),
        ]);
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnError($validator->errors(), HttpStatus::UNPROCESSABLE_CONTENT));
    }

}
