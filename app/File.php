<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;

class File extends Model
{
    //
    protected $fillable = [
        'id','path'
    ];

    public static function getUserProfilePhotoPath($user)
    {

        try{
            //return "/storage/avatars/".$user->avatar;

            $response=Telegram::getUserProfilePhotos(["user_id"=>$user->id]);

            $photos = $response->getPhotos();

            //if(Photo::where('id',$photos[0][0]['file_id'])->count()>0)
            //   return Photo::where('id',$photos[0][count($photos[0])-1]['file_id'])->first()->path;

            $file=Telegram::getFile(["file_id"=>$photos[0][0]['file_id']]);


            $path=File::downloadAvatar($file,$user->id);
            $user->avatar=$path;
            $user->save();
            File::create([
                'id' => $file->file_id,
                'path'=>$path
            ]);

            return $path;

        }
        catch (\Throwable $exception)
        {
            $user->avatar="avatars/avatar.png";
            $user->save();
        }
    }


    public static function downloadAvatar($file,$user_id)
    {
        $token=env('TELEGRAM_BOT_REVIEWS_TOKEN', 0);


        // $folder_path=public_path()."/storage/$user_id";
        // if (!File::exists($folder_path)) {
        //     File::makeDirectory($folder_path);
        // }
        $contents = file_get_contents("https://api.telegram.org/file/bot$token/$file->file_path");

        Storage::put("public/".$user_id."/avatar.jpg", $contents);
        return "$user_id/avatar.jpg";


    }


    public static function getMediaPath($id)
    {
        //try{
            //return "/storage/avatars/".$user->avatar;

            $file=File::find($id);
            if($file!==null)
                return $file->path;
            else
            {
                $response=Telegram::getFile(["file_id"=>$id]);
                $path=self::downloadMedia($response->file_path);
                File::create([
                    'id' => $id,
                    'path'=>$path
                ]);
                return $path;
            }

           /* Telegram::sendMessage([
                'chat_id' => 110699273,
                // 'text' => $text
                'text' => json_encode( $response)
            ]);*/

            //$photos = $response->getPhotos();

            //if(Photo::where('id',$photos[0][0]['file_id'])->count()>0)
            //   return Photo::where('id',$photos[0][count($photos[0])-1]['file_id'])->first()->path;

            //$file=Telegram::getFile(["file_id"=>$photos[0][0]['file_id']]);


            //$path=Photo::downloadAvatar($file,$user->id);
            //$user->avatar=$path;
            //$user->save();
            // Photo::create([
             //    'id' => $file->file_id,
            //     'path'=>$path
           //   ]);

            return '';

      //  }
       // catch (\Throwable $exception)
       // {
          //  $user->avatar="avatars/avatar.png";
           // $user->save();
        //    return "avatars/avatar.png";
       // }
    }


    public static function downloadMedia($file_path)
    {
        $token=env('TELEGRAM_BOT_REVIEWS_TOKEN', 0);


        // $folder_path=public_path()."/storage/$user_id";
        // if (!File::exists($folder_path)) {
        //     File::makeDirectory($folder_path);
        // }
        $contents = file_get_contents("https://api.telegram.org/file/bot$token/$file_path");

        Storage::put("public/media/".$file_path, $contents);
        return "media/".$file_path;

    }
}
