<?php


class OrderBidWithdrawForm extends CFormModel
{
    /** @var OrderBids */
    public $orderBid;

    /** @var string */
    public $reason;

    public function rules()
    {
        return [
            ['reason', 'required'],
        ];
    }



}