<template>
    <div id="bg" class="animateHue">
        <img :src="currentSong.cover" class="opacity-25 w-full h-full" :alt="currentSong.title">
        <div class="absolute inset-0">
            <div class="flex h-full md:items-center md:mx-auto md:w-3/4 lg:w-1/2">
                <div class="hidden md:flex md:flex-col md:flex-1 md:space-y-3 md:relative md:z-10">
                    <h1 class="text-xl text-white font-semibold md:text-2xl">Tutte le canzoni</h1>
                    <div class="border-2 h-64 overflow-y-auto">
                        <button class="flex flex-col border-b text-white px-2 py-2 w-full 
                        transition hover:text-blue-700" v-for="(song, index) in songs" :key="index" @click="play(song)">
                            <span class="font-semibold italic">{{song.title}}</span>
                            <span>{{song.artist}}</span>
                        </button>
                    </div>
                    <button type="button" class="inline-flex items-center px-4 py-2
                    bg-gray-800 border border-transparent rounded-md font-semibold text-xs
                    text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray
                    focus:outline-none focus:border-gray-900 focus-ring focus:ring-gray-300
                    disabled:opacity-25 transition" @click="parseId3">Add new song</button>
                </div>
                <div class="flex flex-col justify-center items-center text-white space-y-3
                px-6 mx-auto h-full md:flex-1 md:px-0">
                    <h1 class="text-xl font-semibold md:text-2xl">Canzone corrente:</h1>
                    <span class="text-xl font-semibold italic">{{ currentSong.title }} - {{ currentSong.artist }}</span>
                    <img :src="currentSong.cover" class="rounded-lg w-72 h-72" :alt="
                    currentSong.title">
                    <div class="flex flex-col items-center">
                        <canvas class="absolute top-0 left-0 w-full h-full" id="canvas"></canvas>
                        <div class="relative">
                            <div class="flex justify-around mt-4">
                                <button type="button" class="transition" @click="prev">
                                    <icon name="prev" class="w-4 h-4 fill-current hover:text-blue-600"></icon>
                                </button>
                                <button type="button" class="transition" @click="pause" v-if="isPlaying">
                                    <icon name="pause" class="w-4 h-4 fill-current hover:text-blue-600"></icon>
                                </button>
                                <button type="button" class="transition" @click="play" v-else>
                                    <icon name="play" class="w-4 h-4 fill-current hover:text-blue-600"></icon>
                                </button>
                                <button type="button" class="transition" @click="next">
                                    <icon name="next" class="w-4 h-4 fill-current hover:text-blue-600"></icon>
                                </button>
                            </div>
                            <div class="flex flex-col mt-4 w-full">
                                <div class="flex flex-1 items-center space-x-1">
                                    <icon name="volume-mute" class="w-4 h-4 fill-current hover:text-blue-600 cursor-pointer" :class="isMuted ? 'text-blue-600' : ''" @click="volumeMute"></icon>
                                    <input type="range" min="0" max="100" step="1" v-model="volume" @input="updateVolume"
                                    class="cursor-pointer">
                                    <icon name="volume-up" class="w-4 h-4 fill-current hover:text-blue-600 cursor-pointer" :class="isMaxed ? 'text-blue-600' : ''" @click="volumeMax"></icon>
                                </div>
                                <div class="flex flex-1 flex-col items-center space-x-1 mt-4">
                                    <input type="range" max="100" id="progressBar"
                                    class="cursor-pointer">
                                    <div class="flex justify-between">
                                        <span>0:00 / 2:43</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import * as musicMetadata from 'music-metadata-browser';

    export default {
        data() {
            return {
                audio: new Audio(),
                currentSong: {},
                index: 0,
                volume: 20,
                isMuted: false,
                isMaxed: false,
                isPlaying: false,
                songs: []
            }
        },
        mounted() {
            this.fetchData()
        },
        methods: {
            fetchData() {
                return fetch('/api/allSongs', {
                    method: 'get',
                    headers: {
                    'content-type': 'application/json'
                    }
                })
                .then(res => {
                    // a non-200 response code
                    if (!res.ok) {
                        // create error instance with HTTP status text
                        const error = new Error(res.statusText);
                        error.json = res.json();
                        throw error;
                    }

                    return res.json();
                })
                .then(json => {
                    // set the response data
                    this.songs = json;
                    console.log(json);
                    this.currentSong = this.songs[this.index]
                    this.audio.src = this.currentSong.src
                    this.audio.volume = this.volume / 100
                })
                
            },
            volumeMute() {
                this.isMuted = true
                this.isMaxed = false
                this.volume = 0
                this.audio.volume = 0
            },
            volumeMax() {
                this.isMuted = false
                this.isMaxed = true
                this.volume = 100
                this.audio.volume = 100
                this.isMuted = true;   
            },
            updateVolume() {
                this.audio.volume = this.volume / 100
            },
            play(song) {
                if(typeof song.src != 'undefined') {
                    this.currentSong = song
                    this.audio.src = this.currentSong.src
                }
                this.audio.play();
                this.isPlaying = true;
            },
            pause() {
                this.audio.pause();
                this.isPlaying = false;
            },
            prev() {
                this.index--
                if(this.index < 0) {
                    this.index = this.songs.length - 1
                }
                this.currentSong = this.songs[this.index]
                this.play(this.currentSong)
            },
            next() {
                this.index++
                if(this.index > this.songs.length - 1) {
                    this.index = 0
                }
                this.currentSong = this.songs[this.index]
                this.play(this.currentSong)
            },
            parseId3() {
                return fetch('/api/parseId3', {
                    method: 'get',
                    headers: {
                    'content-type': 'application/json'
                    }
                })
                .then(res => {
                    // a non-200 response code
                    if (!res.ok) {
                        // create error instance with HTTP status text
                        const error = new Error(res.statusText);
                        error.json = res.json();
                        throw error;
                    }

                    return res.json();
                })
                .then(json => {
                    // set the response data
                    // TEMP: testing for data coherency
                    console.log(json)
                })
            }
        }
    }
</script>
