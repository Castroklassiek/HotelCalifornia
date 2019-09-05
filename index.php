<?php include "header.php"; ?>    
        
        
<body>
<!--Carousel Duration time--> 
<script>
 $(function(){
     $('.carousel').carousel({
         interval: 1000 * 8 //1000 x 1 = 1 second
     })
 })    
</script>       
<!--Carousel Wrapper-->
<div id="video-carousel" class="carousel slide carousel-fade" data-ride="carousel">
  <!--Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#video-carousel-example" data-slide-to="0" class="active"></li>
    <li data-target="#video-carousel-example" data-slide-to="1"></li>
    <li data-target="#video-carousel-example" data-slide-to="2"></li>
    <li data-target="#video-carousel-example" data-slide-to="3"></li>
    <li data-target="#video-carousel-example" data-slide-to="4"></li>
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner c1" role="listbox">
    <div class="carousel-item active">
      <video width="100%" height="auto" class="video-fluid" autoplay loop muted>
        <source src="./video/vv3.mp4" type="video/mp4" />
      </video>
    </div>
    <div class="carousel-item">
      <video width="100%" height="auto" class="video-fluid" autoplay loop muted>
        <source src="./video/v4.mp4" type="video/mp4" />
      </video>
    </div>
    <div class="carousel-item">
      <video width="100%" height="auto" class="video-fluid" autoplay loop muted>
        <source src="./video/v5.mp4" type="video/mp4" />
      </video>
    </div>
    <div class="carousel-item">
      <video width="100%" height="auto" class="video-fluid" autoplay loop muted>
        <source src="./video/v6.mp4" type="video/mp4" />
      </video>
    </div>
    <div class="carousel-item">
      <video width="100%" height="auto" class="video-fluid" autoplay loop muted>
        <source src="./video/v7.mp4" type="video/mp4" />
      </video>
    </div>
  </div>
</div>
<!--Carousel Wrapper-->

<!--Jumbotron-->
<div class="container-fluid">
        <div class="row py-3 r1">
            <div class="col-md-12 text-center">
                <p>the hotel california offers accommodation in the heart of los angeles with cosy smoke-free rooms, decorated with high quality materials and designed to offer maximum comfort and wellbeing to our guests. All of them modern are luminous, soundproofed, with wi-fi, hd tv, air conditioning and many other services designed for your quiet rest.</p>
            </div>
            <div class="col-md-12 text-center">
                <a href="/pages/booking.php"><button type="button" class="btn btn-outline-dark btn-lg" id="b2">BOOK NOW</button></a>
            </div>
        </div>
    </div>
</body>

<?php include "footer.php"; ?>