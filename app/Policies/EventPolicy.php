<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventPolicy
{

     /**
     * Define a política global para todas as outras políticas de evento.
     * Before = true todas as outras políticas são ignoradas (super admin)
     * Before = false todas as políticas serão proibidas
     * Before = null todas as outras políticas serão aplicadas
     */
    public function before(User $user)
    {
        // if ($user->role() === 'Super Admin') {
        //     return true; // não aplica as outras políticas
        // }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     * Método INDEX
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * Método SHOW
     */
    public function view(User $user, Event $event): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * Método CREATE E STORE
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * Método EDIT E UPDATE
     */
    public function update(User $user, Event $event, Request $request = null): bool
    {
        if ($request === null) {
            // Se $request é nulo, então o usuário está visualizando a edição.
            return $user->id === $event->user_id;
        }
    
        // Se $request não é nulo, então o usuário está tentando atualizar o evento.
        return $user->id === $event->user_id && $event->id === $request->route('event')->id;

    }

    /**
     * Determine whether the user can delete the model.
     * Método DESTROY
     */
    public function delete(User $user, Event $event): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model (softDelete).
     */
    public function restore(User $user, Event $event): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model (softDelete).
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return true;
    }
}
