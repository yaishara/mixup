<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.min.js"></script>
        <!-- Fonts -->


        <!-- Styles -->
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
            body {
                font-family: sans-serif;
                background: #e9e9e9;
            }
            img, iframe {
                max-width: 100%;
                height: auto;
                display: block;
            }
            .wrapper {
                width: 90%;
                margin: 1.5em auto;
            }
            .masonry {
                margin: 1.5em 0;
                padding: 0;
                -moz-column-gap: 1.5em;
                -webkit-column-gap: 1.5em;
                column-gap: 1.5em;
                font-size: .85em;
                -webkit-backface-visibility: hidden;
            }
            .masonry:after {
                content:'';
                display: inline-block;
                width: 100%;
            }
            .item {
                /* display: inline-block; */
                display: none;
                background: #fff;
                padding: 1.5em;
                margin: 0 0 1.5em;
                width: 100%;
                box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.18);
                border-radius: 3px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
            }
            .filters {
                width: 380px;
                margin: 0 auto;
            }
            .filter {
                background: #aac8ce;
                display: inline-block;
                padding: 0.5em;
                box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.18);
                border-radius: 3px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                cursor: pointer;
            }
            /*-------------------- media queries --------------------- */
            @media only screen and (min-width: 700px) {
                .masonry {
                    -moz-column-count: 2;
                    -webkit-column-count: 2;
                    column-count: 2;
                }
            }
            @media only screen and (min-width: 900px) {
                .masonry {
                    -moz-column-count: 3;
                    -webkit-column-count: 3;
                    column-count: 3;
                }
            }
            @media only screen and (min-width: 1280px) {
                .wrapper {
                    width: 1260px;
                }

                /*-------------------- reset stylesheet --------------------- */
                html, body, div, span, h1, h2, h3, p, a, ul, ol, li, img, article, aside, blockquote, figure, figcaption, footer, header, hgroup, menu, nav, section, time {
                    margin: 0;
                    padding: 0;
                    border: 0;
                    outline: 0;
                    font-size: 100%;
                    font-weight: normal;
                    vertical-align: baseline;
                }

                article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section, time {
                    display: block;
                }

                a {
                    outline: none;
                }
            }
        </style>
    </head>
    <body>
    <div class="wrapper">
        <div class="filters">
            <div class="filter" data-filter="all">Show All</div>
            @foreach($category as $key=>$categor)
            <div class="filter" data-filter=".category-{{$categor->id}}">{{$categor->name}}</div>
            @endforeach
        <div class="count-tt">count {{$itemss}}</div>
        </div>
        <div class="masonry">
            @foreach($items as $item)
            <div class="item category-{{$item->category_id}}" data-myorder="{{$item->id}}">{{$item->name}}, {{$item->category->name}}</div>
                <input data-id="{{$item->id}}" class="toggle-class" type="checkbox" name="status" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $item->status ? 'checked' : '' }}>

            @endforeach
{{--            <div class="item category-3" data-myorder="2"><span>item 2, Category 3</span>--}}
{{--            </div>--}}
{{--            <div class="item category-1" data-myorder="3">--}}
{{--                <p>Item 3, Category 1</p>--}}
{{--                <img src="http://media-cache-ec0.pinimg.com/736x/c3/10/22/c3102281f88237e7a2515099d2e6651f.jpg" alt="" />--}}
{{--            </div>--}}
{{--            <div class="item category-2" data-myorder="4">Item 4, Category 2</div>--}}
{{--            <div class="item category-1" data-myorder="5">--}}
{{--                <p>Item 5, Category 1</p>--}}
{{--                <img src="http://media-cache-ak0.pinimg.com/736x/2e/7f/db/2e7fdb7ed765973407fed0b0141bb126.jpg" alt="" />--}}
{{--            </div>--}}
{{--            <div class="item category-2" data-myorder="6">Item 6, Category 2</div>--}}
{{--            <div class="item category-3" data-myorder="7">Item 7, Category 3</div>--}}
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // Instantiate MixItUp:
            $('.masonry').mixItUp({
                selectors: {
                    target: '.item'
                }
            });
        });
    </script>
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStatus',
                    data: {'status': status, 'item_id': item_id},
                    success: function(data){
                        $(".count-tt").text(data.itemss);
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
    </body>
</html>
