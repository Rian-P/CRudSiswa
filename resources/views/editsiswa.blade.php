@extends('layouts.app')
@section('content')

<form class="max-w-sm mx-auto" method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT') <!-- Tambahkan method PUT untuk menyatakan bahwa ini adalah request update -->

  <div class="mb-5">
    <label for="lembaga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lembaga Siswa</label>
    <select id="lembaga" name="lembaga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
      @foreach($lembagas as $lembaga)
      <option value="{{ $lembaga->lembaga }}" {{ $siswa->lembaga == $lembaga->lembaga ? 'selected' : '' }}>{{ $lembaga->lembaga }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-5">
    <label for="nis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIS</label>
    <input type="text" id="nis" name="nis" pattern="[0-9]+" value="{{ $siswa->nis }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
  </div>
  <div class="mb-5">
    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Siswa</label>
    <input type="text" id="nama" name="nama" value="{{ $siswa->nama }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
  </div>
  <div class="mb-5">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
    <input type="email" id="email" name="email" value="{{ $siswa->email }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
  </div>
  <div class="mb-5">
    <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto (JPG/PNG, max 100KB)</label>
    <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
    @if ($siswa->foto)
      <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Foto Saat Ini: {{ $siswa->foto }}</p>
    @endif
  </div>

  <!-- ... other fields ... -->
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Siswa</button>
</form>

@endsection
