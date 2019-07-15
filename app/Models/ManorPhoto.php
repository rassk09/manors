<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ManorPhoto extends BaseModel
{
    public function initializeAdminForm() {}
    public function initializeAdminList() {}

    protected $table = 'manors_photos';
    protected $fillable = [
        'manor_id', 'image', 'position'
    ];

    public function jsonResponse() {
        $file = public_path($this->image);
        if (File::exists($file)) {
            $response = [
                'name' => File::name($file) . '.' . File::extension($file),
                'size' => File::size($file),
                'url' => $this->image,
                'thumbnailUrl' => $this->image,
                'deleteUrl' => action('Admin\ApiController@deleteManorPhotos', ['id' => $this->manor_id, 'image' => $this->id]),
                'deleteType' => 'GET',
            ];

            return $response;
        }
    }
}
