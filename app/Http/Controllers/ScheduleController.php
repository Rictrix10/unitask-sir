<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        return view('schedule.index');
    }

    public function getEvents(){
        $schedules=Schedule::all();
        return response()->json($schedules);
    }
}