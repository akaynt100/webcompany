<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class File extends Model
{
    protected $table = 'order_files';

    protected $guarded = ['id'];

    public function storagePath($orderId)
    {
        return 'user/orders/' . $orderId;
    }



    /**
     * @param UploadedFile $file
     * @param $orderId
     * @return string
     */
    public function saveFile(UploadedFile $file, $orderId)
    {
        $fileName = $this->getFileName($file);
        $basePath = $this->storagePath($orderId);
        return $file->storeAs($basePath, $fileName);
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function getFileName(UploadedFile $file)
    {
        return $file->getFilename() . '.' . $file->guessClientExtension();
    }

    /**
     * @param UploadedFile $file
     * @return null|string
     */
    public function getFileOriginalName(UploadedFile $file)
    {
        return $file->getClientOriginalName();
    }

    /**
     * @param $orderId
     * @param $fileId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getFile($orderId, $fileId)
    {
        \Auth::user()->can('order.file.download');

        $path = $this
            ->findOrFail($orderId)
            ->file()
            ->findOrFail($fileId)
            ->storage_path;

        $storagePath = storage_path($path);

        return response()->download($storagePath);
    }


}
