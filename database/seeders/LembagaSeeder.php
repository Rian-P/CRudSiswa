<?php

namespace Database\Seeders;
use App\Models\lembaga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = [
            ['lembaga' => 'Lembaga A'],
            ['lembaga' => 'Lembaga B'],
            ['lembaga' => 'Lembaga C'],
        ];

        
        foreach ($data as $item) {
            lembaga::create($item);
        
    }}
}
