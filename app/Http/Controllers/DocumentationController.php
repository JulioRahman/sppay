<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Laminas\Diactoros\Response\HtmlResponse;

class DocumentationController extends Controller
{
    public function indexAPI()
    {

        return response()->file(resource_path('views/documentations/api/build/index.html'));
        // return Response::caps('documentations.api.build.index');
    }
}
