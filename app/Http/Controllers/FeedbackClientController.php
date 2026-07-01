<?php

namespace App\Http\Controllers;

use App\Models\FeedbackClient;
use Illuminate\Http\Request;

class FeedbackClientController extends Controller
{
    public function index()
    {
        $feedbacks = FeedbackClient::latest()->get();
        return view('admin/feedbackclient.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('admin/feedbackclient.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'client_company' => 'required|string|max:255',
        'client_photo' => 'nullable|string|max:500',
        'feedback' => 'required|string|max:65535',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    FeedbackClient::create($validated);

    return redirect()->route('feedbackclient.index')->with('success', 'Feedback added successfully!');
}


    public function edit(FeedbackClient $feedbackclient)
    {
        return view('admin/feedbackclient.edit', compact('feedbackclient'));
    }

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'client_company' => 'required|string|max:255',
        'client_photo' => 'nullable|string|max:500',
        'feedback' => 'required|string|max:65535',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $feedback = FeedbackClient::findOrFail($id);
    $feedback->update($validated);

    return redirect()->route('feedbackclient.index')->with('success', 'Feedback updated successfully!');
}


    public function destroy(FeedbackClient $feedbackclient)
    {
        $feedbackclient->delete();

        return redirect()->route('feedbackclient.index')
            ->with('success', 'Client feedback deleted successfully!');
    }
}
