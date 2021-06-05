<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatuRequest;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function store(StoreStatuRequest $request){
        $status = Status::create([
            'body' => $request->get('body'),
            'user_id' => auth()->id()
        ]);

        return response()->json(['body' => $status->body]);
    }
}
