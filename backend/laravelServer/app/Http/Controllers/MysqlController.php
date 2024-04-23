<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class MysqlController extends Controller
{
    public function checkConnection()
    {
        try {
            DB::connection()->getPdo();
            echo "MySQL連線正常！";
        } catch (\Exception $e) {
            die("無法連線到MySQL資料庫：" . $e->getMessage());
        }
    }

}