<?php

namespace App\Http\Controllers;
use App\Models\lembaga;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    public function index(){
        return view ('lembaga');
    }
    public function tambahlembaga(Request $request){
        $lembaga = lembaga::create($request->all());
        return redirect()->route('siswa.index');
    }
}
