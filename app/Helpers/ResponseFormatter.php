<?php

namespace App\Helpers;

/**
 * Format response.
 */
class ResponseFormatter
{
    /**
     * API Response
     *
     * @var array
     */
    // protected static $response = [
    //     'meta' => [
    //         'code' => 200,
    //         'status' => 'success',
    //         'message' => null,
    //     ],
    //     'data' => null,
    // ];
    protected static $response = [
        'response' => [
            'code' => 200,
            'status' => 'success',
            'message' => null,
            'data' => null,
        ],
    ];

    /**
     * Give success response.
     */
    public static function success($data = null, $message = null)
    {
        self::$response['response']['message'] = $message;
        self::$response['response']['data'] = $data;

        return response()->json(self::$response, self::$response['response']['code']);
    }

    /**
     * Give error response.
     */
    public static function error($data = null, $message = null, $code = 400)
    {
        self::$response['response']['status'] = 'error';
        self::$response['response']['code'] = $code;
        self::$response['response']['message'] = $message;
        self::$response['response']['data'] = $data;

        return response()->json(self::$response, self::$response['response']['code']);
    }
}
