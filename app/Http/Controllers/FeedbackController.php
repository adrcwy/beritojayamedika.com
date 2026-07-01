<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000'
        ]);

        // Jika nama kosong, set sebagai "Anonim"
        if (empty($validated['sender_name'])) {
            $validated['sender_name'] = 'Anonim';
        }

        Feedback::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Kritik dan saran Anda telah terkirim.'
        ]);
    }

    // Admin methods
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(10);
        $unreadCount = Feedback::where('is_read', false)->count();
        
        return view('admin.feedback.index', compact('feedbacks', 'unreadCount'));
    }

    public function markAsRead($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Feedback ditandai sebagai sudah dibaca');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->back()->with('success', 'Feedback berhasil dihapus');
    }
}