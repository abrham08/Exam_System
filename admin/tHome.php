<?php
include "teacher_header.php";

    $t_id = $_SESSION['tuid'];


?>
<head>
    <style>
            .table-hover button:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    </style>
</head>
<body>
    <div id="dashboard">

    </div>
    
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="oliveToast"  class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="outertoast-body">

                </div>
            </div>
        </div>
        


</body>
<script type="text/javascript">
    $(document).ready(function() {

        var jsArray = [];
        var teacher = "<?php echo $t_id ?>";
        dashboard();


        function dddashboard() {
            $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    teacher: teacher,
                    page: 'tHome',
                    action: 'dashboard'
                },
                success: function(data) {
                    $('#dashboard').html(data);

                }
            })
        }

        function dashboard() {
        var elements = document.getElementsByClassName('active');
        for (var i = 0; i < elements.length; i++) {
        var parentElement = elements[i].closest('.nav-link');
        if (parentElement) {
            parentElement.classList.remove('active');
        }}
        var anchor = document.querySelector('a.nav-link.uexam');
        if (anchor) {
        anchor.classList.add('active');
        }
            load_exam();

        }


        function load_exam() {

            $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    teacher: teacher,
                    page: 'tHome',
                    action: 'exam'
                },
                success: function(data) {
                    $('#dashboard').html(data);

                }
            })

        }


        $(document).on('click', '#dash_b', function() {
            dashboard();
        });

        $(document).on('click', '#catag_b', function() {

            var cat_id = $(this).attr('value');
            var cat_name = $(this).data('name');
            var tdepa = $(this).data('sep');
            $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    teacher: teacher,
                    cat_id: cat_id,
                    cat_name: cat_name,
                    tdepa: tdepa,
                    page: 'tHome',
                    action: 'exam_l'
                },
                success: function(data) {
                    $('#dashboard').html(data);

                }
            })

        });

        
        $(document).on('click', '.edimainexam', function() {

            var exam_id = $(this).attr('value');
            var gtime = $(this).data('gtime');
            var stime = $(this).data('stime');
            var edate = $(this).data('edate');
            var numq = $(this).data('numq');
            var ename = $(this).data('ename');
            var etype = $(this).data('etype');
            var cname = $(this).data('cname');
            var catid = $(this).data('catid');
            var target = $(this).data('echo');
            var ecat = $(this).data('ecat');
            $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    exam_id: exam_id,
                    gtime: gtime,
                    stime: stime,
                    edate: edate,
                    numq: numq,
                    ename: ename,
                    etype: etype,
                    cname: cname,
                    catid: catid,
                    ecat: ecat,
                    page: 'tHome',
                    action: 'editexami'
                },
                success: function(data) {
                    $('#'+target).html(data);

                }
            })

            });


            $(document).on('change', '.eedate', function() {
            var date =  $(this).attr('value');
            var target = $(this).data('eid');
          $.ajax({
            url: "t_core.php",
            method: "POST",
            data: {
              date: date,
              target: target,
              page: 'tHome',
              action: 'date_ch'
            },
            success: function(data) {
                $('#outertoast-body').html(data);
                $('#oliveToast').addClass('toast-success').toast('show');
            }
          })
          });

          $(document).on('change', '.eetime', function() {
            var date =  $(this).attr('value');
            var target = $(this).data('eid');
          $.ajax({
            url: "t_core.php",
            method: "POST",
            data: {
              date: date,
              target: target,
              page: 'tHome',
              action: 'time_ch'
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })
          });

        $(document).on('click', '.addi_exam', function() {
            var new_cat_id = document.forms["new_exam"]["cat_id"].value;
            var creator = document.forms["new_exam"]["creator"].value;
            var creator_dep = document.forms["new_exam"]["creator_dep"].value;
            var ename = document.forms["new_exam"]["ename"].value;
            var gtime = document.forms["new_exam"]["gtime"].value;
            var numq = document.forms["new_exam"]["numq"].value;
            var etype = document.forms["new_exam"]["etype"].value;
            var edate = document.forms["new_exam"]["edate"].value;
            var etime = document.forms["new_exam"]["etime"].value;
            var ecat = document.forms["new_exam"]["ecat"].value;

            var pattern = /^(?=.*[1-9])\d*(\.\d+)?$/;

            if (!pattern.test(gtime) || !pattern.test(numq) || !pattern.test(edate)) {
  $('#adde_result').html('<div class="alert alert-danger">Incorrect input. The number entered must have a minimum value of 1</div>');
      return;
    }

         if(ecat == "Special" && edate > 10){
            $('#adde_result').html('<div class="alert alert-danger">The maximum value for a special exam is 10 marks.</div>');
      return;
         }

            $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    new_cat_id: new_cat_id,
                    creator: creator,
                    ename: ename,
                    creator_dep: creator_dep,
                    gtime: gtime,
                    numq: numq,
                    etype: etype,
                    edate: edate,
                    etime: etime,
                    ecat: ecat,
                    page: 'tHome',
                    action: 'addd_exami'
                },
                success: function(data) {
                    $('#adde_result').html(data);
                }
            })
        });
        
        $(document).on('click', '.delete_exam', function() {
            event.preventDefault();
            var conf = confirm('Are you sure you want to delete this Exam? ');
            var exam_id = $(this).val();
            var depa = $(this).data('dep');
            var catid = $(this).data('catid');
            var catname = $(this).data('cname');
            if (conf == true) {
                $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    exam_id: exam_id,
                    catid: catid,
                    page: 'tHome',
                    action: 'delexam'
                },
                success: function(data) {

                    views(catid,catname,depa);
                    $('#outertoast-body').html(data);
                    $('#oliveToast').addClass('toast-success').toast('show');
                }
            })
        } else {

                } 
        }); 
        $(document).on('click', '.normal_close', function() {
            var depa = $(this).data('dep');
            var catid = $(this).data('catid');
            var catname = $(this).data('catname');
        
          views(catid,catname,depa);

        }); 
        $(document).on('click', '.update_exam_close', function() {
            var depa = $(this).data('dep');
            var catid = $(this).data('catid');
            var catname = $(this).data('catname');
        
          views(catid,catname,depa);

        });   
        $(document).on('click', '.update_exam', function() {
            var new_cat_id = document.forms["up_exam"]["cat_id"].value;
            var exam_id = document.forms["up_exam"]["exam_id"].value;
            var ename = document.forms["up_exam"]["ename"].value;
            var gtime = document.forms["up_exam"]["gtime"].value;
            var numq = document.forms["up_exam"]["numq"].value;
            var etype = document.forms["up_exam"]["etype"].value;
            var edate = document.forms["up_exam"]["edate"].value;
            var etime = document.forms["up_exam"]["etime"].value;
            var ecat = document.forms["up_exam"]["ecat"].value;
            var pattern = /^(?=.*[1-9])\d*(\.\d+)?$/;

            if (!pattern.test(gtime) || !pattern.test(numq) || !pattern.test(edate)) {
  $('#adde_result').html('<div class="alert alert-danger">Incorrect input. The number entered must have a minimum value of 1</div>');
      return;
    }
            $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    new_cat_id: new_cat_id,
                    exam_id: exam_id,
                    ename: ename,
                    gtime: gtime,
                    numq: numq,
                    etype: etype,
                    edate: edate,
                    etime: etime,
                    ecat: ecat,
                    page: 'tHome',
                    action: 'update_exami'
                },
                success: function(data) {
                    $('#Update_exam_success').html(data);
                }
            })
        });



        $(document).on('click', '.depacheck', function() {

            var isChecked = $(this).prop('checked');
            var department = $(this).val();
            var yeari = $(this).data('year');
            var assiner_dep = $(this).data('assigner');
            var exam_id = $(this).data('id');
            var catid = $(this).data('catid');
            var catname = $(this).data('catname');

            $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    isChecked: isChecked,
                    department: department,
                    yeari: yeari,
                    assiner_dep: assiner_dep,
                    exam_id: exam_id,
                    page: 'tHome',
                    action: 'assignexami'
                },
                success: function(data) {
                    $('#assigne'+exam_id).html(data);



                }
            })
           // load_exam();

        });


        $(document).on('change', '.spcifigrouppp', function() {
            var department = $(this).data('vvalue');
            var assgroup = $(this).val();
            var yeari = $(this).data('year');
            var assiner_dep = $(this).data('assigner');
            var exam_id = $(this).data('id');
            var catid = $(this).data('catid');
            var catname = $(this).data('catname');
            
            $.ajax({
                url: "t_core.php",
                method: "POST",
                data: {
                    department: department,
                    assgroup: assgroup,
                    yeari: yeari,
                    assiner_dep: assiner_dep,
                    exam_id: exam_id,
                    page: 'tHome',
                    action: 'assignexamigroup'
                },
                success: function(data) {
                    $('#assigne'+exam_id).html(data);
                }
            })
            //load_exam();

        });








              function views(catid,catname,tdeps) {
                    var cat_id = catid;
                    var cat_name = catname;
                    var tdepa = tdeps;
                    $.ajax({
                    url: "t_core.php",
                    method: "POST",
                    data: {
                        teacher: teacher,
                        cat_id: cat_id,
                        cat_name: cat_name,
                        tdepa: tdepa,
                        page: 'tHome',
                        action: 'exam_l'
                    },
                    success: function(data) {
                        $('#dashboard').html(data);

                    }
                })
                }







        function ggetRadioValues() {
            var radioButtons = document.getElementsByName("departmentradio");
            var values = [];
            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    values.push(radioButtons[i].value);
                }
            }
            return values;
        }

        function getSelectedValues() {
            var selectBoxes = document.querySelectorAll("select");
            var values = [];
            for (var i = 0; i < selectBoxes.length; i++) {
                var selectedOption = selectBoxes[i].options[selectBoxes[i].selectedIndex];
                if (selectedOption.value !== '') {
                    values.push(selectedOption.value);
                }
            }
            return values;
        }











    });
</script>