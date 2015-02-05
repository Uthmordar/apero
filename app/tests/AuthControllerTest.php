<?php

class AuthControllerTest extends TestCase{
    
    protected $userData;
    
    public function setUp() {
        parent::setup();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $this->userData=['name'=>'Alexandre', 'password'=>'Alexandre'];
    }

    public function tearDown() {
        parent::tearDown();
        Artisan::call('migrate:reset');
        Mockery::close();
    }
    
    /**
     * @test successfull login with good data
     */
    public function testLogSuccess(){
        Auth::shouldReceive('attempt')->once()->andReturn('true');
    
        $this->call('POST', 'authentification', $this->userData);
    }
    
    /**
     * @test fail auth with bad data
     */
    public function testLogFail(){
        Auth::shouldReceive('attempt')->once()->andReturn('false');
    
        $this->call('POST', 'authentification', ['name'=>'Alexander', 'password'=>'Alexander']);
    }
    
    /**
     * @test fail message
     */
    public function testErrorMessage(){
        $this->call('POST', 'authentification');

        $this->assertSessionHasErrors(['name', 'password']);
    }
    
    /**
     * @test delog
     */
    public function testDelog(){
        Auth::attempt($this->userData, false);
        $user=Auth::user();
        
        Auth::shouldReceive('user')->once()->andReturn($user);
        Auth::shouldReceive('logout')->once()->andReturn('true');
        
        $this->call('GET', 'logOut');
    }
}
