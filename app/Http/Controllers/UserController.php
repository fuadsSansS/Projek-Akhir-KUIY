<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $dataUsers = User::where('role', 'user')
            ->orderBy('name')
            ->paginate(5)
        ;

        return view('users', compact('dataUsers'));
    }
}
