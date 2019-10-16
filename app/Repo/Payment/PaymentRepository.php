<?php 

namespace App\Repo\Payment;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Payment;
use App\Model\PaymentProduct;
use Auth;
use Paypalpayment;

class PaymentRepository extends BaseRepository implements PaymentInterface{


    public function __construct(){

        $this->modelName = new Payment();
    
    }

    public function index( $request ){

        $payments = $this->modelName->whereHas('user', function($query) use ($request){
            $query->where('firstname', 'like', '%' . $request->filter . '%');
            $query->orWhere('lastname', 'like', '%' . $request->filter . '%');
        })
        ->when($request->filter != '', function($q) use ($request) {
            $q->orWhere('payment_id', 'like', '%' . $request->filter . '%');
        })
        ->with(['user', 'paymentOption'])
        ->get();

        return $this->paginate($payments);

    }

    public function show($request){
        $payment = $this->where('id', $request->id)->with(['user.address.brgy','user.address.city', 'paymentOption', 'paymentProducts.product.branch.address', 'paymentProducts.product.branch'])->first();
        if($payment->payment_id != null){
            $paypal = Paypalpayment::getById($payment->payment_id, Paypalpayment::apiContext());
        
            return response()->json([
                'payment' => $payment,
                'paypalInfo' => $paypal->toArray()
            ]);
        }else{
            return response()->json([
                'payment' => $payment
            ]);
        }
        
    }

    public function store($request){
        
        $newRequest = $request->all();
        $newRequest['payment_option_id'] =$this->optimus()->encode($request->payment_option_id);
        $newRequest['user_id'] = Auth::User()->id;
        $payment = $this->create( $newRequest );
        $payment = Payment::find($payment->id);

        foreach($request->products as $product){
            PaymentProduct::create([
                    'payment_id' => $payment->id,
                    'product_id' => $product['product']['id'],
                    'quantity' => $product['qty'],
                    'price' => $product['product']['price']
                ]);
        }
        
    }


}