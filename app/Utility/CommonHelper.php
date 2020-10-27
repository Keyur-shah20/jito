<?php

namespace App\Utility;

class CommonHelper {

    const WEB_REDIRECT = 515;

    /**
     * Generate Json Response
     *
     * @param  boolean  $status
     * @param  string  $message
     * @param  integer  $statusCode
     * @param  array  $data
     * @param  array  $error
     * @param  string  $url
     *
     * @return \Illuminate\Http\Response
     */
    public function generateResponse($status = false, $message = NULL, $statusCode = 200, $data = array(), $error = array(), $url = '') {
        $response["status"] = $status;
        $response["message"] = $message;
        $response["data"] = empty($data) ? (object) $data : $data;
        $response["error"] = empty($error) ? (object) $error : $error;

        if (self::WEB_REDIRECT === $statusCode) {
            return redirect($url);
        }

        return response()->json($response, $statusCode);
    }
}