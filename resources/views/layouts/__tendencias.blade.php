<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 21/08/2021
 * Time: 09:56
 */ ?>

<div class="container-fluid pt-3">
    <div class="container animate-box" data-animate-effect="fadeIn">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Tendências</div>
        </div>
        <div class="owl-carousel owl-theme js" id="slider1">
            @foreach($imagens as $imagem)
                <div class="item px-2">
                    <div class="fh5co_latest_trading_img_position_relative">
                        <div class="fh5co_latest_trading_img"><img src="https://picsum.photos/id/{{ $imagem->id }}/480/320" alt=""
                                                                   class="fh5co_img_special_relative"/></div>
                        <div class="fh5co_latest_trading_img_position_absolute"></div>
                        <div class="fh5co_latest_trading_img_position_absolute_1">
                            <a href="single.html" class="text-white"> Here's a new way to take better photos for
                                instagram </a>
                            <div class="fh5co_latest_trading_date_and_name_color"> Walter Johson - March 7,2017</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>