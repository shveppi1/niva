<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Network extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'networks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'picture',
        'slug',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function movies()
    {
        return $this->belongsToMany(\App\Models\Movie::class, 'network_movie');
    }



    public function setPictureAttribute($value)
    {

        //dd($value);
        $attribute_name = "picture";
        // or use your own disk, defined in config/filesystems.php
        $disk = 'public';
        // destination path relative to the disk above
        $destination_path = "logo/networks";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($destination_path . '/' . $this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }



        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, ['data:image', 'http']))
        {
            // 0. Make the image
            $image = \Image::make($value)->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            //$public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $filename;
        }
    }

}
