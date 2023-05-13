<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\BooleanNot;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $events = Event::with('user')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')->get(); //Event::all();

        return view('event.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($this->createdToday()) {
            return redirect()->route('events.index')->with('status', 'Você já cadastrou um evento hoje');
        }
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        if ($this->createdToday()) {
            return redirect()->route('events.index')->with('status', 'Não foi possível cadastra, você já cadastrou um evento hoje');
        }


        $data = $request->validated(); //valida o request
        $data['user_id'] = Auth::id(); //mudar quando fizer login
        //dd($data);

        try {
            Event::create($data);
            return redirect()->route('events.index')->with('status', 'Evento cadastrado com sucesso');
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
    public function destroy(Event $event)
    {
        try {
            $event->delete();
            return back()->with('status', 'Deletado com sucesso!');
        } catch (\Exception $exception) {
            return back()->withErrors(['internal' => 'Evento não foi possível ser excluído']);
        }
    }


/**
 * Verifica se já houve cadastro hoje
 *
 * @return boolean
 */
    static function createdToday(): bool
    {
        $event = Event::with('user')
            ->where('user_id', Auth::id())
            ->whereDate('created_at', today())
            ->first();

        if (empty($event) && is_null($event)) {
            return false;
        }

        return true;
    }
}
