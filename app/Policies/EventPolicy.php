<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    
    public function viewAny(User $user)
    {
        // Organizer can view only their own events
        return $user->hasRole('organizer');
    }

    
    public function view(User $user, Event $event)
    {
        // Organizer can view only their own events
        return $user->id === $event->organizer_id;
    }

    
    public function create(User $user)
    {
        // Only organizers can create events
        return $user->hasRole('organizer');
    }

    
    public function update(User $user, Event $event)
    {
        // Organizer can update only their own events
        
        return $user->id === $event->organizer_id;
    }

    
    public function delete(User $user, Event $event)
    {
        // Organizer can delete only their own events
        return $user->id === $event->organizer_id;
    }
}
