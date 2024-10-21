<?php

/**
 * Process the response and send a JSON response with the corresponding status and message.
 *
 * @param  array $data {
 *     Array containing the response data.
 *
 *     @type int    $responseCode  Response HTTP code.
 *                                  Success codes:
 *                                  - 200: OK
 *                                  - 201: Created
 *                                  - 202: Accepted
 *                                  - 204: No Content
 *                                  Error codes:
 *                                  - 400: Bad Request
 *                                  - 401: Unauthorized
 *                                  - 403: Forbidden
 *                                  - 404: Not Found
 *                                  - 409: Conflict
 *     @type mixed  $data          (Optional) Additional data to return in the response.
 *     @type string $message       (Optional) A custom message for the response.
 *     @type array  $missing       (Optional) An array of input name that missing.
 *     @type string $responseType  (Optional) The content type of the response, default is 'application/json'.
 *     @type bool   $flush         (Optional) If true, the buffer is flushed without terminating the script.
 * }
 * @return void
 */

function finish($data) {

    $successCode = [
        200 => "OK", //success
        201 => "Created", //success + created
        202 => "Accepted", //success + in progress
        204 => "No Content", // success + no data
    ];

    $errorCode = [
        400 => "Bad Request", //bad request
        401 => "Unauthorized", //unauthorized because not logged
        403 => "Forbidden", //unauthorized but logged
        404 => "Not Found", //not found
        409 => "Conflict", //conflict with an existing element
    ];

    $code = $data['responseCode'];
    $statusType = "unknown";
    $status = 'unknown';

    if (array_key_exists($code, $successCode)) {
        // it is a success
        $status = $successCode[$code];
        $statusType = 'success';
    } elseif (array_key_exists($code, $errorCode)) {
        // its an error
        $status = $errorCode[$code];
        $statusType = 'error';
    }

    $responseType = "application/json";
    if (isset($data['responseType'])) {
        $responseType = $data['responseType'];
    }
    header("Content-Type: " . $responseType);

    $jsonRequest = array(
        "status" => $status,
        "statusType" => $statusType,
        "statusCode" => $data['responseCode'],
        "data" => (isset($data['data']) ? $data['data'] : null),
        "message" => (isset($data['message']) ? $data['message'] : null),
        "missing" => (isset($data['missing']) ? $data['missing'] : null),
    );

    echo json_encode($jsonRequest);

    if (isset($data['flush']) && $data['flush']) {
        flush();
        return;
    } else {
        exit;
    }
}
