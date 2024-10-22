<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ChatController extends Controller
{
    public function  index()
    {
        $users = User::all();
        return view('livewire.chat.chat', compact('users'));
    }
    // public function fetchChat($userId){
    //     dd($userId);
    // }

    public function fetchChat($userId)
    {
       
        try {
            // Retrieve messages associated with the given user ID
            
            $messages = Chat::where('reciever_id',$userId)->get();
            return response()->json($messages); // Return messages as JSON
        } catch (\Exception $e) {
            return response()->json([], 500); // Return empty JSON and handle error
        }
    }

    public function sendMessage(Request $request)
    {
        // Start the transaction
        DB::beginTransaction();

        try {
            // Create a new Chat instance
            $Chat = new Chat;
            $Chat->sender_id = $request->sender_id; // You can dynamically pass the sender_id from the request
            // $Chat->user_id = $request->user_id;
            $Chat->reciever_id = $request->reciever_id; // You can dynamically pass the receiver_id as well
            $Chat->message = $request->message; 
            $Chat->status = 1;

            // Save the message
            $Chat->save();

            // If all goes well, commit the transaction
            DB::commit();

            return response()->json(['message' => $request->message], 200);
        } catch (\Exception $e) {
            // If there is an exception, rollback the transaction
            DB::rollBack();

            // Log the error or return a response
            $e->getMessage();

            return response()->json(['status' => 'Message sending failed!', 'error' => $e->getMessage()], 500);
        }
    }
}
