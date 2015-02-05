<?php

class UserModelTest extends TestCase{
    
    protected $mock;
    protected $userData;
    protected $visitor;
    
    public function setUp() {
        parent::setup();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $this->mock=Mockery::mock('Eloquent', 'Apero');
        $this->userData=['name'=>'Alexandre', 'password'=>'Alexandre'];
        $this->visitor=['name'=>'Abel', 'password'=>'Abel'];
        Apero::boot();
    }

    public function tearDown() {
        parent::tearDown();
        Artisan::call('migrate:reset');
        Mockery::close();
    }
    
    /**
    * @test is User can edit
    */
    public function testCanEditOwn(){
        Apero::create(['title'=>'test', 'date'=>'2015-10-10', 'tag_id'=>1, 'user_id'=>1]);
        Auth::attempt($this->userData, false);
        $user=Auth::user();
        $this->assertEquals(true, $user->isCanEdit(1));
    }
    
    /**
     * @expectedException RuntimeException
     */
    public function testCantEditVisitor(){
        Apero::create(['title'=>'test', 'date'=>'2015-10-10', 'tag_id'=>1, 'user_id'=>1]);
        Auth::attempt($this->visitor, false);
        $user=Auth::user();
        $user->isCanEdit(1);
    }
}
