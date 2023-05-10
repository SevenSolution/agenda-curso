<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $events = Event::with('user')->get(); //Event::all();
        
         //dd($events->toArray());
        return view('event.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated(); //valida o request
        $data['user_id'] = 1; //mudar quando fizer login
        //dd($data);

        try {
            Event::create($data);

            return back()->with('status', 'Evento cadastrado com sucesso');
        } catch (\Exception $exception) {
            return back()->withErrors(['internal' => 'Evento não foi possível cadastrar']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('event.update', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();
        
      try {
        $event->update($data);
        return redirect()->route('events.index')->with('status', 'Evento atualizado com sucesso');
      } catch (\Exception $exception) {
        return back()->withErrors(['internal' => 'Evento não foi possível atualizar']);   
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
