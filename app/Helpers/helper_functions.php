<?php
function getMessageText($status_code)
{

$message_text = "";

// get error text
$message_text_200 = config('constants.message_text.200');
$message_text_201 = config('constants.message_text.201');
$message_text_401 = config('constants.message_text.401');
$message_text_403 = config('constants.message_text.403');
$message_text_404 = config('constants.message_text.404');
$message_text_422 = config('constants.message_text.422');
$message_text_500 = config('constants.message_text.500');

switch ($status_code) {

case 200:
$message_text = $message_text_200;
break;
case 201:
$message_text = $message_text_201;
break;
case 401:
$message_text = $message_text_401;
break;
case 403:
$message_text = $message_text_403;
break;
case 404:
$message_text = $message_text_404;
break;
case 422:
$message_text = $message_text_422;
break;
case 500:
$message_text = $message_text_500;
break;
default:
$message_text = $message_text_422;
}

return $message_text;
}

function getErrorCode($status_code)
{

    $error_code = "";

    // get error text
    $message_text_200 = config('constants.message_text.200');
    $message_text_201 = config('constants.message_text.201');
    $message_text_401 = config('constants.message_text.401');
    $message_text_403 = config('constants.message_text.403');
    $message_text_404 = config('constants.message_text.404');
    $message_text_422 = config('constants.message_text.422');
    $message_text_500 = config('constants.message_text.500');

    switch ($status_code) {

        case 200:
            $error_code = 0;
            break;
        case 201:
            $error_code = 0;
            break;
        case 401:
            $error_code = 1;
            break;
        case 403:
            $error_code = 1;
            break;
        case 404:
            $error_code = 1;
            break;
        case 422:
            $error_code = 1;
            break;
        case 500:
            $error_code = 1;
            break;
        default:
            $error_code = 0;
    }

    return $error_code;
}

/*
* $status_code - Message status code
* $message - The message to display
* $data - object to display inside data tag
* $data_tag - tag name for data tag. if unspecified, data is used
* $error - whether message is error or not. 0 - no error, 1 - error
* $has_data_tag - whether message has a data tag
* $headers - specify any headers that should be added in response
* $show_message - specify whether show_message will be set to true, for frontend msg display
*/
function showCompoundMessage(
$status_code = "200",
$message = "",
$data = "",
$data_tag = "",
$error = "",
$has_data_tag = false,
$headers = null,
$show_message = false
) {

$show_message = $show_message ? $show_message : false;

$final_message = [];

if (!$message) {
$message = getMessageText($status_code);
}

if ($data) {
$data = json_decode(json_encode($data));
}

if (!$error) {
$error = getErrorCode($status_code);
}

// generate message
$final_message['message'] = $message;
$final_message['show_message'] = $show_message;
$final_message['status_code'] = $status_code;
$final_message['error'] = $error;

if ($data) {

// get the tag
$the_tag = $data_tag ? $data_tag : 'data';

// if the json has already been transformed with data tag, don't add extra data
if ($has_data_tag) {
$final_message = $data;
} else {
$final_message[$the_tag] = $data;
}
} /* else {
$final_message['data'] = "";
} */

$response = response()->json($final_message, $status_code);

if ($headers) {
$response = $response->withHeaders($headers);
}

return $response;
}
