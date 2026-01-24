<?php

namespace App\Controller;

use Core\DB;
use Core\Request;
use Exception;

class WebController
{
    public function home(Request $request)
    {
        $dbstatus_message = '<span>Database successfully connected</span>';

        try {
            DB::mysql();
        } catch (Exception $e) {
            $dbstatus_message = "<b style=\"color:red\">Connection error:</b> " . $e->getMessage();
        }

        return view('home', [
            'php_version' => phpversion(),
            'dbstatus_message' => $dbstatus_message,
        ]);
    }
}

