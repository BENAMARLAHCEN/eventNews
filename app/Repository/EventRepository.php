<?php

namespace App\Repository;

use App\Models\Event;
use App\Repository\Interface\IEventRepository;

class EventRepository implements IEventRepository
{
    public function list(int $perPage = 10)
    {
        return Event::latest()->paginate($perPage);
    }

    // Schema::create('events', function (Blueprint $table) {
    //     $table->id();
    //     $table->string('title');
    //     $table->text('description');
    //     $table->dateTime('event_date');
    //     $table->string('location');
    //     $table->enum('reservation_approval_mode', ['automatic', 'manual'])->default('automatic');
    //     $table->unsignedBigInteger('category_id');
    //     $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    //     $table->unsignedBigInteger('organizer_id');
    //     $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
    //     $table->integer('capacity');
    //     $table->timestamps();
    // });

    public function listPending(int $perPage = 10)
    {
        return Event::latest()->where('status', 'pending')->paginate($perPage);
    }

    public function listByUser($userId, $perPage = 10)
    {
        return Event::latest()->where('organizer_id', $userId)->paginate($perPage);
    }

    public function listPublished(int $perPage = 10)
    {
        return Event::latest()->where('status', 'published')->paginate($perPage);
    }

    public function listRejected(int $perPage = 10)
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
}
