<?php
class Question extends DataMapper{

    var $has_one = array(
        'category_type'
    );
    var $has_many = array(
        'information'
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }



}
