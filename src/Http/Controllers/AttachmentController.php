<?php

namespace OpenJournalTeam\Core\Http\Controllers;

use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Response;
use OpenJournalTeam\Core\Classes\AttachmentManager;
use Illuminate\Support\Facades\File;
use OpenJournalTeam\Core\Http\Resources\JsonResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AttachmentController extends BaseController
{
  public const ALLOWED_FILE = 'csv,txt,xlx,xls,pdf,gif,jpeg,jpg,png,pdf,gif,xls,xlsx,txt,geojson,doc,docx';
  public const ALLOWED_MAX_SIZE = 1024 * 1024 * 10; // 10 MB;
  public AttachmentManager $attachmentManager;

  public function __construct()
  {
    $this->attachmentManager = app(AttachmentManager::class);
  }

  /**
   * Handles the file upload
   *
   * @param FileReceiver $receiver
   *
   * @return \Illuminate\Http\JsonResponse
   *
   * @throws UploadMissingFileException
   *
   */
  public function upload(FileReceiver $receiver)
  {
    // check if the upload is success, throw exception or return response you need
    if ($receiver->isUploaded() === false) {
      throw new UploadMissingFileException();
    }

    // receive the file
    $save = $receiver->receive();

    // check if the upload has finished (in chunk mode it will send smaller files)
    if ($save->isFinished()) {
      // save the file and return any response you need
      return $this->saveTemporaryFile($save->getFile());
    }

    // we are in chunk mode, lets send the current progress
    /** @var AbstractHandler $handler */
    $handler = $save->handler();
    return response()->json([
      "done" => $handler->getPercentageDone()
    ]);
  }

  /**
   * Saves the file
   *
   * @param UploadedFile $file
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function saveTemporaryFile(UploadedFile $file)
  {
    $fileName = $file->getClientOriginalName();

    $timestamp = now()->timestamp;

    // Build the file path
    $filePath =  "upload/temporary/{$timestamp}/";
    $finalPath = storage_path($filePath);

    // move the file name
    $file->move($finalPath, $fileName);

    return Response::make($this->attachmentManager->getEncryptFromPath($finalPath . $fileName), 200, [
      'Content-Type' => 'text/plain',
    ]);
  }

  public function delete(Media $media)
  {
    $media->delete();

    return new JsonResponse(['msg' => 'Success delete file..']);
  }

  public function delete_temporary(string $encryptedFilePath)
  {
    File::delete($this->attachmentManager->getPathFromEncrypt($encryptedFilePath));

    return new JsonResponse(['msg' => 'Success delete temporary file..']);
  }
}
