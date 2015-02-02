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
    }

    public function tearDown() {
        parent::tearDown();
        Artisan::call('migrate:reset');
        Mockery::close();
    }
    
    /**
     * @test call aperos on apero list view
     */
    public function testHomeAperosDataView() {
        $this->mock->shouldReceive('all')->once();
        // IoC
        $this->app->instance('Apero', $this->mock);
        $this->call('GET', 'apero');
    }
    
    /**
     * @test store apero
     */
    public function testStoreAperos(){
        Auth::attempt($this->userData, false);        
        $this->call('POST', 'apero', ['title'=>'test', 'content'=>'test', 'tag'=>4, 'date'=>'2015-02-10']);
        $this->assertRedirectedToRoute('apero.index', null, ['message' => 'success']);
    }
    
    /**
     * @test required field on form
     */
    public function testFailStoreAperos(){        
        $this->call('POST', 'apero');
        $this->assertRedirectedToRoute('apero.create');
        $this->assertSessionHasErrors(['title', 'date']);
    }
    
    /**
     * @test tag_count autoincrement on new post
     */
    public function testAutoincrementTag(){
        /*$this->tagMock->shouldReceive('send')->once();
        $this->app->instance('Mail', $this->tagMock);*/
        
        Auth::attempt($this->userData, false);
        $tag=Tag::findOrFail(2);
        $this->assertEquals(0, $tag->count_apero);
        $this->call('POST', 'apero', ['title'=>'test', 'content'=>'test', 'tag'=>2, 'date'=>'2015-02-10']);
    }
}
