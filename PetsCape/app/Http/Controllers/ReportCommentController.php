<?php

namespace App\Http\Controllers;

use App\Models\AnimalReport;
use App\Models\ReportComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportCommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, AnimalReport $report)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        
        $comment = new ReportComment();
        $comment->report_id = $report->id;
        $comment->user_id = Auth::id();
        $comment->content = $validated['content'];
        $comment->save();
        
        return redirect()->route('reports.show', $report)
            ->with('success', 'Commentaire ajouté avec succès');
    }
}
