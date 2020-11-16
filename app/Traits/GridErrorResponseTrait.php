<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GridErrorResponseTrait
{
    /**
     * Abort call if zero result returned.
     *
     * @param  array $model
     * @return \Illuminate\Http\Response
     */
    public function handleGridError($view, $code = null)
    {
        $query = request()->all();

        if (array_key_exists('error', $query)) {
            $err = $this->statusCode($query['error']) ? 200 : 404;
        }

        $view = view()->exists($view.'.'.$code) ? $view.'.'.$code : $view.'.404';
        $html = view($view)->render();

        return response()->json(['html' => $html])->setStatusCode($err ?? 404)->send();
    }

    private function statusCode($status)
    {
        //return "404";
        $err = null;
        switch ($status) {
            case 'Continue': $err = 100;
                break;
            case 'Switching Protocols': $err = 101;
                break;
            case 'Processing': $err = 102;
                break;
            case 'OK': $err = 200;
                break;
            case 'Created': $err = 201;
                break;
            case 'Accepted': $err = 202;
                break;
            case 'Non-authoritative Information': $err = 203;
                break;
            case 'No Content': $err = 204;
                break;
            case 'Reset Content': $err = 205;
                break;
            case 'Partial Content': $err = 206;
                break;
            case 'Multi-Status': $err = 207;
                break;
            case 'Already Reported': $err = 208;
                break;
            case 'IM Used': $err = 226;
                break;
            case 'Multiple Choices': $err = 300;
                break;
            case 'Moved Permanently': $err = 301;
                break;
            case 'Found': $err = 302;
                break;
            case 'See Other': $err = 303;
                break;
            case 'Not Modified': $err = 304;
                break;
            case 'Use Proxy': $err = 305;
                break;
            case 'Temporary Redirect': $err = 307;
                break;
            case 'Permanent Redirect': $err = 308;
                break;
            case 'Bad Request': $err = 400;
                break;
            case 'Unauthorized': $err = 401;
                break;
            case 'Payment Required': $err = 402;
                break;
            case 'Forbidden': $err = 403;
                break;
            case 'Not Found': $err = 404;
                break;
            case 'Method Not Allowed': $err = 405;
                break;
            case 'Not Acceptable': $err = 406;
                break;
            case 'Proxy Authentication Required': $err = 407;
                break;
            case 'Request Timeout': $err = 408;
                break;
            case 'Conflict': $err = 409;
                break;
            case 'Gone': $err = 410;
                break;
            case 'Length Required': $err = 411;
                break;
            case 'Precondition Failed': $err = 412;
                break;
            case 'Payload Too Large': $err = 413;
                break;
            case 'Request-URI Too Long': $err = 414;
                break;
            case 'Unsupported Media Type': $err = 415;
                break;
            case 'Requested Range Not Satisfiable': $err = 416;
                break;
            case 'Expectation Failed': $err = 417;
                break;
            case "I'm a teapot": $err = 418;
                break;
            case 'Misdirected Request': $err = 421;
                break;
            case 'Unprocessable Entity': $err = 422;
                break;
            case 'Locked': $err = 423;
                break;
            case 'Failed Dependency': $err = 424;
                break;
            case 'Upgrade Required': $err = 426;
                break;
            case 'Precondition Required': $err = 428;
                break;
            case 'Too Many Requests': $err = 429;
                break;
            case 'Request Header Fields Too Large': $err = 431;
                break;
            case 'Connection Closed Without Response': $err = 444;
                break;
            case 'Unavailable For Legal Reasons': $err = 451;
                break;
            case 'Client Closed Request': $err = 499;
                break;
            case 'Internal Server Error': $err = 500;
                break;
            case 'Not Implemented': $err = 501;
                break;
            case 'Bad Gateway': $err = 502;
                break;
            case 'Service Unavailable': $err = 503;
                break;
            case 'Gateway Timeout': $err = 504;
                break;
            case 'HTTP Version Not Supported': $err = 505;
                break;
            case 'Variant Also Negotiates': $err = 506;
                break;
            case 'Insufficient Storage': $err = 507;
                break;
            case 'Loop Detected': $err = 508;
                break;
            case 'Not Extended': $err = 510;
                break;
            case 'Network Authentication Required': $err = 511;
                break;
            case 'Network Connect Timeout Error': $err = 599;
                break;
            //default: $err = $status;
        }

        return $err;
    }
}
