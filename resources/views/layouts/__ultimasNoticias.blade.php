<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 21/08/2021
 * Time: 09:59
 */ ?>

<div class="container-fluid pb-4 pt-5">
    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">News</div>
        </div>
        <div class="owl-carousel owl-theme" id="slider2">
            @foreach($imagens as $imagem)
            <div class="item px-2">
                <div class="fh5co_hover_news_img">
                    <div class="fh5co_news_img"><img src="https://picsum.photos/id/{{ $imagem->id }}/324/235" alt=""/></div>
                    <div>
                        <a href="single.html" class="d-block fh5co_small_post_heading"><span class="">The top 10 best computer speakers in the market</span></a>
                        <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                    </div>
                </div>
            </div>
@endforeach
        </div>
    </div>
</div>