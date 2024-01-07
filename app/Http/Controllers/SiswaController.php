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
        // Fetch lembaga data
        $lembagas = Lembaga::all();

        // Fetch siswa data and apply filters
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

        // Pass lembaga data to the view
        return view('siswa', compact('siswaList', 'lembagas'));
    }

    public function exportExcel(Request $request)
    {
        $lembaga = $request->input('lembaga', null);
        $search = $request->input('search', null);

        $query = Siswa::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nis', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%');
            });
        }

        if ($lembaga) {
            $query->where('lembaga', $lembaga);
        }

        $siswaData = $query->get();

        $excelData = [];

        // Customize this loop based on your Siswa model attributes
        foreach ($siswaData as $siswa) {
            $excelData[] = [
                'ID' => $siswa->id,
                'Lembaga' => $siswa->lembaga,
                'NIS' => $siswa->nis,
                'Nama' => $siswa->nama,
                'Email' => $siswa->email,
                // Add more data as needed
            ];
        }

        $fileName = 'siswa.xlsx';

        return Excel::download(function () use ($excelData) {
            $handle = fopen('php://output', 'w');

            // Add headers
            fputcsv($handle, array_keys($excelData[0]));

            // Add data
            foreach ($excelData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $fileName);
    }
    public function create()
    {
        $lembagas = lembaga::all();
        return view('tambahsiswa', compact('lembagas'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'lembaga' => 'required',
            'nis' => 'required|string',
            'nama' => 'required|string',
            'email' => 'required|email',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Save the data to the 'siswa' table
        $siswa = new siswa;
        $siswa->lembaga = $request->lembaga;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->email = $request->email;

        // Handle file upload for 'foto'
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
