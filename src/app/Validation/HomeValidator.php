<?php 
namespace App\Validation;

class HomeValidator
{
    protected $validate;

    public function __construct($validate)
    {
        $this->validate = $validate;
    }

    public function setLang($data)
    {
        $this->validate->setRules([
            'lang' => [
                'label' => '語言'
            ]
        ]);
    }
}