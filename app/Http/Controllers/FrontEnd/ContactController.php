<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactDetail;
use App\Models\Blog;


class ContactController extends Controller
{

    public function index() {
        $data['contact'] = ContactDetail::orderby('fname')->get();
        $data['status']  = 1;
        return response()->json($data);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        
        $this->validateContact($request);
        $this->saveContact(new ContactDetail, $request);
        $data['status'] = 1;
        $data['msg']    = "data saved";
        return response()->json($data);
    }

    public function show($id) {
        $data['contactDetails'] = ContactDetail::findOrFail($id);
        return response()->json($data);
    }

    public function edit($id) {
        $data['contactDetails'] = ContactDetail::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id) {
        $this->validateContact($request);
        $this->saveContact(ContactDetail::findOrFail($id), $request);
        $data['status'] = 2;
        $data['msg']    = "data updated";
        return response()->json($data);
    }

    public function validateContact($data) {
        $data->validate([
            'fname' => 'required | max:200',
            'lname' => 'required | max:200',
            'email' => 'required | max:255 | email',
            'phone' => 'required | digits:10',
            //'image' => 'mimes:jpeg,png,jpg'
        ]);
    }

    public function saveContact($contact, $data) {
        $contact->fname = $data->fname;
        $contact->lname = $data->lname;
        $contact->email = $data->email;
        $contact->phone = $data->phone;

        if ($data->hasFile('image')) {
            $image = $data->image;
            $imageName = time().'.'.$data->image->extension();
            
            $data->image->move(public_path('images'), $imageName);
            $contact->image = 'images/'.$imageName;
        }

        $contact->save();
        return $contact;
    }

    public function destroy($id) {
        $contactDetail = ContactDetail::findOrFail($id);
        if(!empty($contactDetail)) {
            $contactDetail->delete();
            return response()->json('Data Deleted');
        } else {
            return response()->json('Data Not Found');
        }
    }

    public function sort($option) {
        switch($option) {
            case('fname'):
                $data['contact'] = ContactDetail::orderby('fname', 'asc')->get();
                break;
                
            case('lname'):
                $data['contact'] = ContactDetail::orderby('lname', 'asc')->get();
                break;
            
            case('email'):
                $data['contact'] = ContactDetail::orderby('email', 'asc')->get();
                break;
            
            case('phone'):
                $data['contact'] = ContactDetail::orderby('phone', 'asc')->get();
                break;


        }
        return response()->json($data);
    }

    public function search($option) {
        $data['contact'] = ContactDetail::where('fname', '=', '%'.$option.'%')
                                            ->orWhere('fname', 'LIKE', '%'.$option.'%')
                                            ->orWhere('email', 'LIKE', '%'.$option.'%')
                                            ->orWhere('phone', 'LIKE', '%'.$option.'%')
                                            ->get();
        return response()->json($data);
    }
}
