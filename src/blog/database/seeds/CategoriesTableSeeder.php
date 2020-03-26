<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nameCategoryParent1 = "Sách Kiến Thức Tổng Hợp";
        $nameCategoryChild1_1 = "Kiến Thức Bách Khoa";
        $nameCategoryChild1_2 = "Lĩnh vực khác";
        $nameCategoryChild1_3 = "Thể Dục - Thể Thao";

        $nameCategoryParent2 = "Sách Kinh Tế";
        $nameCategoryChild2_1 = "Bài học kinh doanh";

        $nameCategoryParent3 = "Sách Thiếu Nhi";

        DB::table('categories')->insert([
            [   
                'name' => $nameCategoryParent1,
                'cover' => Str::random(10).'.png',
                'parent_id' => null,
                'slug' => Str::slug($nameCategoryParent1, '-'),
                'created_at' => now(),
            ],
            [   
                'name' => $nameCategoryParent2,
                'cover' => Str::random(10).'.png',
                'parent_id' => null,
                'slug' => Str::slug($nameCategoryParent2, '-'),
                'created_at' => now(),
            ],
            [   
                'name' => $nameCategoryParent3,
                'cover' => Str::random(10).'.png',
                'parent_id' => null,
                'slug' => Str::slug($nameCategoryParent3, '-'),
                'created_at' => now(),
            ],
            [   
                'name' => $nameCategoryChild1_1,
                'cover' => Str::random(10).'.png',
                'parent_id' => 1,
                'slug' => Str::slug($nameCategoryChild1_1, '-'),
                'created_at' => now(),
            ],
            [   
                'name' => $nameCategoryChild1_2,
                'cover' => Str::random(10).'.png',
                'parent_id' => 1,
                'slug' => Str::slug($nameCategoryChild1_2, '-'),
                'created_at' => now(),
            ],
            [   
                'name' => $nameCategoryChild1_3,
                'cover' => Str::random(10).'.png',
                'parent_id' => 1,
                'slug' => Str::slug($nameCategoryChild1_3, '-'),
                'created_at' => now(),
            ],
            [   
                'name' => $nameCategoryChild2_1,
                'cover' => Str::random(10).'.png',
                'parent_id' => 2,
                'slug' => Str::slug($nameCategoryChild2_1, '-'),
                'created_at' => now(),
            ],
        ]);
    }
}
