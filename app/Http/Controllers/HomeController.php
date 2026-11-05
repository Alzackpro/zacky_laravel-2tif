<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\QuestionController;
class HomeController extends Controller
{
    public function index()
    {
        /* Cara 2 */
        $data = [
            'username'        => 'Zacky Alfizar',
            'last_login'      => date('Y-m-d H:i:s'),
            'list_pendidikan' => ['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3'],
        ];

        return view('home', $data);
    }
}
