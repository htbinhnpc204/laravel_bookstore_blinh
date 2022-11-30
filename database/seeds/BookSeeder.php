<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $books = [
            ['name' => 'Bến Xe (Tái Bản 2020)', 'tacgia' => 'Thương Thái Vi', 'nxb' => 'NXB Văn Học', 'giaban' => '61000', 'category_id' => 2, 'soluong' => 50],
            ['name' => 'Thiên Quan Tứ Phúc - Tập 4', 'tacgia' => 'Mặc Hương Đồng Khứu', 'nxb' => 'NXB Hà Nội', 'giaban' => '138000', 'category_id' => 2, 'soluong' => 50],
            ['name' => 'All In Love - Ngập Tràn Yêu Thương', 'tacgia' => 'Cố Tây Tước', 'nxb' => 'NXB Phụ nữ', 'giaban' => '95000', 'category_id' => 2, 'soluong' => 50],
            ['name' => 'Nhiệt Độ Xã Giao', 'tacgia' => 'Carbeeq', 'nxb' => 'NXB Hồng Đức', 'giaban' => '87000', 'category_id' => 2, 'soluong' => 50],
            ['name' => 'Thiên Quan Tứ Phúc - Tập 1', 'tacgia' => 'Mặc Hương Đồng Khứu', 'nxb' => 'NXB Văn Học', 'giaban' => '120000', 'category_id' => 2, 'soluong' => 50],
            ['name' => 'Không Có Kiếp Sau - Tập 1', 'tacgia' => 'Nguyệt Hạ Tang', 'nxb' => 'NXB Hà Nội', 'giaban' => '130000', 'category_id' => 2, 'soluong' => 50],
            ['name' => 'Quý Ngài Định Kiến', 'tacgia' => 'Khưu Trì', 'nxb' => 'NXB Thanh Niên', 'giaban' => '122180', 'category_id' => 2, 'soluong' => 50],
        ];

        DB::table('books')->insert($books);
    }
}
