<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Inertia\Inertia;
use Illuminate\Http\Request;
use wapmorgan\Mp3Info\Mp3Info;

class SongController extends Controller
{
    private $songRepository;


    public function __construct(\App\Repositories\SongRepositoryInterface $songRepository)
    {
        $this->songRepository = $songRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    /**
     * API call that returns all songs from the database
     * 
     * @return json
     */

    public function getAll()
    {
        return response()->json($this->songRepository->all(), 200);
    }

    /**
     * API call to parse ID3 informations from MP3s
     * 
     * @return json
     */
    public function parseId3($path = null)
    {
        if(!$path)
            $path = '/var/www/music-player/public/storage/audio/Carcass - Heartwork.mp3';
        $mp3 = new Mp3Info($path, true);

        $array = $this->songRepository->idTwo($mp3->tags2);

        return response()->json($array, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }
}
