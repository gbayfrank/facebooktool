<?php
namespace App\GbayLibs;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class FileUpload {
    private $file;
    private $fileName;
    private $dataFileName;
    private $dataResizeFileName = [];
    private $deleteFileUpload   = false;
    private $convert_to_webp;
    private $storageName    = 'gbay_public';
    private $storageSystems = 'gbay_systems';
    private $extension_to_webp  = ['jpeg', 'jpg', 'png'];
    private $img_resize         = ['jpeg', 'jpg', 'png', 'webp', 'gif'];
    private $thumb_systems      = ['gif', 'svg'];
    protected $params           = [];
    protected $public_folder    = '\/uploads\/';
    protected $size_thumb       = ['width' => 150, 'height' => 150];
    protected $size_img = [
        'img_desktop' => [
            'width'     => 1024,
            'height'    => 1024
        ],
        'image_big_table' => [
            'width'     => 768,
            'height'    => 768
        ],
        'img_table' => [
            'width'     => 400,
            'height'    => 400
        ],
        'img_mobile' => [
            'width'     => 250,
            'height'    => 250
        ],
    ];

    public function __construct($file, $convert_to_webp) {
        $this->convert_to_webp = $convert_to_webp;
        $this->file = $file;
        $this->fileName     = $this->changeNameFileUpload($this->storageName, $this->file->getClientOriginalName(), $this->dateFolderUpload(), $this->file->getClientOriginalName(), 1);        
        $this->dataFileName = $this->getFileNameAndExtension($this->fileName);
        $this->params['name']       = $this->fileName;
        $this->params['name_not_extension']     = $this->dataFileName['name'];
        $this->params['alt']                    = $this->dataFileName['name'];
        $this->params['dir_date']               = $this->dateFolderUpload();
        $this->params['extension']  = $this->dataFileName['extension'];
        $this->params['size']       = $this->file->getSize();  
        $this->params['mime_type']  = $this->file->getMimeType();
        $this->params['url']        = Storage::disk($this->storageName)->url($this->dateFolderUpload() . '/' . $this->fileName);
    }

    public function upload() {
        // $this->file->storeAs($dateFolderUpload, $fileName, $this->storageName);
        self::file_main_upload();
        // Thay đổi kích thước nếu là ảnh
        if(in_array($this->dataFileName['extension'], $this->img_resize)) {            
            $this->dataResizeFileName['thumb'] = self::resize_thumb($this->dataFileName);
            self::resize_img();
            if($this->convert_to_webp === true && in_array($this->dataFileName['extension'], $this->extension_to_webp)) {                 
                self::convert_to_webp();
                if($this->deleteFileUpload === true) self::delete_file_after_cutting();                
                // $this->params['name'] = $this->dataFileName['name'] . '.webp';
                // $fileTmp = $this->dateFolderUpload() . '/' . $this->dataFileName['name'] . '.webp';
                // $this->params['size'] = Storage::disk($this->storageName)->size($fileTmp);
                // $this->params['url']  = Storage::disk($this->storageName)->url($fileTmp);
            }
        }

        return  $this->params;
    }

    public function checkExtensionToWebp($extension) {
        return in_array($extension, $this->extension_to_webp);
    }

    public function getFileNameAndExtension($fileName) {
        $data = array();
        $data['name']       = preg_replace('/\.[^.]+$/i', '', $fileName);
        $newName = addcslashes($data['name'], '~`!@#().,+-^$%&*{}[]:;"|');
        $data['extension']  = preg_replace('/'. $newName .'\./i', '', $fileName);
        return $data;
    }

    public function fileNameNoExtension($fileName) {
        return preg_replace('/\.[^.]+$/i', '', $fileName);
    }
    /**
     * Ham tao thu muc upload theo thang vd: 2021/04
     */
    public function dateFolderUpload() {
        $date = new \DateTime();
        return $date->format('Y/m');
    }
    /**
     * Thuat toan De quy xu ly doi ten file upload
     */
    public function changeNameFileUpload($storageName, $fileNameUpload, $dateFolder, $oldFileNameUpload, $i = 1) {
        
        $data_file = $this->getFileNameAndExtension($fileNameUpload);

        $data_file['name']      = Str::slug($data_file['name'], '-');
        $data_file['extension'] = strtolower($data_file['extension']);

        $fileNameUpload = $data_file['name'] . '.' . $data_file['extension'];
        $fileNameCheck  = $fileNameUpload;

        if($this->checkExtensionToWebp($data_file['extension'])) {
            $fileNameCheck = $data_file['name'] . '.webp';            
        } 
        // Kiểm tra xem tập tin có chuyển đổi được sang webp hay không
        // Nếu có thì thêm kiểm tra tập tin webp đã tồn tại hay chưa
        $checkNameUpload = Storage::disk($storageName)->exists($dateFolder . '/' . $fileNameUpload);
        $checkNameWebp = Storage::disk($storageName)->exists($dateFolder . '/' . $fileNameCheck);
        if ($checkNameUpload || $checkNameWebp) {
            $data_file = $this->getFileNameAndExtension($oldFileNameUpload);

            $data_file['name']      = Str::slug($data_file['name'], '-');
            $data_file['extension'] = strtolower($data_file['extension']);
            $fileNameUpload = $data_file['name'] . '-' . $i . '.' . $data_file['extension'];
            $i++;
            return $this->changeNameFileUpload($storageName, $fileNameUpload, $dateFolder, $oldFileNameUpload, $i);
        } else {
            return $fileNameUpload;
        }
    }

