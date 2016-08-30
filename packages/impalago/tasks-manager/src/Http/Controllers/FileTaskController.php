<?php

namespace Impalago\TasksManager\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Impalago\TasksManager\Models\Task;
use Impalago\TasksManager\Models\FileTask;

class FileTaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('sentry.auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeFiles(Request $request, $id)
    {
        $file = $request->file('file');

        $destinationPath = config('tasks.upload_path');
        $filename = explode('.', $file->getClientOriginalName())[0] . '_' . time() . '.' . $file->getClientOriginalExtension();
        $upload_success = $request->file('file')->move($destinationPath, $filename);

        if ($upload_success) {

            $file = new FileTask([
                'file' => $filename,
                'original_name' => $file->getClientOriginalName()
            ]);

            $task = Task::find($id);
            $newFile = $task->files()->save($file);
            if ($newFile) {
                return response()->json($newFile->id, 200);
            }
        }

        return response()->json('error', 400);

    }

    /**
     * @param $filename
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
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

    /**
     * @param $id
     * @return string
     */
    public function destroyFile($id)
    {
        $file = FileTask::find($id);
        $filePath = 'upload/tasks/' . $file->file;
        if (FileTask::destroy($id) and Storage::disk('local')->delete($filePath)) {
            return 'success';
        }
        return 'error';
    }

}
