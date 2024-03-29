<?php

namespace App\Repository;

use App\Models\Event;
use App\Repository\Interface\IEventRepository;

class EventRepository implements IEventRepository
{
    public function list(int $perPage = 8)
    {
        return Event::latest()->paginate($perPage);
    }
    public function listPending(int $perPage = 8)
    {
        return Event::latest()->where('status', 'pending')->paginate($perPage);
    }

    public function listByUser($userId, $perPage = 8)
    {
        return Event::latest()->where('organizer_id', $userId)->paginate($perPage);
    }

    public function listPublished(int $perPage = 8)
    {
        return Event::latest()->where('status', 'published')->paginate($perPage);
    }

    public function listRejected(int $perPage = 8)
    {
        return Event::latest()->where('status', 'draft')->paginate($perPage);
    }

    public function accepte($id)
    {
        $event = $this->findById($id);
        $event->update(['status' => 'published']);
        return $event;
    }

    public function reject($id)
    {
        $event = $this->findById($id);
        $event->update(['status' => 'draft']);
        return $event;
    }

    public function findById($id)
    {
        return Event::findOrFail($id);
    }

    public function storeOrUpdate($data = [], $id = null)
    {
        if ($id) {
            $event = $this->findById($id);
            $event->update($data);
            return $event;
        } else {
            return Event::create($data);
        }
    }

    public function destroyById($id)
    {
        $event = $this->findById($id);
        $event->delete();
    }

    public function search($search, $category = null)
    {
        $query = Event::query();
        if ($search || $category != null) {
            $query->where('title', 'like', "%$search%");
        }
        if ($category != null) {
            $query->whereIn('category_id', $category);
        }
        return $query->latest()->where('status', 'published')->get(); 
    }
}
