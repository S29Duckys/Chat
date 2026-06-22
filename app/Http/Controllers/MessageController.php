<?php

// app/Http/Controllers/MessageController.php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Page du chat — reçoit l'ID de session du destinataire en paramètre URL
    // Ex: /chat?with=LEUR_SESSION_ID
    public function index(Request $request)
    {
        $receiverId = $request->query('with');

        // Si pas de destinataire dans l'URL, on ne peut pas ouvrir le chat
        if (!$receiverId) {
            abort(400, 'Destinataire manquant. Ajoute ?with=SESSION_ID dans l\'URL.');
        }

        return view('chat', [
            'myId'       => session()->getId(),
            'receiverId' => $receiverId,
        ]);
    }

    // Envoi d'un message via POST
public function send(Request $request)
{
    $request->validate([
        'message'    => 'required|string|max:500',
        'receiverId' => 'required|string',
    ]);

    try {
        broadcast(new MessageSent(
            message:    $request->message,
            senderId:   session()->getId(),
            receiverId: $request->receiverId,
            time:       now()->format('H:i'),
        ));
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }

    return response()->json(['ok' => true]);
}
}