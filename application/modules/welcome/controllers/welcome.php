<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MX_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index($id = 1)
    {
        /* $i = new Information();
         $i->where('year =','2011-01-01')->where_related('question/category_type','id',1)->include_related('question')

             ->get();
        */
        $cat = new Category_type();
        $cat->get();
        $c= new Category_type($id);
        $q = new Question();
        $data['cat']= $cat;
        $q->where_related('category_type', 'id', $id)->get();
        $data['question'] = $q->all_to_array();
        $data['category']= array('id'=>$id, "name"=>$c->name);
        $this->parser->parse("ghack", $data);

    }



    public function down($idc = null, $y = null)
    {
        $inf = new Information();
        $inf->where('year', $y)->get();;
        print_r($inf->delete());
    }

    public function upload_my($idc = null, $y = null)
    {
        if (!isset($idc)) exit();
        if (!isset($y)) exit();
        $string = file_get_contents("import/$idc$y.json");
        $json_a = json_decode($string, true);



        foreach ($json_a as $o) {
            if ($o['LGA Code'] == '') {
            } else {


                foreach ($o as $k => $v) {
                    if ($k != 'LGA Code' && $k != 'Local Government Area') {
                        //$q = hQuest::where('name','like', $k)->get();
                        $q = new Question();
                        $q->where("name like", $k)->get(1);
                        // $am = $q->count();

                        if (!$q->exists()) {
                            $l_new = new Question();;
                            $l_new->category_type_id = $idc;
                            $l_new->type = 'value';
                            $l_new->name = $k;
                            $s = $l_new->save();
                            $qid = $l_new->id;

                        }
                        $qid = $q->id;

                        if (!empty($o['LGA Code'])) {
                            $l = new Lga($o['LGA Code']);
                            if(!$l->exists()){
                                $lg = new Lga();
                                $lg->id = $o['LGA Code'];
                                $lg->state = 2;
                                $lg->name = $o['Local Government Area'];
                                $lg->save();
                            }
                            $inf = new Information();
                            $inf->where("year", $y)->where('question_id', $qid)->where('lga_id', $o['LGA Code'])->get(1);
                            //$iq = $inf->count();
                            //print_r($inf->exists());
                            if (!$inf->exists()) {
                                $l_new = new Information();
                                $l_new->lga_id = $o['LGA Code'];
                                $l_new->question_id = $qid;
                                $l_new->data = $v;
                                $l_new->year = $y;
                                $s = $l_new->save();

                            }
                            else{
                                $inf->data = $v;
                                $s = $inf->save();
                            }
                        }


                    }


                }
            }

        }
    }

    function add()
    {
        if (!$this->session->userdata('user_type')) {
            $this->session->set_flashdata('redirect', current_url());
            redirect('login', 'refresh');
        }

        $this->parser->parse("smartytest");


    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
