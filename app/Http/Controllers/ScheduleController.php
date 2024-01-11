<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Task;

class ScheduleController extends Controller
{
    public function index(){
        return view('schedule.index');
    }


    /*
    public function getEvents(){
        //$schedules = Task::all();
        $schedules = Task::all(['id_task as id', 'name as title', 'initial_date as start', 'finish_date as end', 'color as color']);
        //$userId = Session::get('id_user');
        //$schedules = Task::where('id_user', $userId);
        return response()->json($schedules);
    }
    */


    public function getEvents(){
        $userId = Session::get('id_user');
    
        $schedules = Task::where('id_user', $userId)
            ->select(['id_task as id', 'name as title', 'initial_date as start', 'finish_date as end', 'color as color'])
            ->get();
    
        return response()->json($schedules);
    }
    

    public function deleteEvent($id){
        $schedule = Task::findOrFail($id);
        $schedule->delete();

        return response()->json(['message'=> 'Evento eliminado com sucesso']);
    }

    public function update(Request $request, $id){
        $schedule = Task::findOrFail($id);

        $schedule->update([
            'initial_date'=>Carbon::parse($request->input('start'))->setTimezone('UTC'),
            'finish_date'=>Carbon::parse($request->input('end'))->setTimezone('UTC'),
        ]);

        return response()->json(['message' => 'Evento movido com sucesso']);
    }

    public function resize(Request $request, $id){
        $schedule = Task::findOrFail($id);

        $newFinishDate = Carbon::parse($request->input('end'))->setTimezone('UTC');
        $schedule->update(['finish_date' => $newFinishDate]);

        return response()->json(['message' => 'Evento redimensionado com sucesso']);
    }

    

    
}