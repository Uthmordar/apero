<?php

class AperoControllerTest extends TestCase {
    protected $mock;
    protected $userData;
    
    public function setUp() {
        parent::setup();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $this->mock=Mockery::mock('Eloquent', 'Apero');
        $this->userData=['name'=>'Alexandre', 'password'=>'Alexandre'];
        Apero::boot();
    }

    public function tearDown() {
        parent::tearDown();
        Artisan::call('migrate:reset');
        Mockery::close();
    }
     
    /**
     * @test ressource secure
     */
    public function testRESTRouteSecure(){
        Route::enableFilters();
        $this->call('GET', 'apero');
        $this->assertResponseStatus(200);
        
        $this->call('POST', 'apero');
        $this->assertResponseStatus(401);
    }
    
    /**
     * @test create route
     */
    public function testCreateRoute(){
        Auth::attempt($this->userData, false);
        $crawler=$this->client->request('GET', '/apero/create');
        $form=$crawler->filter('form');
        $this->assertEquals(1, count($form));
    }
    
    /**
     * @test filter
     */
    public function testIndexAperosDataFilter(){
        Apero::create(['title'=>'test', 'date'=>'2015-10-10', 'tag_id'=>1]);
        $crawler=$this->client->request('GET', 'apero', ['title'=>'te', '1'=>'on']);
        $h2=$crawler->filter('h2');
        $this->assertEquals(1, count($h2));
    }
    
    /**
     * @test store apero
     */
    public function testStoreAperos(){
        $mock=Mockery::mock('Swift_Mailer');
        $this->app->make('mailer')->setSwiftMailer($mock);
        $mock->shouldReceive('send')->twice();
        
        Auth::attempt($this->userData, false);        
        $this->call('POST', 'apero', ['title'=>'test', 'content'=>'test', 'tag'=>4, 'date'=>'2015-02-10']);
        $this->assertRedirectedToRoute('apero.index', null, ['message' => 'success']);
    }
    
    /**
     * @test show apero
     */
    public function testShowAperos(){
        $mock=Mockery::mock('Swift_Mailer');
        $this->app->make('mailer')->setSwiftMailer($mock);
        $mock->shouldReceive('send')->twice();
        
        Auth::attempt($this->userData, false);        
        $this->call('POST', 'apero', ['title'=>'test', 'content'=>'test', 'tag'=>4, 'date'=>'2015-02-10']);
        
        $crawler=$this->client->request('GET', 'apero/1');
        $h2=$crawler->filter('h2');
        $this->assertEquals(1, count($h2));
    }
    
    /**
     * @test no tag fail
     */
    public function testnoTagAperos(){
        Auth::attempt($this->userData, false);        
        $this->call('POST', 'apero', ['title'=>'test', 'content'=>'test', 'tag'=>0, 'date'=>'2015-02-10']);
        $this->assertRedirectedToRoute('apero.create', null);
    }
        
    /**
     * @expectedException RuntimeException
     */
    public function testStoreAperoNoUser(){     
        $this->call('POST', 'apero', ['title'=>'test', 'content'=>'test', 'tag'=>4, 'date'=>'2015-02-10']);
    }
    
    /**
     * @test required field on form
     */
    public function testFailStoreAperos(){    
        Auth::attempt($this->userData, false);
        $this->call('POST', 'apero');
        $this->assertRedirectedToRoute('apero.create');
        $this->assertSessionHasErrors(['title', 'date']);
    }
}
