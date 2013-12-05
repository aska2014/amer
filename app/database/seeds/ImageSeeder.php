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
            'name' => 'Estate.Main'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/estates/200x150'
        ))->setCode(new Code(array(
                'code' => '$image->grab(200, 150, true); return $image;'
            )));

        $group->specs()->create(array(
            'directory' => 'albums/estates/145x145'
        ))->setCode(new Code(array(
                'code' => '$image->grab(145, 145, true); return $image;'
            )));

        $group->specs()->create(array(
            'directory' => 'albums/estates/normal'
        ));





        $group = Group::create(array(
            'name' => 'News.Main'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/news/143x105'
        ))->setCode(new Code(array(
                'code' => '$image->grab(143, 105, true); return $image;'
            )));

        $group->specs()->create(array(
            'directory' => 'albums/news/450x268'
        ))->setCode(new Code(array(
                'code' => '$image->grab(450, 268, true); return $image;'
            )));

        $group->specs()->create(array(
            'directory' => 'albums/news/normal'
        ));





        $group = Group::create(array(
            'name' => 'Slider.Main'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/sliders/596x210'
        ))->setCode(new Code(array(
                'code' => '$image->resize(596, 210, true); return $image;'
            )));

        $group->specs()->create(array(
            'directory' => 'albums/sliders/normal'
        ));




        $group = Group::create(array(
            'name' => 'EstateCategory.Main'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/categories/70x70'
        ))->setCode(new Code(array(
                'code' => '$image->grab(70, 70); return $image;'
            )));



        $group = Group::create(array(
            'name' => 'Banner.Main'
        ));

        $group->specs()->create(array(
            'directory' => 'albums/banners/'
        ));
    }
}