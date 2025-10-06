<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'data' => Contact::query()
                ->when($request->input('name'), function ($query, $value) {
                    $query->where('name', 'like', "%{$value}%");
                })
                ->when($request->input('phone'), function ($query, $value) {
                    $query->where('phone', 'like', "%{$value}%");
                })
                ->get(['id', 'name', 'phone']),
        ]);
    }

    public function destroy(Contact $contact): Response
    {
        $contact->delete();

        return response()->noContent();
    }

}
