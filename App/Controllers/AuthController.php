<?php


namespace App\Controllers;


class AuthController extends Controller
{
    private $responser;

    public function __construct($responser)
    {
        $this->responser = $responser;
    }
    public function index()
    {
        $this->responser->set([], 200);
        return $this->responser->response();
    }
}