<?php

if (!function_exists('filterPost')) {
    /**
     * Checks post for the presence of html tags
     *
     * @param $res
     * @return string
     */
    function filterPost($res) {
        return htmlspecialchars(strip_tags($res));
    }
}

if ( ! function_exists('createCodeFromEmail'))
{
    function createCodeFromEmail($email)
    {
        return md5($email.time());
    }
}


if (!function_exists('sendError')) {
    /**
     * Send error response
     * @param string $text - error text
     * @param int $httpCode - http error code 4xx or 5xx
     */
    function sendError($text, $httpCode = 500)
    {
        http_response_code((int)$httpCode);
        echo json_encode(['text' => $text]);
        exit;
    }
}