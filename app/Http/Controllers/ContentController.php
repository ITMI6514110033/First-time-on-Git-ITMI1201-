<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentRequest;
use App\Models\Content;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::paginate(5);
        return view('content.index', compact('contents'));
    }

    public function create()
    {
        $contents = new Content;
        return view('content.form', compact('contents'));
    }

    public function store(ContentRequest $request)
    {
        $content = new Content;

        $this->save($content, $request);
        return redirect('/content');
    }

    public function edit($id)
    {
        $contents = Content::findOrFail($id);
        return view('content.form', compact('contents'));
    }

    private function save($data, $value)
    {
        $data->topic = $value->topic;
        $data->description = $value->description;
        $data->tags = $value->tags;
        $data->links = $value->links;
        //$data->status = true;
        $data->user_id = 1;
        $data->save();
    }

    public function update(ContentRequest $request, $id)
    {
        $content = Content::findOrFail($id);

        $this->save($content, $request);
        return redirect('/content');
    }

    public function destroy($id)
    {
        /*Content::destroy($id);
        $this->index();*/
        $content = Content::findOrFail($id);
        if ($content->status) {
            $content->status = false;
        } else {
            $content->status = true;
        }
        $content->save();

    }

}
