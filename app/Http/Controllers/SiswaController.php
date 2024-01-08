<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
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
    public function edit($id)
    {
        $lembagas = Lembaga::all();
        $siswa = Siswa::findOrFail($id);
        return view('editsiswa', compact('siswa', 'lembagas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lembaga' => 'required',
            'nis' => 'required|string',
            'nama' => 'required|string',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->lembaga = $request->lembaga;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->email = $request->email;

        
        if ($request->hasFile('foto')) {
          
            if ($siswa->foto) {
                File::delete(public_path('images/' . $siswa->foto));
            }

           
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $siswa->foto = $imageName;
        }

        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Siswa updated successfully');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

       
        if ($siswa->foto) {
            File::delete(public_path('images/' . $siswa->foto));
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa deleted successfully');
    }
    
}
