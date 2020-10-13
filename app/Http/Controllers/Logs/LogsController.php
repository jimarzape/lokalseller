<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Models\SystemLogs;
use Auth;

class LogsController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    	$this->data['_pages'] = pages('Logs');
    }

    public function index()
    {
    	$this->data['_logs'] = SystemLogs::details(Auth()->user()->id)->paginate(20);
    	return view('systems.logs',$this->data);
    }
}
