<?php

class HomeControllerTest extends TestCase {
    
    public function setUp() {
        parent::setup();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Apero::boot();
    }

    public function tearDown() {
        parent::tearDown();
        Artisan::call('migrate:reset');
    }
    
    /**
    * @test call aperos on apero list view
    */
    public function testHomeAperosDataViewInit() {
        $crawler=$this->client->request('GET', 'apero');
        $h2=$crawler->filter('h2');
        $this->assertEquals(0, count($h2));
    }
    
    /**
    * @test call aperos and display all
    */
    public function testHomeAperosDataView(){
        Apero::create(['title'=>'test', 'date'=>'2015-10-10', 'tag_id'=>1]);
        $crawler=$this->client->request('GET', 'apero');
        $h2=$crawler->filter('h2');
        $this->assertEquals(1, count($h2));
    }
}
