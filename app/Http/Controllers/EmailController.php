<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    
    public function destroy(Email $email)
    {
        $email->delete();
        return response()->noContent();
    }
}
