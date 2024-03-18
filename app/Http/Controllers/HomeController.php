<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Penghargaan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

    return view('home');

       

        
       
    }

}
