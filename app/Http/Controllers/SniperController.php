<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SniperController extends Controller
{
    public function index() {
        $words = [
            "storm","blade","shadow","pixel","fire","rapid","ghost",
            "slice","aim","flash","nova","spark","racer","speed","sniper"
        ];

        return view('sniper.index', compact('words'));
    }
}
