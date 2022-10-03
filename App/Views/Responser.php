<?php

namespace App\Views;

class Responser
{
    private array $data;
    private $statuses = [
        200 => 'OK',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error',
    ];
    private $code;
    private $message;

    public function set(array $data, string $code, string $message = '')
    {
        $this->data = $data;
        $this->code = $code;
        $this->message = $message;
    }

    public function response()
    {
        header("HTTP/1.1 " . $this->code . $this->statuses[$this->code] ?? $this->message);
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($this->data);
    }
}