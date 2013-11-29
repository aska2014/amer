<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;
use Special\SpecialPayment;

class FreakPaymentController extends FreakController {

    /**
     * @var SpecialPayment
     */
    protected $payments;

    /**
     * @var SpecialPayment $payments
     */
    public function __construct( SpecialPayment $payments )
    {
        $this->payments = $payments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $payments = $this->payments->all();

        return View::make('panel::payments.data', compact('payments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $payment = $this->payments->find( $id );

        $this->setPackagesData($payment);

        return View::make('panel::payments.detail', compact('payment', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $payment = $this->payments;

        $this->setPackagesData($payment);

        return View::make('panel::payments.add', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $payment = $this->payments->find( $id );

        $this->setPackagesData($payment);

        return View::make('panel::payments.add', compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $payment = $this->payments->findOrNew(Input::get('insert_id'))->fill($this->getInputs());

        $payment->save();

        $this->setModel($payment);

        return $this->jsonModelSuccess();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id)
    {
        $payment = $this->payments->find($id);

        $payment->fill($this->getInputs());

        try{

            return $this->jsonValidateResponse($payment);

        }catch(Exception $e){
            dd(Input::get('SpecialPayment'), $id, $e->getMessage());
        }
    }

    /**
     * @return array
     */
    protected function getInputs()
    {
        return Input::get('SpecialPayment');
    }

    /**
     * @param $paymentId
     */
    public function getAccept($paymentId)
    {
        $payment = $this->payments->findOrFail($paymentId);

        $payment->received = true;

        return Redirect::to(freakUri('element/estate/make-special/'.$payment->estate->id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRefuse($id)
    {
        $this->payments->find($id)->delete();

        return Redirect::to(freakUrl('element/payment'))->with('success', 'Payment rejected and deleted successfully.');
    }
}