    public function file_main_upload() {     
        $this->dataResizeFileName['main'] = $this->fileName;
        $this->file->storeAs($this->dateFolderUpload(), $this->fileName, $this->storageName);
    }

    public function resize_thumb($dataFileName) {
        $public_path = $this->public_folder . $this->dateFolderUpload() . '/';

        $image_resize = Image::make($this->file->getRealPath());

        $image_resize->resize($this->size_thumb['width'], $this->size_thumb['height']);
        $resizeFilenametmp = $dataFileName['name'] . '-' . $this->size_thumb['width'] . 'x' . $this->size_thumb['height'] . '.' . $dataFileName['extension'];
        $image_resize->save(public_path($public_path . $resizeFilenametmp));
        return $resizeFilenametmp;
    }

    public function resize_img() {        
        $public_path = $this->public_folder . $this->dateFolderUpload() . '/';

        $image_resize = Image::make(public_path($public_path . $this->fileName));

        $width  = $image_resize->width();
        $height = $image_resize->height();
        $tmp_size_img = array();

        if($width >= $height) {
            foreach($this->size_img as $key => $value) {
                if($value['width'] > $width) continue;
                $tmp_size_img[$key] = [
                    'width'     => $value['width'],
                    'height'    => $value['height']
                ];
            }
            foreach($tmp_size_img as $key => $value) {
                $image_resize->resize($value['width'], null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $resizeFilenametmp = $this->dataFileName['name'] . '-' . $value['width'] . 'x' . $image_resize->height() . '.' .$this->dataFileName['extension'];
                $this->dataResizeFileName[$key] = $resizeFilenametmp;
                $image_resize->save(public_path($public_path . $resizeFilenametmp));
            }
        } else {
            foreach($this->size_img as $key => $value) {
                if($value['height'] > $height) continue;
                $tmp_size_img[$key] = [
                    'width'     => $value['width'],
                    'height'    => $value['height']
                ];
            }
            foreach($tmp_size_img as $key => $value) {
                $image_resize->resize(null, $value['height'], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $resizeFilenametmp = $this->dataFileName['name'] . '-' . $image_resize->width() . 'x' . $value['height'] . '.' .$this->dataFileName['extension'];
                $this->dataResizeFileName[$key] = $resizeFilenametmp;
                $image_resize->save(public_path($public_path . $resizeFilenametmp));
            }
        }
    }

    public function convert_to_webp() {
        $public_path = $this->public_folder . $this->dateFolderUpload() . '/';
        $extension = $this->dataFileName['extension'];
        foreach($this->dataResizeFileName as $value) {
            $path = public_path($public_path . $value);
            $nameFile = $this->getFileNameAndExtension($value);
            if($extension == 'png') {
                $img = imagecreatefrompng($path);
            }

            if($extension == 'jpg' || $extension == 'jpeg') {
                $img = imagecreatefromjpeg($path);
            } 
            imagepalettetotruecolor($img);       
            imagewebp($img, public_path($public_path . $nameFile['name'] . ".webp"), 60);
        }
        
    }

    public function delete_file_after_cutting() {
        foreach($this->dataResizeFileName as $fileName) {
            Storage::disk($this->storageName)->delete($this->dateFolderUpload() . '/' . $fileName);
        }
    }

    public function url_thum_150() {
        if(in_array($this->dataFileName['extension'], $this->thumb_systems)) {
            $url = Storage::disk($this->storageSystems)->url($this->dataFileName['extension'] . '.png');
        } else {
            $fileTmp = $this->dateFolderUpload() . '/' . $this->dataFileName['name'] . '-' . $this->size_thumb['width'] . 'x' . $this->size_thumb['height'] . '.' . $this->dataFileName['extension'];
            $url = Storage::disk($this->storageName)->url($fileTmp);
        }
        
        return $url;
    }
}