<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $memo = new \App\Models\Memo();
            $memo->title = "タイトル" . $i;
            $memo->body = "テスト内容\nテスト内容\nテスト内容" . $i;
            $memo->save();
        }

        $this->call([
            MemoSeeder::class,
        ]);
    }
}
