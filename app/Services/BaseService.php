<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BaseService
{

    public function __construct(

    ) {

    }

    public function updateStatus($request, $subFolder)
    {
        DB::beginTransaction();
        try {
            $payload[$request->input('field')] = (($request->input('checked') == 'false') ? 1 : 2);

            $folder = 'Repositories' . '\\' . $subFolder;
            $interface = 'Repository';

            $class = loadClass($request->input('model'), $folder, $interface);
            $class->update($payload, $request->input('id'));

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
