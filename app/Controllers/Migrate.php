<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Throwable;
class Migrate extends BaseController
{
    public function index()
    {
        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();
            echo "Success";
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}
