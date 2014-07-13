<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>GoniVic</title>

    <!-- Bootstrap core CSS -->

    {css('bootstrap.min.css')}
    {css('dash.css')}

    <!-- Custom styles for this template -->


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <link href="//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.css"
          rel="stylesheet">
    {css('bootstrap-slider.css')}
    {css('jquery-jvectormap-1.1.1.css')}
    {css('select2-3.5.0/select2.css')}
    {css('select2-3.5.0/select2-bootstrap.css')}
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">GoniVic</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                {block name="menu"}{/block}
            </ul>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <nav id="affix-nav" class="sidebar col-md-2">
            <ul class="nav sidenav" data-spy="affix" data-offset-top="10">
                <li class="active"><a href="#cupcake">Cupcake Lorem Ipsum</a>
                    <ul class="nav">
                        <li><a href="#sweetjelly">Sweet Jelly</a></li>
                        <li><a href="#tiramisu">Tiramisu</a></li>
                        <li><a href="#pie">Pie</a></li>
                    </ul>
                </li>
                <li><a href="#veggie">Veggie Lorem Ipsum</a>
                    <ul class="nav">
                        <li><a href="#coriander">Coriander</a></li>
                        <li><a href="#kohlrabi">Kohlrabi</a></li>
                        <li><a href="#amaranth">Amaranth</a></li>
                        <li><a href="#soybean">Soybean</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="row box-body" style="padding-bottom: 1em">

                <div class="row">
                    <div class="col-lg-12 ">
                        <h4>Subject</h4>
                    </div>
                    <div class="col-lg-12 ">
                        <input id="e1" class="col-sm-12">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <h4>Year <span id="y_val" class=""></span></h4>
                    </div>
                    <div class="col-lg-12 ">
                        <input class="slider col-sm-12">
                    </div>

                </div>
            </div>
        </div>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            {block name=header}

            {/block}



            <div class="row ">
                <div class="box-body no-padding">
                    <div id="vic-map" style="height: 400px;"></div>

                </div>
            </div>





            <h2 class="sub-header">Table</h2>

            <div class="table-responsive">
                <table class="table table-striped" id="myTable">

                </table>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>

{js('bootstrap.min.js')}
<script src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.js"></script>
{js('vmap/jquery-jvectormap-1.1.1.min.js')}
{js('vmap/vic-map-2014.js')}
{js('select2.min.js')}
{js('bootstrap-slider.js')}
<script>
    var $a, $slider;
    var mapObject, oTable;
    var $myrecord, $sval;
    $(document).ready(function () {
        {block name=js}{/block}
        //console.log($category);

        $("#e1").select2({
            data: { results: $questions, text: function (item) {
                //console.log(item.name);
                return item.name;
            } },
            formatSelection: format,
            formatResult: format
        });
        function format(item) {

            return item.name;
        }

        $slider = $("input.slider").slider({
            min: 0,
            max: 5,
            value: 0,
            tooltip: "hide",
            orientation: 'vertical',
            enabled: false

        });

        $("#e1")
                .on("change", function (e) {
                    var url = "/api/question/" + e.val;
                    $.getJSON(url, function (result) {
                        //$myd = $.map(result.reco, function(element,index) {
                        //    return index
                        //});
                        //console.log(result.year.length);
                        var s_max = (result.year.length * 1.0) - 1;
                        $myrecord = result;
                        mapObject.series.regions[0].setValues(result.record[result.year[0]]);
                        $("#y_val").html(result.year[0]);
                        $("#y_h").html(result.year[0]);
                        $sval = result.year[0];
                        $("input.slider").slider('setAttribute', "min", 0);
                        $("input.slider").slider('setAttribute', "max", s_max);
                        $("input.slider").slider('setValue', 0, null);
                        $slider.slider('enable');
                        oTable.fnFilter(e.val, 1);
                    });


                    //console.log(e.val)
                })

        $("input.slider").on('slideStop', function (slideEvt) {
           // console.log(slideEvt.value);
            $sval = $myrecord.year[slideEvt.value];
            $("#y_val").html($myrecord.year[slideEvt.value]);
            $("#y_h").html($myrecord.year[slideEvt.value]);
            mapObject.series.regions[0].setValues($myrecord.record[$myrecord.year[slideEvt.value]]);
            oTable.fnFilter($sval, 0);

           // console.log($sval);
        });


        oTable = $('#myTable').dataTable({

            "processing": true,
            "bStateSave": true,
            "iDisplayLength": 10,
            "bJQueryUI": true,
            "ajax": "/api/category/"+$category.id,
            "sAjaxDataProp": "data.info",
            "aoColumns": [
                {
                    "sTitle": "year",
                    "visible": false,
                    "mData": "year" },
                {
                    "sTitle": "QID",
                    "visible": false,
                    "mData": "question_id" },

                { "sTitle": "Loc Gov",
                    "mData": "lga_name" },

                { "sTitle": "Value",
                    "mData": "data" }

            ]

        });
        $("#search-year").on('change', function (e) {
            //console.log($("#search-year option:selected").text());
            a = $("#search-year option:selected").text();
            //console.log(a);
            //oTable.fnFilter(a, 0, true, true);
            $.getJSON('/api/category2/1/2', function (result2) {
                mapObject.series.regions[0].setValues(result2);

            });

        });
        $dd = null;
        $a = $('#vic-map').vectorMap({
            map: 'vic-map-2014',
            series: {
                regions: [
                    {
                        values: null,
                        attribute: 'fill',
                        scale: [1, 10],
                        //normalizeFunction: 'polynomial',
                        //scale: ['#FEE5D9', '#A50F15'],
                        scale: ['#C8EEFF', '#0071A4']
                    }
                ]
            },
            onRegionLabelShow: function (event, label, code) {
                if ($myrecord) {

                    var d = $myrecord.record[$sval][code];
                    //console.log($myrecord.record[$myrecord.year[0]][code]);

                    label.html(
                            '' + label.html() + '\t' +
                                    'Value: ' + d
                    );
                }
            }
        });
        var mapObject = $('#vic-map').vectorMap('get', 'mapObject');

        /*
         $.getJSON('/api/category2/1/1',function(result){


         $b = $a.vectorMap({
         map: 'vic-map-2014',
         series: {
         regions: [{
         values: result,
         scale: ['#C8EEFF', '#0071A4'],
         normalizeFunction: 'polynomial'
         }]
         }
         });



         });


         */


    });


</script>
</body>
</html>