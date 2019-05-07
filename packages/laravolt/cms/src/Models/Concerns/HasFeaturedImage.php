<?php

namespace Laravolt\Cms\Models\Concerns;

use Laravolt\Cms\Services\UploadedFileHandler;
use Portal\Site\Model\Setting;

trait HasFeaturedImage
{
    protected function getFeaturedImageAttribute()
    {
        // This is list of possible image path, ordered by priority
        $default = 'site.default_image.'.$this->getAttribute('type');
        $image = Setting::select('value')->where('key', '=', $default)->first();
        $url = null;
        if ($image) {
            $url = $image->value;
        }



        return collect(
            [
                // First is value recorded in database
                $this->meta->featured_image,

                // Secondly, we check default image based on model type in setting table
                $url,

                // Secondly, we check default image based on model type in config
                config('site.default_image.'.$this->getAttribute('type')),

                // The last is default image for all content, we assume this file exists.
                asset('img/placeholder/banner.png'),
            ]
        )
            // Remove all null/empty/false value
            ->filter()
            // Get first item, because we order by priority
            ->first();
    }

    protected function setFeaturedImageAttribute(string $url)
    {
        $this->meta->featured_image = $url;
    }

    public function handleFeaturedImageRequest($key = 'featured_image')
    {
        return (new UploadedFileHandler($key))->save();
    }
}
