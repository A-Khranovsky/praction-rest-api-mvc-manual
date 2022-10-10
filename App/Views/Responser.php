<?php

namespace App\Views;

class Responser
{
    private array|null $data;
    private array $statuses = [
        200 => 'OK',
        201 => 'Created',
        204 => 'No Content',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error',
    ];
    private string $code;

    public function set(array|null $data, string $code)
    {
        $this->code = $code;
        $this->data = $data;
        if (!is_null($data)) {
            if (count($data) == 0) {
                $this->code = 204;
            }
        }
    }

    public function response()
    {
        header("HTTP/1.1 " . $this->code . ' ' . $this->statuses[$this->code]);
        header('Content-Type: application/json; charset=utf-8');
        return !$this->data ? null : json_encode($this->data);
    }
}
