<?php

namespace Database\Seeders;
use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $media = new Media();
        $media->title = "Iphone";
        $media->audio_path = "1726701345_7120-download-iphone-6-original-ringtone-42676.mp3";
        $media->video_path = "1726784439_Introducing iPhone 16 _ Apple.mp4";
        $media->user_id = '1';
        $media->save();

    }
}
