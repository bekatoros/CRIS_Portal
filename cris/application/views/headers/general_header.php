
<?php 
include ('application/views/headers/header_preamble.php');

?>

<body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
        
        <div class="navbar  <?php 
        
        if (  $header == true ) { 
           echo   "navbar-inverse" ;   
            
             }else
             {
         //  echo   "navbar-inverse" ;   
                 
             }
                         ?> navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                   <?php if ($header == true  ) { ?>
                    <a class="brand" href="<?php echo base_url();?>">  <i class="icon-xing" >Πύλη Ερευνητών</i></a>
                       <?php }else
                           { ?>
                   <a class="brand" href="<?php echo base_url().'index.php/public_c';?>">  <i class="icon-xing" > Εφαρμογή Δημοσιεύσεων                   </i>
</a>
                   
                       <?php }
                            ?>
                    <div class="nav-collapse collapse">
                        <ul class="nav">                      
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-building"></i> Τμήματα<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                     <li>  <?php if ($header == true  ) { ?>
                    <a href="<?php echo base_url();?>">  
                       <?php }else
                           { ?>
                   <a href="<?php echo base_url().'index.php/public_c';?>"> 

                   
                       <?php }
                            ?>
                                    
                                             <i class="icon-list-ul"></i> Εμφάνιση</a></li>
                                      <li class="divider"></li>
                                      <li class="nav-header"> τμηματα</li>
                                         <?php
                                       
             
                                         foreach ($orgunits as $cw) {
                           echo '<li ><a href="'.base_url() . 'index.php/public_c/showdep/'.$cw['id'].'" >'.$cw['name']. '</a></li>';
          
                            }
                         ?>
                                    
                                    
                                </ul>
                            </li>
                             
                       
                        </ul>

                        <form name="login" class="navbar-form pull-right" method="post" action="<?php echo base_url() . 'index.php/member/is_ldap'; ?>">
                            <input tabindex="1" class="span2" type="text" placeholder="e-mail@hua.gr" name="username" id="username">
                            <input tabindex="2" class="span2" type="password" placeholder="Κωδικός" name="password" id="password">                           
                            <button type="submit" class="btn btn-info"><i class="icon-off icon-white"> </i> Sign in</button>
                        </form>
                                          
              
                           
                             
                        <form class="navbar-form pull-right"  method="post" action="<?php echo base_url() . 'index.php/member/is_cas'; ?>">
        
                               <button  class="btn btn-info" >  <i class="fa fa-compass fa-lg"></i> SSO</button >  &nbsp;  &nbsp;
                        </form>
                                                              
                              
                             


                    </div><!--/.nav-collapse -->

                </div>

            </div>
        </div>
