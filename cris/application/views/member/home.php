
<div id="container">
    <h1>Πύλη Ερευνητικής Δραστηριότητας Χαροκοπείου Πανεπιστημίου</h1>
<!--    <pre>
   //
    </pre>-->
    <div id="body">
        <div class="container">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit">
                <p><?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?></p>

                <p><?php
                    if (isset($error_message)) {
                        echo $error_message . '<br/>';
                    }
                    if (isset($this->session->userdata['name']) && isset($this->session->userdata['surname']) && isset($this->session->userdata['title'])) {
                        echo $this->session->userdata['email'] . '<br/>';
                        echo $this->session->userdata['name'] . '<br/>';
                        echo $this->session->userdata['surname'] . '<br/>';
                        echo $this->session->userdata['title'] . '<br/>';                       
                    }
//                    echo '<pre>';
//                    var_dump($this->session->all_userdata());
//                    echo '</pre>';
                    ?></p>
                <?php echo "message " . $language_msg;?>
            </div>
        </div>

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
