  <div id="container">
    <!--<h1>Πύλη Ερευνητικής Δραστηριότητας Χαροκοπείου Πανεπιστημίου</h1>-->

    <div id="body">
        <div class="container" >
        
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
    
         

<br/>
                            <br/>
			Copyright (C) 2013  Marios Bekatoros bekatoros@hua.gr and Anargyros Tsadimas tsadimas@hua.gr<br/>
    <br/>
    This program is free software: you can redistribute it and/or modify<br/>
    it under the terms of the GNU Affero General Public License as<br/>
    published by the Free Software Foundation, either version 3 of the<br/>
    License, or (at your option) any later version.<br/>
<br/>
    This program is distributed in the hope that it will be useful,<br/>
    but WITHOUT ANY WARRANTY; without even the implied warranty of<br/>
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the<br/>
    GNU Affero General Public License for more details.<br/>

    You should have received a copy of the GNU Affero General Public License<br/>
    along with this program.  If not, see <a href="http://www.gnu.org/licenses/agpl.html">http://www.gnu.org/licenses/agpl.html</a>.<br/>
    The source code is available on <a href="https://github.com/bekatoros/ethesis">https://github.com/bekatoros/ethesis</a>	
    </br>
    </br>
            </div>
            <div class="span3" >

    </div>
            
                </div>

</div>

<!--    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>-->
</div>
