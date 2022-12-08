<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalDetail;
use App\Models\City;
use App\Models\Option;
use App\Models\State;


class PersonalDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['personalDetails'] = PersonalDetail::orderBy('id', 'desc')->get();
        return view('personalDetail.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['states'] = State::orderBy('state')->get();
        return view('personalDetail.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->saveDetails(new PersonalDetail, $request);
        $this->validateDetails($request);
        return redirect()->route('personal-detail.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $data['detail'] = PersonalDetail::findOrFail($id);
        $data['options'] = $data['detail']->getOptions;
        $data['select'] = array(1,2,3,4,5,6,7,8);
        return view('personalDetail.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id) {
        $this->saveDetails(PersonalDetail::findOrFail($id), $request);
        $this->validateDetails($request);
        return redirect()->route('personal-detail.index');
    }

    public function validateDetails($data) {
        $data->validate([
            'fname'=>'required'
        ]);
    }

    public function saveDetails($details, $data) {
        
        $details->fname = $data->fname;
        $details->email = $data->email;
        $details->radio = $data->optradio;
        $details->select = $data->sel1;
        $details->date = $data->date;
        $details->save();
        
        //delete previous entries and enter new one
        if($data->isMethod('put')) {
            if(!empty($data->options)) {
                $delOption = Option::where('personal_detail_id', '=' ,$details->id);
                $delOption->delete();
            }
        }
            
        if(!empty($data->options)) {
            foreach($data->options as $value) {
                $optionValue = new Option;
                $optionValue->personal_detail_id = $details->id;
                $optionValue->option = $value;
                $optionValue->save();
            }
        }

        return $details;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $personalDetail = PersonalDetail::findOrFail($id);
        $personalDetail->delete();
        return redirect()->route('personal-detail.index');
    }

    public function getCity(Request $request) {
        $data['city'] = City::where('state_id', '=', $request->state_id)->get();
        return response()->json($data);
    }
}
