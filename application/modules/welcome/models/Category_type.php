<?php
class Category_type extends DataMapper{

    var $has_many = array(
        'question'
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }



}
