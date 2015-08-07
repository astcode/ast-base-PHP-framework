<footer class="footer">
<div class="container">
    <div class="row">
        <div class="col-md-4">
        <h3>Page Counter</h3>
            <?php
            // Hit counter Unique and total hits per IP address
            $file = Config::get('site/base_url').'counter/';
            $all_hits = file_get_contents($file."all_hits.txt");
            echo "Total Page Hits On The Index Page: ". $all_hits."<br>";
            $all_hits = file_get_contents($file."counter.txt");
            echo "Unique Page Hits On The Index Page: ". $all_hits;
        ?>
        </div>
        <div class="col-md-4">
            <h3>Customer Center</h3>
            <h6>contact us</h6>
            <h6>link 2</h6>
            <h6>link 3</h6>
            <br >
        </div>
        <div class="col-md-4">
            <h3>Legal Bla</h3>
            copyright AST FrameWork
        </div>
    </div>
</div>
</footer>

        <!-- jQuery -->
        <script src="includes/js/jquery.1.10.2.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="includes/js/bootstrap.min.js"></script>

        <!-- Scrolling Nav JavaScript -->
        <script src="includes/js/jquery.easing.min.js"></script>
        <script src="includes/js/scrolling-nav.js"></script>



</body>
</html>