<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Question;
use Illuminate\Http\Request;
use App\Events\DeleteReplyEvent;
use App\Http\Resources\ReplyResource;
use App\Notifications\NewReplyNotification;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }


    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create([
            'body' => $request->body,
        ]);

        $user = $question->user;
        $user->notify(new NewReplyNotification($reply));

        return response(['reply' => new ReplyResource($reply)], Response::HTTP_CREATED);
    }


    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    public function update(Question $question, Request $request, Reply $reply)
    {
        $r = $reply->update($request->all());
        //  return response($r);
        return response('updated', Response::HTTP_OK);
    }

    
    
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
