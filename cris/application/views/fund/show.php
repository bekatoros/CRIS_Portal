<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    $(function() {
        $("#startDate").datepicker({dateFormat: "dd-mm-yy"});
        $("#startDate").keypress(function(event) {
            event.preventDefault();
        });
        $("#endDate").datepicker({dateFormat: "dd-mm-yy"});
        $("#endDate").keypress(function(event) {
            event.preventDefault();
        });

    });
</script>
<div class="container">

    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" align="center">
        <table align="center">
            <h4 >Εμφάνιση Χρηματοδοτήσης</h3>

        </table>
    </div>

    <!-- Example row of columns -->
    <div class="row-fluid">
        <div class="span3"   >
        </div>
        <div class="span6"  >

            <?php
            $owner = false;
            $fid = $this->uri->segment(3);
            $uneditclass = 'class = "input-xlarge uneditable-input" disabled ';
//@todo prepei na ginei edit form opws kai sto profile an o xrhsths einai idiokthths
            foreach ($fund as $cw) {



                if (!empty($member)) {
                    //  print_r($member);
                    $owner = TRUE;
                    $uneditclass = ' class = "input-xlarge"';
                } else {
                    //      echo   'den eisai melos';
                }
                ?>


                <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/fund/update/' . $fid; ?>">
                    <div class="control-group">

                        <label class="control-label" for="fName_en" id="lbl_fName_en">Τίτλος (Αγγλικά)</label>
                        <div class="controls">
                            <input  <?php echo $uneditclass; ?>  type="text" id="fName_en" name="fName_en" value=  <?php echo $cw['cfName'] ?> >
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label" for="fName_el" id="lbl_fName_el">Όνομα στα Ελληνικά</label>
                        <div class="controls">
                            <input <?php echo $uneditclass; ?>  type="text" id="fName_el" name="fName_el"  value=  <?php echo $cw['cuName_el'] ?>>
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label" for="fAmount" id="lbl_fAmount">Ποσό</label>
                        <div class="controls">
                            <input <?php echo $uneditclass; ?>  type="text" id="fAmount" name="fAmount"   value= <?php echo $cw['cfAmount'] ?> >

                        </div>  
                    </div>

                    <div class="control-group">

                        <label class="control-label" for="startDate">Ημερομηνία Έναρξης</label>
                        <div class="controls">
                            <input <?php echo $uneditclass; ?>  type="text" id="startDate" name="startDate" data-date-format="dd-mm-yyyy" value=  <?php echo convert_str_to_date_for_date_picker($cw['cfStartDate']) ?>>
                        </div>
                    </div>
                    <div class="control-group">                    
                        <label class="control-label" for="endDate">Ημερομηνία Ολοκλήρωσης</label>
                        <div class="controls">
                            <input <?php echo $uneditclass; ?>  type="text" id="endDate" name="endDate" data-date-format="dd-mm-yyyy" value=  <?php echo convert_str_to_date_for_date_picker($cw['cfEndDate']) ?>>
                        </div>
                    </div>

                    <?php
                    if ($owner) {
                        ?>              <div class="control-group">
                            <div class="controls">            
                                <button type="submit" class="btn" id="submit_button">Υποβολή Αλλαγών</button>
                            </div>
                        </div>
                        <?php
                        if (isset($message) && !empty($message)) {

                            echo '<div class="alert alert-success">';
                            echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                            echo $message . '<br/>';
                            echo '</div>';
                        }
                        ?>
                    <?php } ?>                  
                </form>
            <?php }
            ?>

        </div>
        <div class="span3" >

        </div>
    </div>

    <hr>



</div> <!-- /container -->

<script>

//Date picker settings for calendar

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#startDate').datepicker({
        onRender: function(date) {
            return date.valueOf();
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();
        $('#endDate')[0].focus();
    }).data('datepicker');

    var checkout = $('#endDate').datepicker({
        onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');


//validation rules

    $('#fName_el').focus(function() {
        $('#fName_el').css('background-color', 'inherit');
        $('#lbl_fname_el').text('Όνομα');
        $('#lbl_fname_el').css('color', 'inherit');
    });

    $('#submit_button').click(function() {

        var fname_en = $('#fName_en').val();
        var fname_el = $('#fName_el').val();
        var famount = $('#fAmount').val();



        if (!fname_el || fname_el === '' || fname_el.length < 1) {
            $('#lbl_fName_el').css('color', 'red');
            $('#lbl_fName_el').text('Παρακαλώ εισάγετε το όνομα της χρηματοδότησης στα ελληνικά');
            $('#fname_el').css('background-color', '#FFC3C4');
            return false;
        }


        if (!fname_en || fname_en === '' || fname_en.length < 1) {
            $('#lbl_fName_en').css('color', 'red');
            $('#lbl_fName_en').text('Παρακαλώ εισάγετε το όνομα της χρηματοδότησης στα αγγλικά');
            $('#fname_en').css('background-color', '#FFC3C4');
            return false;
        }


    });



    $(document).ready(function() {
        $("#fAmount").keydown(function(event) {
            // Allow: backspace, delete, tab, escape, and enter
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 190 | event.keyCode == 188 ||
                    // Allow: Ctrl+A
                            (event.keyCode == 65 && event.ctrlKey === true) ||
                            // Allow: home, end, left, right
                                    (event.keyCode >= 35 && event.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    else {
                        // Ensure that it is a number and stop the keypress
                        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                            event.preventDefault();
                        }
                    }
                });
    });
</script>
