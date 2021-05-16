<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Media extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'file',
        'path',
        'thumb',
        'extension'
    ];

    public function getFile($type = 'thumb')
    {
        $image = ['gif', 'png', 'jpg', 'jpeg', 'raw', 'webp',];
        $text = ['docx', 'doc', 'xlsx', 'xlsm', 'pptx', 'pptm',];
        $video = ['mp4', 'mov', 'wmv', 'flv', 'avi', 'mkv', 'webm'];
        $audio = ['mp3', 'aac', 'ogg', 'flac', 'wav'];
        $compress = ['zip', 'rar'];

        if(in_array($this->extension, $image)){
            return $type == 'path' ? $this->path : $this->thumb;
        } elseif (in_array($this->extension, $text)) {
            return asset('manager/extension/txt.png');
        } elseif ($this->extension == 'pdf') {
            return asset('manager/extension/pdf.png');
        } elseif (in_array($this->extension, $video)) {
            return asset('manager/extension/mp4.png');
        } elseif (in_array($this->extension, $audio)) {
            return asset('manager/extension/mp3.png');
        } else {
            return asset('manager/extension/other.png');
        }
    }


    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function getMediaAjax($query){

        $query = str_replace(" ", "%", $query);

        if($query != '') {
            $medias = $this->where('file', 'like', '%' . $query . '%')->orderBy("created_at", 'desc')->paginate(18);
        } else {
            $medias = $this->orderBy("created_at", 'desc')->paginate(18);
        }
        return $medias;
    }

    public function getMediaAjaxType($query, $type){

        $query = str_replace(" ", "%", $query);

        if($query != '') {
            $medias = $this->where('file', 'like', '%' . $query . '%')->whereIn('extension', $type)->orderBy("created_at", 'desc')->paginate(18);
        } else {
            $medias = $this->whereIn('extension', $type)->orderBy("created_at", 'desc')->paginate(18);
        }
        return $medias;
    }
}
