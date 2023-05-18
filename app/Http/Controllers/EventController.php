<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

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
        if ($this->betweenDates()) {
            return redirect()->route('events.index')->with('status', 'Você já cadastrou um evento hoje');
        }
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        if ($this->betweenDates()) {
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
    public function show(Event $event)
    {
        //police para ver evento único
        $this->authorize('view', [$event]);

        return view('event.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //policy para ver se pode visualizar a edição
        $this->authorize('update', [$event]);

        return view('event.update', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Event $event, EventRequest $request)
    {

        // dd($request->route('event')->id);
        //police para ver se está atualizando
        $this->authorize('update', $event);

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

        // dd($event);
        //police para ver se está atualizando
        $this->authorize('delete', [$event]);

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
    static function betweenDates(): bool
    {
        $today = now()->toDateString();
        //  dd($today);

        $event = Event::with('user')
            ->where('user_id', Auth::id())
            ->where('start', '<=', $today)
            ->where('end', '>=', $today)->first();

        // dd(($event) ? true : false);
        return (empty($event) && is_null($event)) ? true : false;
        
        
        //código pesquisa por created_at
        // $event = Event::with('user')
        //     ->where('user_id', Auth::id())
        //     ->whereDate('created_at', today())
        //     ->first();

        // if (empty($event) && is_null($event)) {
        //     return false;
        // }

        // return true;
    }
}
