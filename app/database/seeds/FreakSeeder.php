<?php

use Kareem3d\Freak\DBRepositories\ControlPanel;

class FreakSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        ControlPanel::query()->delete();

        ControlPanel::create(array(
            'name' => 'AmerGroup2',
            'password' => 'amer123'
        ));
    }

}