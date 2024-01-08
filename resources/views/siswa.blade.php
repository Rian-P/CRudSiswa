@extends('layouts.app')

@section('content')
<div class="mb-14 mt-5">
    <a href="{{ route('siswa.tambah') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Siswa</a>
</div>

<div class="overflow-x-auto">
    <form action="{{ route('siswa.index') }}" method="GET" class="mb-4">
        <div class="flex items-center space-x-4">
            <input type="text" name="search" placeholder="Search by NIS or Name" class="border p-2">
            <select name="lembaga" class="border p-2">
                <option value="" selected disabled>Select Lembaga</option>
                @foreach ($lembagas as $lembaga)
                <option value="{{ $lembaga->lembaga }}">{{ $lembaga->lembaga}}</option>
                @endforeach
            </select>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Search</button>
        </div>
    </form>
    <div class="mb-14 mt-5">
        <a id="exportExcelBtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Export to Excel
        </a>
    </div>

    <table id="siswaTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="mb-10 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Lembaga
                </th>
                <th scope="col" class="px-6 py-3">
                    NIS
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Foto
                </th>

            </tr>
        </thead>
        <tbody>
            @forelse ($siswaList as $siswa)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $siswa->lembaga }}
                </td>
                <td class="px-6 py-4">
                    {{ $siswa->nis }}
                </td>
                <td class="px-6 py-4">
                    {{ $siswa->nama }}
                </td>
                <td class="px-6 py-4">
                    {{ $siswa->email }}
                </td>
                <td class="px-6 py-4">
                    <img src="{{ asset('images/' . $siswa->foto) }}" alt="Foto Siswa" class="w-12 h-12"> {{ $siswa->foto }}
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center">No records found</td>
            </tr>
            @endforelse
        </tbody>
    </table>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<script>
    document.getElementById('exportExcelBtn').addEventListener('click', function() {
        // Ambil elemen tabel
        var table = document.getElementById('siswaTable');

        // Ambil data dari tabel
        var data = XLSX.utils.table_to_book(table).Sheets.Sheet1;

        // Buat file Excel dari data
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, data, 'Sheet1');

        // Simpan file Excel
        XLSX.writeFile(wb, 'siswa.xlsx');
    });
</script>

<script>
    $(document).ready(function() {
        $('#siswaTable').DataTable({
            searching: false
        });
    });
</script>
@endsection