<?php

namespace App\Http\Controllers;


use App\Models\siswa;
use App\Models\lembaga;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
     
        $lembagas = Lembaga::all();

       
        $query = Siswa::query();

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nis', 'like', '%' . $request->search . '%')
                    ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('lembaga')) {
            $query->where('lembaga', $request->lembaga);
        }

        $siswaList = $query->paginate(10);

       
        return view('siswa', compact('siswaList', 'lembagas'));
    }

    
        
    
    public function create()
    {
        $lembagas = lembaga::all();
        return view('tambahsiswa', compact('lembagas'));
    }
    public function store(Request $request)
    {
     
        $request->validate([
            'lembaga' => 'required',
            'nis' => 'required|string',
            'nama' => 'required|string',
            'email' => 'required|email',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
        $siswa = new siswa;
        $siswa->lembaga = $request->lembaga;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->email = $request->email;

       
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $siswa->foto = $imageName;
        }

        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Siswa added successfully');
    }

    
}
