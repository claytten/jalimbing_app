<?php

use Illuminate\Database\Seeder;
use App\Models\Categories\Category;
use App\Models\Categories\Subcategories\Subcategory;
use App\Models\Categories\Subcategories\Subcategoryimage;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                "name"        => "Dumsday",
                "schedule"    => "Sunday Night",
                "instagram"   => "zachking",
                "whatsapp"    => "6285704152765",
                "youtube"     => "baE0PtutLmY",
                "description" => "this is dummy data",
                "is_active"   => "1"
            ]
        ];

        foreach($categories as $item) {
            $category = Category::where('name', $item['name'])->first();

            if(empty($category)) {
                $store_category = Category::create([
                    'name'      => $item['name'],
                    'image'     => null,
                    'is_active' => $item['is_active']
                ]);

                $store_sub_category = Subcategory::create([
                    'category_id'   => $store_category->id,
                    'name'          => $item['name'],
                    'schedule'      => $item['schedule'],
                    'instagram'     => $item['instagram'],
                    'whatsapp'      => $item['whatsapp'],
                    'link_youtube'  => $item['youtube'],
                    'description'   => $item['description'],
                    'is_active'     => $item['is_active']
                ]);
            }
        }
    }
}
