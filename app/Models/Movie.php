<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Movie extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_original',
        'alt_name',
        'slug',
        'category_id',
        'description',
        'status_movie',
        'tagline',
        'year',
        'chanel',
        'language',
        'duration',
        'source_url',
        'picture',
        'screen_url',
        'date_pub_rus',
        'date_pub_world',
        'published_at',
        'status',
        'author_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'date_pub_rus' => 'timestamp',
        'date_pub_world' => 'timestamp',
        'published_at' => 'timestamp',
        'author_id' => 'integer',
        'source_url' => 'array',
    ];


    protected $fakeColumns = ['source_url'];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getCountSeries($value)
    {
        $count = 0;
        foreach($value->seasons as $season) {
            $count += $season->series->count();
        }
        return $count;
    }



    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function openGoogle($crud = false)
    {
        return '<a class="btn btn-sm btn-link" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Google it</a>';
    }


    public function seasons()
    {
        return $this->hasMany(\App\Models\Season::class);
    }

    public function people()
    {
        return $this->belongsToMany(\App\Models\Person::class);
    }

    public function genres()
    {
        return $this->belongsToMany(\App\Models\Genre::class);
    }

    public function networks()
    {
        return $this->belongsToMany(\App\Models\Network::class, 'network_movie');
    }

    public function countries()
    {
        return $this->belongsToMany(\App\Models\Country::class);
    }

    public function collections()
    {
        return $this->belongsToMany(\App\Models\Collection::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function author()
    {
        return $this->belongsTo(\App\Models\User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    public function scopeOfName($query, $name)
    {
        return $query->where('name', 'LIKE', '%' . $name . '%');
    }
    */

    /*
        public function scopeOfDirection($query, $name)
        {
            return $query->whereHas('directions', function ($query) use($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            });
        }
    */



    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */


    public function setScreenUrlAttribute($value)
    {
        $attribute_name = "screen_url";
        // or use your own disk, defined in config/filesystems.php
        $disk = 'public';
        // destination path relative to the disk above
        $destination_path = "backdrop/serial";

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
            $image = \Image::make($value)->encode('jpg', 90);

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



    public function setPictureAttribute($value)
    {

        //dd($value);
        $attribute_name = "picture";
        // or use your own disk, defined in config/filesystems.php
        $disk = 'public';
        // destination path relative to the disk above
        $destination_path = "poster/serial";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($destination_path . '/' . $this->{$attribute_name});
            \Storage::disk($disk)->delete($destination_path . '/w135/' . $this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }



        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, ['data:image', 'http']))
        {
            // 0. Make the image
            $image = \Image::make($value)->resize(null, 350, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 90);

            // 0-1. Make the image small
            $image1 = \Image::make($value)->resize(135, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            \Storage::disk($disk)->put($destination_path.'/w135/'.$filename, $image1->stream());

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
