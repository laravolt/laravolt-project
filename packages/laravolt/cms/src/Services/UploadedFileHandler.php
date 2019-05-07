<?php

namespace Laravolt\Cms\Services;

use Portal\Site\Model\Media;
use Portal\Support\Services\FileUploader;

class UploadedFileHandler
{
    protected $key;

    /**
     * UploadedFileHandler constructor.
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function save()
    {
        $key = $this->key;

        // Clear image field if user remove existing image
        $fileRemoved = request("uploader.$key") === '[]';
        if ($fileRemoved) {
            return [$key => null];
        }

        $param = array_first(json_decode(array_get(request()->get("uploader"), $key), true));
        $media = null;
        if (($path = array_get($param, 'file')) !== null) {
            $mediaId = array_last(explode('/', dirname(parse_url($path)['path'])));
            $media = Media::find($mediaId);
        }

        $editor = $param['editor'] ?? [];

        $uploadedFile = request()->file($key);
        if (!$uploadedFile) {
            // Image cropped/rotated, but not re-uploaded
            if ($media && (isset($editor['crop']) || isset($editor['rotation']))) {
                $originalFile = $media->getPath();
                $destinationFile = storage_path(
                    "tmp/".$media->file_name
                );

                $saved = FileUploader::resize(
                    $originalFile,
                    null,
                    null,
                    $destinationFile,
                    (isset($editor['crop']) ? $editor['crop'] : null),
                    100,
                    (isset($editor['rotation']) ?
                        $editor['rotation'] : null)
                );

                if ($saved) {
                    $media = auth()->user()->addMedia($destinationFile)->toMediaCollection('media');
                }

                return [$key => $media->getFullUrl()];
            }

            return [];
        }

        $originalFile = $uploadedFile->getPathname();
        $destinationFile = storage_path(
            "tmp/".$uploadedFile->getFilename().".".$uploadedFile
                ->getClientOriginalExtension()
        );

        $saved = FileUploader::resize(
            $originalFile,
            null,
            null,
            $destinationFile,
            (isset($editor['crop']) ? $editor['crop'] : null),
            100,
            (isset($editor['rotation']) ?
                $editor['rotation'] : null)
        );

        if (!$saved) {
            $media = auth()->user()->addMediaFromRequest($key)->toMediaCollection('media');
        } else {
            $media = auth()->user()->addMedia($destinationFile)->toMediaCollection('media');
        }

        return [$key => $media->getFullUrl()];
    }
}
