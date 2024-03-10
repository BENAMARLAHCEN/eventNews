<?php

namespace App\Http\Controllers;

use App\Repository\Interface\ICategoryRepository;
use App\Repository\Interface\IEventRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $event;
    protected $category;

    public function __construct(IEventRepository $event, ICategoryRepository $category)
    {
        $this->event = $event;
        $this->category = $category;
    }

    public function index()
    {
        $events = $this->event->listPublished(6);
        $categories = $this->category->random();
        return view('home', compact('events','categories'));
    }

    public function blog()
    {
        $events = $this->event->listPublished(10);
        $categories = $this->category->all();
        return view('blog', compact('events','categories'));
    }


    public function search(Request $request)
    {
        $ids = explode(',', $request->categories);
        $events = $this->event->search($request->search,$ids);
        return view('test.search', compact('events'));
    }



    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function faq()
    {
        return view('faq');
    }
}
