<?php

namespace App\Http\Controllers\Office;

use App\FilamentDigitalOffice\Pages\DigitalOffice;
use App\Http\Controllers\Controller;
use App\Models\DigitalOffice as ModelsDigitalOffice;
use App\Models\Thread;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ModelsDigitalOffice $digitalOffice)
    {
        return view('pages.office.messages.index', ['officeId' => $digitalOffice->id]);
    }

    public function show($officeId, $threadId) {
        $thread = Thread::find($threadId);
        return view('pages.office.messages.show', ['thread' => $thread]);
    }
}
