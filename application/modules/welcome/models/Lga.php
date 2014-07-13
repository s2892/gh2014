<?php
class Lga extends DataMapper{

    var $has_one = array(
        'state'
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }



}
