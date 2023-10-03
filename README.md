# Laravel Music Player

## Overview

This application is an example music player created in Laravel and Vue.js. Half-done by following instructions from the [DesignatedCoder](https://www.youtube.com/watch?v=YvOnVi1aiDk) video, now I am using it as a TDD project (with PHPUnit and Git Hooks/GitHub Actions) with automatic ID3 tag parsing and custom functions.

## Installation

After git clone:

- copy .env.example and set the environment variables
- extract songs.zip to `public/songs/`
- `php artisan key:generate`
- `composer install`
- `php artisan migrate`
- `php artisan db:seed`
- `npm run`

## Coming soon

- form for insert new song
- autofill from ID3 tags of uploaded mp3s
- massive upload from zipped/multiple select/dropzone
- connection to MusPy API to follow favourite artists and get notified when new albums get published

## Music from Uppbeat (free for Creators!):

https://uppbeat.io/t/mountaineer/farewell
License code: 1EOGNMFGVLTLZQXF

https://uppbeat.io/t/soundroll/good-intention
License code: 46N7D5ZNMXMLNSBH

https://uppbeat.io/t/fugu-vibes/soul
License code: W7U6CLJGYEM7NUGD

https://uppbeat.io/t/bakerman/permafrost
License code: 6ZACDZD6BUCXPGQD
