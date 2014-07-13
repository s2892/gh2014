<?php
class State extends DataMapper{

    var $has_many = array(
        'lga'
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }



}
