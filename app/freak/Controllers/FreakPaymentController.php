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
     * @var Estate
     */
    protected $estates;

    /**
     * @var SpecialPayment $payments
     * @param \Estate\Estate $estates
     */
    public function __construct( SpecialPayment $payments, \Estate\Estate $estates )
    {
        $this->payments = $payments;
        $this->estates  = $estates;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $payments = $this->payments->all();

        return View::make('panel::payments.table', compact('payments'));
    }

    /**
     * @param $id
     * @return \Response
     */
    public function getShowByEstate($id)
    {
        $estate = $this->estates->findOrFail($id);

        $payments = $estate->specialPayments;

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        return $this->getShow($id);
    }

    /**
     * @param $paymentId
     */
    public function getAccept($paymentId)
    {
        $payment = $this->payments->findOrFail($paymentId);

        $payment->received = true;

        return Redirect::to(freakUrl('element/estate/make-special/'.$payment->estate->id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getReject($id)
    {
        $this->payments->find($id)->delete();

        return Redirect::to(freakUrl('element/payment'))->with('success', 'Payment rejected and deleted successfully.');
    }
}