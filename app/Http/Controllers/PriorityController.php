<?php

// PriorityController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priority;

class PriorityController extends Controller
{
    public function listPriorities()
    {
        $priorities = Priority::all();
        dd($priorities);
        return view('createtask', ['priorities' => $priorities]);
    }
}

