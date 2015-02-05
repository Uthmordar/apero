<?php

class AperoObserverTest extends TestCase { 
    public function setUp() {
        parent::setup();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Apero::boot();
    }

    public function tearDown() {
        parent::tearDown();
        Artisan::call('migrate:reset');
        Mockery::close();
    }
    
    /**
     * @test tag_count default value
     */
    public function testInitvalueTag(){     
        $tag=Tag::findOrFail(2);
        $this->assertEquals(0, $tag->count_apero);
    }
    
    /**
     * @test tag_count autoincrement on new post
     */
    public function testIncrementsTag(){
        for($i=1; $i<5; $i++){
            Apero::create(['title'=>'test', 'date'=>'2015-10-10', 'tag_id'=>1]);
            $this->assertEquals($i, Tag::find(1)->count_apero);
        }
    }
    
    /**
     * @test tag_count decrement on delete post
     */
    public function testDecrementsTag(){
        for($i=1; $i<5; $i++){
            Apero::create(['title'=>'test', 'date'=>'2015-10-10', 'tag_id'=>1]);
        }
        for($i=5; $i>0; $i--){
            Apero::destroy($i);
            $this->assertEquals($i-1, Tag::find(1)->count_apero);
        }
    }
}
