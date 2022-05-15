<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Deal;
use App\Models\PrimarySeller;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    protected function filter($query, $request)
    {
        if ($request ->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request ->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if(isset($request->sort)) {
            $sort = explode(' ', $request->sort);
            $query->orderBy($sort[0], $sort[1])->get();
        } else {
            $query->orderBy('created_at', 'DESC')->get();
        }

        return $query->orderBy('created_at', 'DESC')->get();
    }

    public function sells(Request $request)
    {
        $sells = $this->filter(Application::query()->where('type', 1), $request);

        return view('auth.sells', compact('sells'));
    }

    public function buys(Request $request)
    {
        $buys = $this->filter(Application::query()->where('type', 0), $request);
        return view('auth.buys', compact('buys'));
    }

    public function obligations(Request $request)
    {
        $deals = $this->filter(Deal::query(), $request);
        return view('auth.obligations', compact('deals'));
    }

    public function profile()
    {
        $expirate = DB::table('expiration')->get()->first()->is_expirate;

        $user_id = Auth::user()->id;

        $results = Result::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $results_total = 0;
        foreach($results as $result) {
            $results_total += $result->result;
        }

        if ($expirate === 0) {
            $sells = Deal::where('seller_id', $user_id)->orderBy('created_at', 'DESC')->get();
            $buys = Deal::where('buyer_id', $user_id)->orderBy('created_at', 'DESC')->get();
            return view('auth.profile', compact('results', 'sells', 'buys', 'expirate', 'results_total'));
        } else {
            $deals = Deal::where('seller_id', $user_id)->orWhere('buyer_id', $user_id)->orderBy('created_at', 'DESC')->get();

            return view('auth.profile', compact('results', 'deals', 'results_total'));
        }
    }

    public function addApplicationSell()
    {
        return view('auth.add-appl-sell');
    }
    public function addApplicationBuy()
    {
        return view('auth.add-appl-buy');
    }

    public function confirmApplication(Request $request)
    {
        $params = $request->all();
        $params['user_id'] = Auth::user()->id;
        $params['type'] = (int)$params['type'];
        Application::create($params);

        session()->flash('result', 'Заявка была успешно добавлена!');

        if ($params['type'] === 1) {
            return redirect()->route('sells');
        } else {
            return redirect()->route('buys');
        }
    }

    public function deal(Request $request)
    {
        $params = $request->all();
        $row_id = $params['row_id'];
        unset($params['row_id']);
        $application = Application::where('id', $row_id)->first();

        if ($application->type === 1) {
            $primary_seller = PrimarySeller::where('application_id', $application->id)->first();
            if (!is_null($primary_seller)) {
                $params['seller_id'] = $primary_seller->seller_id;
                $deal = Deal::where('id', $primary_seller->deal_id)->first();
                $total = $params['count']*$application->price - $application->count*$deal->price;
                $result = Result::where('user_id', $application->user_id)->first();
                if ($deal->count > $params['count']) {
                    $deal->count -= $params['count'];
                    $deal->update();
                } else {
                    $deal->delete();
                }
                Result::create(['user_id' => $application->user_id, 'result' => $total]);
            } else {
                $params['seller_id'] = $application->user_id;
            }
            $params['buyer_id'] = Auth::user()->id;
        } else {
            $params['buyer_id'] = $application->user_id;
            $params['seller_id'] = Auth::user()->id;
        }

        $params['price'] = $application->price;

        if ($application->count > $params['count']) {
            $application->count -= $params['count'];
            $application->update();
        } else {
            $application->delete();
        }

        Deal::create($params);
        return redirect()->back();
    }

    public function resell(Request $request)
    {
        $params = $request->all();
        $row_id = $params['row_id'];
        unset($params['row_id']);
        $deal = Deal::where('id', $row_id)->first();
        $params['user_id'] = $deal->buyer_id;
        $params['type'] = 1;
        $application = Application::create($params);
        PrimarySeller::create(['application_id' => $application->id, 'seller_id' => $deal->seller_id, 'deal_id' => $deal->id]);

        return redirect()->back();
    }
}
