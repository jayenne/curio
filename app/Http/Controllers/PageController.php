<?php

namespace App\Http\Controllers;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function show(Request $request, $page)
    {
        $path = \Request::route()->getName();
        $page = str_replace('-', '.', $page);
        $viewpath = implode('.', [$path, $page]);
        $data = $request->query();

        if (view()->exists($viewpath)) {
            $resource = view($viewpath)->with(['path' => $path, 'page' => $page, 'data' => $data]);
        } else {
            abort(404, 'view not found');
        }

        return $resource;
    }
}
