<?php

class UserTableSeeder extends Seeder{
    public function run() {
        DB::table('users')->delete();
        DB::unprepared('ALTER TABLE users AUTO_INCREMENT=1');
        DB::table('users')->insert(
            [
                ['name'=>'Alexandre',
                 'password'=> Hash::make('Alexandre'),
                 'role'=>'administrator',
                 'email'=>'alexandre@mail.com'
                ],
                ['name'=>'Abel',
                 'password'=> Hash::make('Abel'),
                 'role'=>'visitor',
                 'email'=>'alexandre@mail.com'
                ],
                ['name'=>'Al',
                 'password'=> Hash::make('Al'),
                 'role'=>'visitor',
                 'email'=>'alexandre@mail.com'
                ],
                ['name'=>'Alan',
                 'password'=> Hash::make('Alan'),
                 'role'=>'visitor',
                 'email'=>'alexandre@mail.com'
                ],
                ['name'=>'Arthur',
                 'password'=> Hash::make('Arthur'),
                 'role'=>'visitor',
                 'email'=>'alexandre@mail.com'
                ],
                ['name'=>'Carl',
                 'password'=> Hash::make('Carl'),
                 'role'=>'visitor',
                 'email'=>'alexandre@mail.com'
                ],
                ['name'=>'Blaise',
                 'password'=> Hash::make('Blaise'),
                 'role'=>'visitor',
                 'email'=>'alexandre@mail.com'
                ],
                ['name'=>'Isaac',
                 'password'=> Hash::make('Isaac'),
                 'role'=>'visitor',
                 'email'=>'alexandre@mail.com'
                ],
                ['name'=>'Steve',
                 'password'=> Hash::make('Steve'),
                 'role'=>'visitor',
                 'email'=>'alexandre@mail.com'
                ]
            ]
        );
    }
}