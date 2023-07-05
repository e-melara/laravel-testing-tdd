<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function store()
    {
        $status = Status::create([
            "user_id" => auth()->id(),
            "body" => request("body")
        ]);

        return response()->json([
            "body" => $status->body
        ]);
    }
}
