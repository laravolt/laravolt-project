<?php

namespace Laravolt\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MediaController extends Controller
{
    public function index(Request $request)
    {
    }

    public function store(Request $request)
    {

        try {
            $media = auth()->user()->addMediaFromRequest('file')->toMediaCollection();

            return response()->json(
                [
                    'url' => $media->getFullUrl(),
                    'id'  => $media->getKey(),
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ]
            );
        }
    }
}
