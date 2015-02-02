<?php

class TagTableSeeder extends Seeder{
    public function run() {
        DB::table('tags')->delete();
        DB::unprepared('ALTER TABLE users AUTO_INCREMENT=1');
        DB::table('tags')->insert(
            [
                [
                    "name"=>"php"
                ],
                [
                    "name"=>"AngularJS"
                ],
                [
                    "name"=>"AngularJS/Laravel"
                ],
                [
                    "name"=>"Fabric"
                ],
                [
                    "name"=>"PHPUnit"
                ],
                [
                    "name"=>"Behat"
                ],
                [
                    "name"=>"Travis"
                ],
                [
                    "name"=>"Gulp"
                ]
            ]
        );
    }
}