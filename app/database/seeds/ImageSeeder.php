<?php

use Kareem3d\Code\Code;
use Kareem3d\Images\Group;
use Kareem3d\Images\Specification;

class ImageSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        Group::query()->delete();
        Specification::query()->delete();




        $group = Group::create(array(
            'name' => 'Estate.Gallery'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/estates/gallery'
        ));







        $group = Group::create(array(
            'name' => 'Estate.Main'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/estates/xx103'
        ))->setCode(new Code(array(
                'code' => '$image->resize(null, 103, true); return $image;'
            )));

        $group->specs()->create(array(
            'directory' => 'albums/estates/normal'
        ));





        $group = Group::create(array(
            'name' => 'News.Main'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/news/xx103'
        ))->setCode(new Code(array(
                'code' => '$image->resize(null, 103, true); return $image;'
            )));

        $group->specs()->create(array(
            'directory' => 'albums/news/normal'
        ));







        $group = Group::create(array(
            'name' => 'EstateCategory.Main'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/categories/main'
        ))->setCode(new Code(array(
                'code' => '$image->grab(114, 115); return $image;'
            )));
    }
}