<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailsOder;
use App\Models\Oder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    //
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('paypal.test');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $total = Session::get('total_paypal');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('dathang')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->back('dathang')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $id_user = Auth::user()->id_user;
        $user = User::all()->where('id_user', $id_user)->first();
        $response = $provider->capturePaymentOrder($request['token']);
        if (is_null($user->address) or is_null($user->phone)) {
            return redirect()->back()->with('error', 'Pleas submit form infomation user to complete oders');
        } else {
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $total = Session::get('total_paypal');
                $cart = DB::table('carts')->join('shoes', 'carts.id_shoes', '=', 'shoes.id_shoes')
                    ->where('id_users', $id_user)->get();
                $oder = Oder::create([
                    'id_user' => $id_user,
                    'sub_total' => $total * 23000,
                    'status' => 0,
                    'condition' => 0
                ]);
                foreach ($cart as $item) {
                    $details = DetailsOder::create([
                        'id_shoes' => $item->id_shoes,
                        'id_oder' => $oder->id_oders,
                        'color' => $item->color,
                        'size' => $item->size,
                        'quantity' => $item->quantity,
                        'id_payment' => 5,
                        'id_delivery' => 5
                    ]);
                    Cart::destroy($item->id_carts);
                }
                return redirect()
                    ->route('giohang')
                    ->with('success', 'Successful Paypal payment | Oder is completed | Continue Shopping');
            } else {
                return redirect()
                    ->route('dathang')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }

    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('dathang')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
