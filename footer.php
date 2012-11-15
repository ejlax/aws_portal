 </div><!--/span-->
       </div>
      </div><!--/row-->

      <hr>

      <footer>
        <p align='center'>&copy; Pearson K12 Technology 2012</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="bootstrap.js"></script>
    <script>var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown', function (e) {
    window.location.hash = e.target.hash;
})

    $(document).ready(function(){
    $(".nav-list").children().each(function(){
        var listItem = $(this);
        $(this).children("a").each(function(){
            var link = $(this).attr("href");
            if (document.location.href.indexOf(link) != -1)
                {
                    $(listItem).addClass("active");
                }
        });
     
    });
    });

    </script>

  </body>
</html>
