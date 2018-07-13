<?php
namespace Laravolt\Etalase;

class Etalase
{
    protected $title = 'Untitled';

    public function start($title, $view = '')
    {
        $this->title = $title;

        if ($view === '') {
            ob_start();
        } else {
            $content = view($view)->render();
            $title = $this->title;

            return view('etalase::container', compact('content', 'title'));
        }
    }

    public function stop()
    {
        $content = ob_get_clean();
        $title = $this->title;

        return view('etalase::container', compact('content', 'title'));
    }
}
