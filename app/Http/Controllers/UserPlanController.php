<?php

namespace App\Http\Controllers;

use App\Models\Invest;
use App\Models\Plan;
use App\Models\Reward;
use App\Models\RewardLevel;
use App\Models\SettingExtra;
use App\Models\Trx;
use App\Models\User;
use App\Models\UserReward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class UserPlanController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Investment Plan";
        $data['plans'] = Plan::where('status', 1)->get();
        return view('users.invest.plans', $data);
    }

    public function invest(Request $request, $id)
    {
        $this->validate($request, [
            'wallet' => 'required|integer|min:0|max:1',
            'amount' => 'required|numeric|min:0',
        ]);
        $plan = Plan::where('id', $id)->where('status', 1)->firstOrFail();
        if ($plan->fixed_amount == 0) {
            if ($request->amount < $plan->minimum_amount || $request->amount > $plan->maximum_amount) {
                return back()->with('error','Please Follow the investment Limit');
            } else {
                $amount = $request->amount;

            }
        } else {
            $amount = $plan->fixed_amount;
        }

        $user = auth()->user();
        if ($request->wallet == 0) {
            if ($user->balance < $amount) {
                return back()->with('error', 'Insufficient balance, please deposit first');
            }

            $user->balance -= $amount;
            $user->save();

            $balance = $user->balance;
            $type = 1;
        } else {
            if ($user->interest_balance < $amount) {
                return back()->with('error','Insufficient balance in your interest wallet');
            }
            $user->interest_balance -= $amount;
            $user->save();
            $balance =  $user->interest_balance;
            $type = 2;
        }


        if ($plan->times == "Hourly")

            $time = 1;
        elseif ($plan->times == "Daily") {
            $time = 24;
        } elseif ($plan->times == "Weekly") {
            $time = 168;
        } elseif ($plan->times == "Monthly") {
            $time = 720;
        } elseif ($plan->times == "Yearly") {
            $time = 8760;
        }

        if ($plan->interest_status == 0) {
            $interest = $plan->interest;
        } else {
            $interest = ($amount * $plan->interest) / 100;
        }

        if ($plan->capital_back == 1)
            $cp = 1;
        else {
            $cp = 0;
        }

        if ($plan->lifetime == 1)
        {
            $period = -1;
        }else{
            $period = $plan->repeat_time;
        }


        $old_plan = auth()->user()->plan_id;

        $user = auth()->user();

        $rew = Reward::first();



        if ($old_plan == 0 && $rew)
        {
            $user->plan_id = $plan->id;
            if ($rew->hours == 0)
            {
                $user->reward_type = 0;
            }else{
                $user->reward_end_time = Carbon::now()->addHours($rew->hours);
            }


            $re_levels = RewardLevel::get();

            foreach ($re_levels as $level)
            {
                $user_reward = new UserReward;

                $user_reward->user_id = auth()->id();
                $user_reward->level = $level->level;
                $user_reward->bv = $level->bv;
                $user_reward->bv = $level->bv;
                $user_reward->paid_user = $level->paid_user;
                $user_reward->reward = $level->reward;
                $user_reward->save();

            }






    }



        $user->total_invest += $amount;
        $user->save();

        $invest = new Invest();
        $invest->user_id = $user->id;
        $invest->plan_id = $plan->id;
        $invest->amount = $amount;
        $invest->interest = $interest;
        $invest->hours = $time;
        $invest->time_name = $plan->times;
        $invest->time_name = $plan->times;
        $invest->capital_status = $cp;
        $invest->period = $period;
        $invest->next_time = Carbon::now()->addHours($time);
        $invest->status = 1;
        $invest->save();

        $trx = new Trx();
        $trx->user_id = auth()->id();
        $trx->amount = $amount;
        $trx->amount = $amount;
        $trx->trx_type = '-';
        $trx->details = 'Investment plan ' . $plan->plan_name;
        $trx->remark = 'invest';
        $trx->post_balance = $balance;
        $trx->type = $type;
        $trx->trx = getTrx();
        $trx->save();
        $gnl_extra = SettingExtra::first();
        if ($gnl_extra->give_com_when_invest == 1) {
            // levelCommission($user->id, $amount);
        }
        return back()->with('success','Invest Successfully');
    }


    public function invest_history()
    {
        $data['page_title'] = "Interest Log";
        $data['logs'] = Invest::where('user_id', auth()->id())->latest()->paginate(5);
        return view('users.invest.history', $data);

    }
    public function investSingle($slug , $id)
    {
        $data['page_title'] = "Interest Log";
        $data['log'] = Invest::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        return view('users.invest.single', $data);
    }

    public function investReturn()
    {
        $page_title = 'Investment return history';
        $logs = auth()->user()->transactions()->orderBy('id', 'desc')->where('remark', 'interest')->paginate(config('constants.table.default'));
        return view('users.transactions', compact('page_title', 'logs'));
    }

}
