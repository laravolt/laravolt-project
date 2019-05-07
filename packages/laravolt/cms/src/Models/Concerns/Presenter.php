<?php

namespace Laravolt\Cms\Models\Concerns;

use Jenssegers\Date\Date;
use Portal\Support\Enum\ContentStatus;
use Portal\Web\Contracts\WithinPost;
use Thunder\Shortcode\ShortcodeFacade;

trait Presenter
{
    public function getPresentContentAttribute()
    {
        $shortcodeFacade = new ShortcodeFacade();
        foreach (static::$shortcodes as $name => $handler) {
            if ($handler instanceof WithinPost) {
                $handler->setPost($this);
            }

            $shortcodeFacade->addHandler($name, $handler);
        }

        // If there is no content (empty string) for current active local, use content for fallback locale.
        $content = $this->content ?: $this->getTranslation('content', config('app.fallback_locale'));

        return $shortcodeFacade->process($content);
    }

    public function getPresentStatusAttribute()
    {
        try {
            $status = new ContentStatus($this->status);
        } catch (\Exception $e) {
            $status = new ContentStatus();
        }

        return sprintf(
            '<span class="ui mini basic label %s">%s</span>',
            $status->getColor(),
            $status->label()
        );
    }

    public function getPresentExcerptAttribute()
    {
        return str_limit(strip_tags(html_entity_decode($this->content)));
    }

    public function getPresentPublishedAtAttribute()
    {
        //@todo: change to column published_at
        return Date::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('F j, Y');
    }
}
