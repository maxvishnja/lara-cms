<?php

namespace Impalago\TasksManager\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class TaskFileController extends Controller
{

    public function downloadFile($filename)
    {
        $file_path = storage_path() . '/app/upload/tasks/' . $filename;

        if (file_exists($file_path)) {

            return response()->download($file_path, $filename, [
                'Content-Length: ' . filesize($file_path)
            ]);
        } else {
            exit('Requested file does not exist on our server!');
        }
    }

}
