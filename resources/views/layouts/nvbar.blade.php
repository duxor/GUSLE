<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigacija">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/#pocetna">ГУСЛЕ</a>
        </div>
        <div id="navigacija" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#pocetna"><i class="glyphicon glyphicon-home"></i> Почетна</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-user"></i> О нама</a></li>
                <li><a href="#aktuelnosti"><i class="glyphicon glyphicon-flag"></i> Догађаји</a></li>
                <li><a href="#galerija"><i class="glyphicon glyphicon-picture"></i> Галерија</a></li>
                <li><a href="#kalendar"><i class="glyphicon glyphicon-calendar"></i> Календар догађаја</a></li>
                <li><a href="#kontakt"><i class="glyphicon glyphicon-earphone"></i> Контакт</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
$(document).ready(function(){
    // Add smooth scrolling to all links in navbar + footer link
    $("a").on('click', function(event) {
        event.preventDefault();
        // Store hash
        var hash = this.hash;
        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
            scrollTop: $(hash).offset().top-60
        }, 900, function(){
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
        });
    });
    // Slide in elements on scroll
    $(window).scroll(function() {
        $(".slideanim").each(function(){
            var pos = $(this).offset().top;
            var winTop = $(window).scrollTop();
            if (pos < winTop + 600) {
                $(this).addClass("slide");
            }
        });
    });
})
</script>
