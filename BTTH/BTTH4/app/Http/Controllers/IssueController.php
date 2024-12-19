<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{

    public function index()
    {
        $issues = Issue::with('computer')->paginate(10);
        return view('issues.index', compact('issues'));
    }


    public function create()
    {
        $computers = Computer::all();
        return view('issues.create', compact('computers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'required|max:50',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required'
        ], 
        [
            'reported_by.max' => 'Tên người báo cáo không được vượt quá 50 ký tự.',
        ]);

        Issue::create($request->all());

        return redirect()->route('issues.index')->with('success', 'Lỗi mới đã được thêm thành công!');
    }

    public function show(Issue $issue)
    {
        //
    }

  
    public function edit(Issue $issue, $id)
    {
        $issue = Issue::findOrFail($id);
        $computers = Computer::all();
        return view('issues.edit', compact('issue', 'computers'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'required|max:50',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required'
        ]);

        $issue = Issue::find($id);

        $issue->update($request->all());

        return redirect()->route('issues.index')->with('success', 'Lỗi được cập nhật thành công!');
    }

    
    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();

        return redirect()->route('issues.index')->with('success', 'Lỗi được xóa thành công!');
    }
}
