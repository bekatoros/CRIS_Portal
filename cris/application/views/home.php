<script>
  $(document).ready(function(){
    $('.carousel').carousel();
  });
</script>


<div id="container">
    <!--<h1>Πύλη Ερευνητικής Δραστηριότητας Χαροκοπείου Πανεπιστημίου</h1>-->

    <div id="body">
        <div class="container" >
            <div class="span12" align="center">
               <!--  Carousel - consult the Twitter Bootstrap docs at
      http://twitter.github.com/bootstrap/javascript.html#carousel -->
<div id="this-carousel-id" class="carousel slide"><!-- class of slide for animation -->
  <div class="carousel-inner">
    <div class="item active"><!-- class of active since it's the first item -->
      <img style="height: 300px;"  src="http://farm8.staticflickr.com/7371/10103844924_c9087c8e31.jpg" alt="" />
      <div class="carousel-caption">
       <h4 >Πύλη Ερευνητών Χαροκοπείου Πανεπιστημίου</h3>
      </div>
    </div>
    <div class="item">
      <img style="height: 300px;"  src="<?php echo base_url(); ?>application/views/img/foithtes2.jpg" alt="" />
      <div class="carousel-caption">
        <h4 >Πύλη Ερευνητών Χαροκοπείου Πανεπιστημίου</h4>
      </div>
    </div>
    <div class="item">
      <img style="height: 300px;"  src="<?php echo base_url(); ?>application/views/img/foithtes.jpg" alt="" />
      <div class="carousel-caption">
         <h4 >Πύλη Ερευνητών Χαροκοπείου Πανεπιστημίου</h4>
      </div>
    </div>
    <div class="item">
      <img style="height: 300px;"  src="http://farm3.staticflickr.com/2818/10103710905_828c2a46c3.jpg" alt="" />
      <div class="carousel-caption">
         <h4 >Πύλη Ερευνητών Χαροκοπείου Πανεπιστημίου</h4>
      </div>
    </div>
  </div><!-- /.carousel-inner -->
  <!--  Next and Previous controls below
        href values must reference the id for this carousel -->
    <a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->
   
            </div>
            <div>
   </div>      
            
            <div class="span3"   >
         <?php 
                if ($this->crisuser->is_logged_in()) {
                 ?>     
                  
                            <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/searchrepository'; ?>">

                                        <input type="text"  id="reposearch" name="reposearch" placeholder='Αναζήτηση στο αποθετήριο'  >
                                        <button type="submit" class="btn" id="submit_button">Αναζήτηση</button>
                           
                            </form>
                           <?php }   ?>    
                
                      </div>
            <div class="span6"  >
    
                
                    
      
            <?php
          
          if (isset($message) ) {                 
                echo '<div class="alert alert-error" data-dismiss="alert">';
           
                echo $message . '<br/>';
                echo '</div>';
         }
            ?>
                <?php
                //   print_r($fulldata);
                ?>
                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Τμήμα</th>
                            <th>Εγγεγραμμένοι Ερευνητές</th>
                            <th >Καταχωρημένες Δημοσιεύσεις</th>
                            <th>Καταχωρημένα Έργα</th>

                        </tr>
                    </thead>
                    <?php
                    foreach ($fulldata as $cw) {
                        echo '<tr><td><a href="' . base_url() . 'index.php/public_c/showdep/' . $cw['id'] . '" >' . $cw['name'] . '</a></td><td>' . $cw['people'] . '</td><td>' . $cw['pub'] . '</td><td>' . $cw['projects'] . '</td></tr>';
                    }
                    ?>

                </table>

            </div>
            <div class="span3" >



            </div>
        </div>

        <hr>



    </div>

</div>

<!--    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>-->
</div>
