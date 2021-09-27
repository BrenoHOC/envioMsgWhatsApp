<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessageCollection;
use Illuminate\Http\Response;
use App\Http\Requests\MessageFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MessagesController extends Controller
{
    public function index()
    {
        $data = Message::all();
        
        return (new MessageCollection($data));
    }
    
    public function show($id)
    {
        $data = Message::findOrFail($id);

        return (new MessageResource($data));
    }
    
    public function store(MessageFormRequest $request)
    {
        $message = Message::create($request->post());
        
        $resource = new MessageResource($message);
        
        $resource->additional(['Message' => 'Created sucessfully!']);
        $resource->response()->setStatusCode(Response::HTTP_CREATED);
        
        return $resource;
    }
    
    public function update(Request $request, Message $message)
    {
        $message->fill($request->post())->save();
        
        return response()->json([
            'message'=>$message
        ]);
    }
    
    public function destroy($id)
    {
        $message = Message::find($id);

        if(is_null($message)) throw new HttpResponseException(response()->json(['error' => 'ID is not exists.'], 422));
        
        $message->delete();

        return response()->json([
            'message'=>'Message Deleted Successfully!!'
        ]);
    }
}
