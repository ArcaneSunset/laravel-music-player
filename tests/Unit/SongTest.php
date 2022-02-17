<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//changed from PHPUnit's TestCase to include Laravel TestCase's createApplication method
use Tests\TestCase;
use wapmorgan\Mp3Info\Mp3Info;
use App\Models\Song;
use Mockery;
use Illuminate\Support\Str;

class SongTest extends TestCase
{    
    use RefreshDatabase;

    protected $song;
    protected $songModel;

    public function setUp(): void
    {
        parent::setUp();

        $this->song = Mockery::mock('App\Repositories\SongRepositoryInterface');
        $songMock = Mockery::mock(Song::class);
        app()->instance(Song::class, $songMock);
    }

    /**
     * Test for music files in storage and on ID3 data
     *
     * @return void
     */
    public function test_song_factory()
    {
        $song = Song::factory()->make();  
        $this->assertInstanceOf(Song::class, $song);
        //test if URL is properly created
        $this->assertEquals('/storage/audio/'.Str::slug($song->artist).'-'.Str::slug($song->title).'.mp3', $song->src);
    }

    /**
     * Test for music files in storage and on ID3 data
     *
     * @return void
     */
    public function test_song_seeding()
    {
        $this->seed();
        $this->song
            ->shouldReceive('all')
            ->once()->andReturn(Song::all());    
        $songs = $this->song->all();
        $this->assertContains("Mountaineer", $songs[0]->toArray());
        $this->assertContains("Soundroll", $songs[1]->toArray());
        $this->assertContains("Soul", $songs[2]->toArray());
        $this->assertContains("Permafrost", $songs[3]->toArray());
    }

    /**
     * Test for music files in storage and on ID3 data
     *
     * @return void
     */
    public function test_id3_function()
    {
        $path = public_path('storage/audio/farewell-mountaineer.mp3');
        $mp3 = new Mp3Info($path, true);
        $this->assertArrayHasKey('TIT2', $mp3->tags2);
        $this->song
            ->shouldReceive('idTwo')
            ->once()->andReturn([
                'title' => $mp3->tags2['TIT2'],
                'artist2' => $mp3->tags2['TPE1']
            ]);
        $data = $this->song->idTwo($mp3->tags2);
        $this->assertContains('Mountaineer', $data);
    }
}
