<?php

use Illuminate\Database\Seeder;
use App\Models\Maps\Fields\Field;
use App\Models\Maps\Markers\Marker;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = [
            [
                'area_name'     => "Paud",
                'coordinates'   => "[110.44475649284738,-7.05164939792314]",
                'field_id'      => 1,
            ]
        ];

        foreach ($fields as $item) {
            $db_field = Field::where('area_name','==',$item['area_name'])->first();
            if(empty($db_field)){
                Field::create(
                    [
                        "area_name"     => $item['area_name'],
                    ]
                );
                Marker::create(
                    [
                        'geo_type'      => "Point",
                        'coordinates'   => $item['coordinates'],
                        'field_id'      => $item['field_id']
                    ]
                );
            }
        }
        
    }
}
