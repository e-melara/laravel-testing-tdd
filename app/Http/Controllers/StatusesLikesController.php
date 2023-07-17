<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusesLikesController extends Controller
{
    public function store(Status $status) {
        $status->like();
    }

    public function destroy(Status $status) {
        $status->unlike();
    }
}
