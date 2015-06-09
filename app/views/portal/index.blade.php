@extends('portal.layouts')

@section('contenido')
    <section id="main-slider" class="no-margin">
        <div class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <?php
                $active = "active";
                ?>
            @foreach(Noticia::all() as $noticia)
                
                <div class="item {{$active}}" style="background-image: url(portal1/images/slider/pizarra.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">{{$noticia->titulo}}</h1>
                                    <h2 class="animation animated-item-2">{{$noticia->descripcion}}</h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                                </div>
                            </div>

                            

                        </div>
                    </div>
                </div><!--/.item-->
                <?php
                $active = "";
                ?>
                @endforeach

               

            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section><!--/#main-slider-->



    <script src="portal1/js/jquery.js"></script>
    <script src="portal1/js/bootstrap.min.js"></script>
    <script src="portal1/js/jquery.prettyPhoto.js"></script>
    <script src="portal1/js/jquery.isotope.min.js"></script>
    <script src="portal1/js/main.js"></script>
    <script src="portal1/js/wow.min.js"></script>
    
@stop