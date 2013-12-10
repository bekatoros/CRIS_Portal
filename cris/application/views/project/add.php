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
            <h4> Προσθήκη χρηματοδότησης</h4>

    </table>
</div>

<!-- Example row of columns -->
<div class="row-fluid">
    <div class="span3"   >
    </div>
    <div class="span6"  >


        <form method="post" class="form-horizontal" action="<?php echo base_url() ?>index.php/project/submit">
            <div class="control-group">
                <label class="control-label" for="fName_en">Τίτλος (Αγγλικά)</label>
                <div class="controls">
                    <input type="text" id="fName_en" placeholder="Τίτλος (Αγγλικά)" name="fName_en" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="fName_el">Τίτλος (Ελληνικά)</label>
                <div class="controls">
                    <input type="text" id="fName_el" placeholder="Τίτλος (Ελληνικά)" name="fName_el">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="projcode">Κωδ. Έργου</label>
                <div class="controls">
                    <input type="number" id="projcode" placeholder="Κωδ. Έργου" name="projcode" >
                </div>
            </div>                
            <div class="control-group">
                <label class="control-label editable-input" for="fName_en_fund" id="lbl_fName_en">Πηγή Χρηματοδότησης Αγγλικά</label>
                <div class="controls">
                    <input type="text" id="fName_en_fund" placeholder="Τίτλος (Αγγλικά)" name="fName_en_fund">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="fName_el_fund" id="lbl_fName_el">Πηγή χρηματοδότησης Ελληνικά</label>
                <div class="controls">
                    <input type="text" id="fName_el_fund" placeholder="Τίτλος (Ελληνικά)" name="fName_el_fund">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="fAmount" id="lbl_fAmount">Ποσό Χρηματοδότησης</label>
                <div class="controls">
                    <input type="number" id="fAmount" placeholder="" name="fAmount">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="startDate">Ημερομηνία Έναρξης</label>
                <div class="controls">
                    <input type="text" id="startDate"name="startDate"data-date-format="dd-mm-yyyy" >
                </div>
            </div>                
            <div class="control-group">
                <label class="control-label" for="endDate">Ημερομηνία Ολοκλήρωσης</label>
                <div class="controls">
                    <input type="text" id="endDate" name="endDate" data-date-format="dd-mm-yyyy">
                </div>
            </div>



            <div class="control-group">
                <label class="control-label" for="orgunit">Τμήμα</label>
                <div class="controls">

                    <select name="orgunit" class =""  id="orgunit">
                        <?php
                        foreach ($orgunits as $unit) {
                            echo "<option value =" . $unit['id'] . ">";
                            echo $unit['name'];
                        }
                        ?>

                    </select> 
                </div>
            </div>



            <div class="control-group">
                <div class="controls">                        
                    <button type="submit" class="btn">Προσθήκη</button>
                </div>
            </div>
        </form>
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
