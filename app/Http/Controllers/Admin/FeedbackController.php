<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('admin.feedbacks.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image',
            'active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/feedbacks'), $filename);
            $data['image'] = 'uploads/feedbacks/' . $filename;
        }

        Feedback::create($data);

        return redirect()->route('feedbacks.index')->with('success', 'Thêm cảm nghĩ thành công.');
    }

    public function edit(Feedback $feedback)
    {
        return view('admin.feedbacks.form', compact('feedback'));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/feedbacks'), $filename);
            $data['image'] = 'uploads/feedbacks/' . $filename;
        }

        $feedback->update($data);

        return redirect()->route('feedbacks.index')->with('success', 'Cập nhật cảm nghĩ thành công.');
    }


    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedbacks.index')->with('success', 'Xóa cảm nghĩ thành công.');
    }
}
