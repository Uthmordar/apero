<?php

class UserTableSeeder extends Seeder{
    public function run() {
        DB::table('users')->delete();
        DB::unprepared('ALTER TABLE users AUTO_INCREMENT=1');
        DB::table('users')->insert(
            [
                ['name'=>'Alexandre',
                 'password'=> Hash::make('Alexandre'),
                 'role'=>'administrator'
                ],
                ['name'=>'Abel',
                 'password'=> Hash::make('Abel'),
                 'role'=>'visitor'
                ],
                ['name'=>'Al',
                 'password'=> Hash::make('Al'),
                 'role'=>'visitor'
                ],
                ['name'=>'Alan',
                 'password'=> Hash::make('Alan'),
                 'role'=>'visitor'
                ],
                ['name'=>'Arthur',
                 'password'=> Hash::make('Arthur'),
                 'role'=>'visitor'
                ],
                ['name'=>'Carl',
                 'password'=> Hash::make('Carl'),
                 'role'=>'visitor'
                ],
                ['name'=>'Blaise',
                 'password'=> Hash::make('Blaise'),
                 'role'=>'visitor'
                ],
                ['name'=>'Isaac',
                 'password'=> Hash::make('Isaac'),
                 'role'=>'visitor'
                ],
                ['name'=>'Steve',
                 'password'=> Hash::make('Steve'),
                 'role'=>'visitor'
                ]
            ]
        );
    }
}