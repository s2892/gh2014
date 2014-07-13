<?php
class Information extends DataMapper{

    var $has_one = array(
        'question',
        'lga'
    );


    function __construct($id = NULL)
    {
        parent::__construct($id);
    }



}
