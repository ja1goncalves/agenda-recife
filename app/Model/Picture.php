<?php

namespace App\Model;


class Picture extends AppModel
{
    protected $table = 'pictures';
    protected $fillable = [
        'image', 'title', 'mimetype', 'size', 'path', 'imageable_id', 'imageable_type'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * @param $picture
     * @param $type
     * @param $id
     * @return mixed
     */
    public static function saveByImageable($picture, $type, $id)
    {
        return Picture::create([
            'image' => base64_encode(file_get_contents($picture->path())),
            'title' => $picture->getClientOriginalName(),
            'mimetype' => $picture->getMimeType(),
            'size' =>$picture->getSize(),
            'path' => $picture->path(),
            'imageable_type' => $type,
            'imageable_id' => $id,
        ]);
    }
}
