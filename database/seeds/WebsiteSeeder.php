<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websites = [
            [
                'id' => 1,
                'name' => 'Prep Hoops',
                'logo' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/mgAEkPYvzFcGQLsSNwdpOPsTbJPa6K7pwe6NopKC.png',
                'icon' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/PHIcon.png',
                'slug' => 'prep-hoops',
            ],
            [
                'id' => 2,
                'name' => 'Prep Girls Hoops',
                'logo' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/E1NDJqHPMPeX1sUMnjmxeoCBb3yBkL47RIszhH6S.png',
                'icon' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/PGHIcon.png',
                'slug' => 'prep-girls-hoops',
            ],
            [
                'id' => 3,
                'name' => 'Prep Dig',
                'logo' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/RnHrjLDTTDrfz0pxIeuz2J5ubCp4SoWckXMK56Ln.png',
                'icon' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/PDIcon.png',
                'slug' => 'prep-dig',
            ],
            [
                'id' => 4,
                'name' => 'Prep Redzone',
                'logo' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/zVIyqNLGEoW4eb2wQJrVjnBSQ9IsQu9PVg8W7Ere.png',
                'icon' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/PRZIcon.png',
                'slug' => 'prep-redzone',
            ],
            [
                'id' => 5,
                'name' => 'Prep Hoops Next',
                'logo' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/0SpXjQ46A7kkPuoIBmqWkLkDqpHs9yHN2oeHls5x.png',
                'icon' => 'https://prephoops-uploads.s3.amazonaws.com/website-images/PHNIcon.png',
                'slug' => 'prep-hoops-next'
            ]
        ];

        \DB::table('websites')->insert($websites);
    }
}
