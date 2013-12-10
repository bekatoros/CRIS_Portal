
<?php 
include ('application/views/headers/header_preamble.php');

?>

    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

        <div class="navbar 
            <?php if ($this->session->userdata('cris') === '1') { 
           echo   "navbar-inverse" ;   
             }else
             {
         //  echo   "navbar-inverse" ;   
                 
             }
                         ?>
             navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                      <?php if ($this->session->userdata('cris') === '1') { ?>
                    <a class="brand" href="<?php echo base_url();?>">  <i class="icon-xing" >Πύλη Ερευνητών</i></a>
                       <?php }
                            ?>
                       <?php if ($this->session->userdata('cris') === '0') { ?>
                   <a class="brand" href="<?php echo base_url();?>">  <i class="icon-xing" > Εφαρμογή Δημοσιεύσεων                   </i>
</a>
                   
                       <?php }
                            ?>
                    <div class="nav-collapse collapse ">
                        <ul class="nav">
                          

                            <?php if ($this->session->userdata('cris') === '1') { ?>


                            <!--    <li><a href="<?php echo base_url() ?>index.php/dytrty/rty">Χρηματοδότηση</a></li>
                               
                                <li><a href="#">Έργα</a></li>
                                -->
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-building"></i> Τμήματα <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                     <li><a href="<?php echo base_url() ?>index.php"><i class="icon-list-ul"></i> Εμφάνιση</a></li>
                                      <li class="divider"></li>
                                      <li class="nav-header"> τμηματα</li>
                                         <?php
                                       
             
                                         foreach ($orgunits as $cw) {
                           echo '<li ><a href="'.base_url() . 'index.php/public_c/showdep/'.$cw['id'].'" >'.$cw['name']. '</a></li>';
          
                            }
                         ?>
                                    
                                    
                                </ul>
                            </li>
                                <li class="dropdown">
                                    <a  class=" dropdown-toggle" data-toggle="dropdown"><i class="icon-bar-chart"></i> Έργα <b class="caret"></b></a>
                                    <ul class="dropdown-menu ">
                                        <li><a href="<?php echo base_url() ?>index.php/project/index"><i class="icon-list-ul"></i> Εμφάνιση</a></li>
                                        <li><a href="<?php echo base_url() ?>index.php/project/add"><i class="icon-plus-sign"></i>Προσθήκη</a></li>    
                                         <li class="divider"></li>
                                         <li class="nav-header">  Τα εργα μου</li>
                                         <!--<li><a href="<?php echo base_url() ?>index.php/project/add">Έργο 1</a></li>--> 
                                         
                                         <?php 
                                 //        $counter=0;
                                         foreach ($userproj as $cw) {
                           echo '<li ><a href="'.base_url() . 'index.php/project/show/'.$cw['cfProjId'].'" >'.$cw['cfTitle']. '</a></li>';
//                      if( ($counter++)==4 )
//                      {
//                          break;
//                      }
                            }
                         ?>
                                    <!--    <li><a href="<?php echo base_url() ?>index.php/project/add_user">Προσθήκη συνεργατών</a></li> --> 
                                    </ul>
                                </li>
                                
                                <?php }
                            ?>
                                <li class="dropdown">
                                    <a  class=" dropdown-toggle" data-toggle="dropdown"> <i class="icon-book"  ></i> Δημοσιεύσεις <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url() ?>index.php/publication/index"><i class="icon-list-ul"></i> Εμφάνιση</a></li>
                                        <li><a href="<?php echo base_url() ?>index.php/publication/add"><i class="icon-plus-sign"></i> Προσθήκη</a></li>
<!--                                        <li><a href="#"></a></li>
                                        <li class="divider"></li>
                                        <li class="nav-header">Nav header</li>
                                        <li><a href="#">Separated link</a></li>
                                        <li><a href="#">One more separated link</a></li>-->
                                    </ul>
                                </li>

                            

                        </ul>
                        <div class="navbar-form pull-right">
                            <div class="btn-group">
                                <a class="btn btn-primary" href="<?php echo base_url() . 'index.php/member/profile'; ?>"><i class="icon-user icon-white"></i>  <?php
                                    if (isset($this->session->userdata['name'])) {
                                        echo $this->session->userdata['name'];
                                    }
                                    echo ' ';
                                    if (isset($this->session->userdata['surname'])) {
                                        echo $this->session->userdata['surname'];
                                    }
                                    ?></a>
                                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url() . 'index.php/member/profile'; ?>"><i class="icon-pencil"></i> Προφίλ</a></li>
                                    <li><a href="<?php echo base_url() ?>index.php/cowriter/show_cowriters"><i class="icon-group"  ></i> Συνεργάτες</a></li>
                                  <li class="divider"></li>
                                    <li><?php if (!$this->session->userdata('cris')) { ?>
                                        <a href="<?php echo base_url() . 'index.php/member/cris'; ?>" class=" btn-danger"><i class="icon-plus-sign icon-black"></i>Ενεργοποίηση CRIS</a>                           
                                    <?php } else { ?>
                                        <a   href="<?php echo base_url() . 'index.php/member/cris'; ?>" class="  btn-success"><i class="icon-minus-sign icon-black"></i>Απενεργοποίηση CRIS</a>
                                    <?php } ?>
                                        </li>
                                    
                                    <!--<li><a href="#"><i class="i"></i> Make admin</a></li>-->
                                </ul>
                            </div>                                               
                            <!--<form name="login" class="navbar-form pull-right" method="post" action="<?php echo base_url() . 'index.php/member/logout'; ?>">-->                           
                                <a  class="btn btn-primary" href="<?php echo base_url() . 'index.php/member/logout'; ?>"><i class="icon-off icon-white"></i> Logout</a>
                            <!--</form>-->
                        </div>

     
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
