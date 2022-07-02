<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Comment;

class ReportController extends Controller
{

    public function index() {

        $user = auth()->user();

        $search = request('search');

        if ($search) {
            $search = ucfirst($search);
            $reports = Report::where([
                ['tags', 'like', '%'.$search.'%']
            ])->get();    
        } else {
            $reports = Report::latest()->paginate(4);
        }

        return view('welcome', ['reports' => $reports, 'search' => $search, 'user' => $user]);
    }

    public function create() { // exclusiva para autores

        $user = auth()->user();
        
        if ($user->author) {
            return view('reports.create', ['user' => $user]);    
        } else {
            return redirect('/');
        }           
    }

    public function store(Request $request) { //C

        $validated = $request->validate([
            'title' => 'required|unique:reports|max:255',
            'date' => 'required',
            'game' => 'required',
            'description' => 'required|unique:reports',
            'report' => 'required|unique:reports',
            'city' => 'required',
            'tags' => 'required'
        ]);

        $report = new Report;

        $report->title = $request->title;
        $report->date = $request->date;
        $report->game = $request->game;
        $report->description = $request->description;
        $report->report = $request->report;
        $report->city = $request->city;
        $report->authors = $request->authors;
        $report->tags = $request->tags;

        // Image Upload
        if($request->hasFile('image') ** $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->image->move(public_path('img/reports'), $imageName);

            $report->image = $imageName;
        }

        $user = auth()->user();
        $report->user_id = $user->id;

        $report->save();

        return redirect('/')->with('msg', 'Noticia Enviada!');
    }

    public function show($id) {

        $user = auth()->user();

        $report = Report::findOrFail($id);

        $tags = explode(' ', $report->tags);
        $report->tags = $tags;

        //author
        $reportOwner = User::where('id', $report->user_id)->first()->toArray();

        //comments
        $allcomments = Comment::all();
        $comments = $allcomments->where('report_id', $report->id);


        return view('reports.show', ['report' => $report, 'reportOwner' => $reportOwner, 'comments' => $comments, 'user' => $user]);

    }

    public function dashboard() {

        $user = auth()->user();

        $reports = $user->reports;

        if ($user->author) {
            return view('reports.dashboard', ['reports' => $reports, 'user' => $user]);    
        } else {
            return redirect('/');
        } 
    }

    public function edit($id) {

        $user = auth()->user();

        $report = Report::findOrFail($id);

        if ($user->id != $report->user_id) {
            return redirect('/');
        }

        return view('reports.edit', ['report' => $report, 'user' => $user]);

    }

    public function update(Request $request) { //U
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'date' => 'required',
            'game' => 'required',
            'description' => 'required',
            'report' => 'required',
            'city' => 'required',
            'tags' => 'required'
        ]);

        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->image->move(public_path('img/reports'), $imageName);

            $data['image'] = $imageName;
        }
        

        Report::findOrFail($request->id)->update($data);
        
        return redirect('/dashboard')->with('msg', 'Noticia Editada com Sucesso!');
    }

    public function destroy($id) { //D

        Report::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Noticia Deletada com Sucesso!');

    }    

    public function main($game) {

        $user = auth()->user();
    
        $reports = Report::where([
            ['game', $game]
        ])->get();

        $reports = $reports->reverse();

        return view('reports.specify', ['reports' => $reports, 'game' => $game, 'user' => $user]);
    }

    
    public function makeCommentReport($id, Request $request) {

        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->report_id = $id;

        $user = auth()->user();
        $comment->user_id = $user->id;
        $comment->user = $user->name;

        $comment->save();

        return redirect('/reports/'. $id)->with('msg', 'Comentario adicionado');
    }

    public function deleteCommentReport($id) {

        $user = auth()->user();
        $comment = Comment::findOrFail($id);

        if ($user->id == $comment->user_id) {
            $comment->delete();
        }

        return back()->with('msg', 'Comentario excluido');
    }

    public function makeEditor(Request $request) {

        $user = User::where('email', $request->email)->first();

        $user->update([
            'author' => true
        ]);

        return redirect('/dashboard')->with('msg', 'Editor adicionado');
    }
}
