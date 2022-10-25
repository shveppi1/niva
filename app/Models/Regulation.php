<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Regulation extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'regulations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    /*
    protected $casts = [
        'attention_products' => 'array',
        'images' => 'array'
    ];
    */
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeOfName($query, $name)
    {
        return $query->where('name', 'LIKE', '%' . $name . '%');
    }

    public function scopeNotClubs($query)
    {
        return $query->where('private', 0);
    }

    public function scopeClubs($query)
    {
        return $query->where('private', 1);
    }


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

    /*
    public function setMainImageAttribute($value)
    {
        $attribute_name = "main_image";
        $disk = "public";
        $destination_path = "regulations/" . $this->id;


        if ($value == null) {
            Storage::disk($disk)->delete($this->{$attribute_name});

            $this->attributes[$attribute_name] = null;
        }

        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = Image::make($value)->encode('png', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.png';

            // 2. Store the image on disk.
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;


        }
    }

    public function setImagesAttribute($value)
    {
        $attribute_name = "images";
        $disk = "public";
        $destination_path = "products/" . $this->id . '/images';

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
    */

    /*
    public function setShowIsNew()
    {
        if ($this->new) {
            $newHideDay = Carbon::parse($this->new_timer);

            if (Carbon::now()->lt($newHideDay)) {
                $this->showIsNew = true;
            } else {
                $this->showIsNew = false;
            }
        } else {
            $this->showIsNew = false;
        }
    }

    public function setShowIsComingSoon()
    {
        if ($this->coming_soon) {
            $comingSoonHideDay = Carbon::parse($this->coming_soon_timer);
            if (Carbon::now()->lt($comingSoonHideDay)) {
                $this->showIsComingSoon = true;
            } else {
                $this->showIsComingSoon = false;
            }
        } else {
            $this->showIsComingSoon = false;
        }
    }
    */


}
