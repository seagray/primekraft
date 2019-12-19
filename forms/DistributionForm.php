<?php

namespace app\forms;

class DistributionForm extends FeedbackForm
{
    public $city;
    public $obj;
    public $shop;
    public $company;

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['city', 'obj', 'shop', 'company'], 'string',
            ['city', 'obj'], 'required'
        ]);
    }
}