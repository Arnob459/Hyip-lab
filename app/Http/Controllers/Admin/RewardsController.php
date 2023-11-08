<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\RewardLevel;



class RewardsController extends Controller
{
    //
    public function Index(){
        $data['page_title'] = 'Manage Rewards';
        $data['rewards'] = Reward::all();


        return view('admin.reward.index',$data);
    }

    public function rewardEdit($id){
        $data['page_title'] = 'Edit Rewards';
        $data['reward'] = Reward::findOrFail($id);
        $data['levels'] = RewardLevel::where('reward_id',$id)->get();

        return view('admin.reward.edit',$data);
    }

    public function rewardUpdate(Request $request ,$id){
        $request->validate([
            'name' => 'string|max:255',
            'time_limit' => 'required|in:1,0',
            'hours' => $request->input('hours') == '1' ? 'required|integer|gt:0' : '',
            'image' => 'image|mimes:jpeg,png,jpg',

        ]);

        $reward = Reward::findorfail($id);
        $reward->name = $request->name;
        $reward->status = $request->status;

        if ($request->hasFile('image')) {
            try {
                $path = config('constants.reward.path');
                $size = config('constants.reward.size');
                $filename = upload_image($request->image, $path, $size);
            } catch (\Exception $exp) {

                return back()->with('error','Image could not be uploaded');
            }
            $reward->image = $filename;
        }

        if ($request->input('time_limit') == '1') {
            $reward->hours = $request->input('hours');

        } elseif ($request->input('time_limit') == '0') {

            $reward->hours = 0;
        }
        $reward->save();

        if ($request->has('user')) {

            $request->validate([
                'user.*' => 'required|integer|max:255',
                'business.*' => 'required|numeric|gt:0',
                'amount.*' => 'required|numeric|gt:0',

            ]);

            RewardLevel::truncate();

            for ($i=0 ; $i < count($request->user)  ; $i++ ) {

                // dd($request->user[$i]);

                RewardLevel::create([
                    'reward_id' => $id,
                    'level' => ($i + 1),
                    'paid_user' => $request->user[$i],
                    'bv' => $request->business[$i],
                    'reward' => $request->amount[$i],

                ]);

            }

        }

        return back()->with('success', " Rewards updated successfully");
    }


    public function levelList($id){
        $data['page_title'] = 'Reward levels';
        $data['levels'] = RewardLevel::where('reward_id',$id)->get();


        return view('admin.reward.level_list',$data);
    }

    public function levelEdit($id){

        $data = RewardLevel::find($id);

         return response()->json([
            'level' =>$data,
         ]);

    }

    public function levelUpdate(Request $request){

        $request->validate([
            'paid_user' => 'required|integer|max:255',
            'business_value' => 'required|numeric|gt:0',
            'reward_amount' => 'required|numeric|gt:0',

        ]);

        $id = $request->input('level_id');

        $level = RewardLevel::find($id);
        $level->paid_user = $request->input('paid_user');
        $level->bv = $request->input('business_value');
        $level->reward = $request->input('reward_amount');
        $level->save();

        return back()->with('success', " Rewards updated successfully");


    }

    public function destroy($id)
    {
        $data = RewardLevel::find($id);
        if (!$data) {
            return redirect()->back()->with('success', ' Deleted successfully');
        }
        $data->delete();
        return redirect()->back()->with('success', ' Deleted successfully');
    }

}
