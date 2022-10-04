<?php

namespace App\Views;

class Responser
{
    private array|null $data;
    private array $statuses = [
        100 => 'Continue',
        200 => 'OK',
        201 => 'Created',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error',
    ];
    private string $code;

    public function set(array|null $data, string $code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    public function response()
    {
        header("HTTP/1.1 " . $this->code . ' ' . $this->statuses[$this->code]);
        header('Content-Type: application/json; charset=utf-8');
        if(!is_null($this->data)) {
            return json_encode($this->data);
        } else {
            return null;
        }
    }
}