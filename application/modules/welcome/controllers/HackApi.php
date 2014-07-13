<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
class HackApi extends REST_Controller {
    function __construct(){
        parent::__construct();


    }
    function category_year_get($id_cat=null){
        if(!isset($id_cat)) exit();
        $ct = new Category_type($id_cat);
        $data = new stdClass();
        $data->category = $ct->to_array();
        $q = new Question();
        $q->where('category_type_id', $id_cat)->get();
        $data->questions = $q->all_to_array();
        $inf = new Information();
        $inf->where_related('question/category_type', 'id', $id_cat)->include_related('lga')
        ->include_related('question')
            ->get();

        $finf = $inf->fields;
        array_push($finf,"lga_name");
        array_push($finf,"question_name");
        $data->info = $inf->all_to_array($finf);

        $this->response(array("data"=>$data),200);
    }
    function category_year2_get($id_cat=null, $id_q){
        $inf = new Information();
        $inf->where('year = ', '2011-01-01')->where_related('question/category_type', 'id', $id_cat)
            ->where_related('question', 'id',$id_q)
            ->get();

        $mydata= array();
        foreach($inf as $a){
            //print_r($a->lga_id);
            $mydata[$a->lga_id] = $a->data;
        }
        $this->response($mydata,200);
    }
    function date2_get(){
        $info = new Information();
        $info->where('id >', 0)->update('year', NULL);
    }
    function date3_get(){
    $info = new Information();
    $info->where('id >', 0)->update('year', 2011);
}
    function question_info_get($qid){
        $info = new Information();

        $info->where('question_id', $qid)->get();
        foreach($info as $i){
            $record[$i->year][$i->lga_id]=$i->data;
        }

        $y = array();
        foreach($record as $k=>$v){
            array_push($y,$k);
        }
        $this->response(array("record"=>$record, "year"=>$y),200);
    }
}