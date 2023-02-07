@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            <a href="{{ route('dashboard') }}">
                Configuración de sistema
            </a>
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Configuraciones
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-xlg-9">
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Product A Sales
                        </h4>
                        <div class="d-flex flex-row">
                            <div class="p-10 b-r">
                                <h6 class="font-light">
                                    Montly
                                </h6>
                                <b>
                                    20.40%
                                </b>
                            </div>
                            <div class="p-10">
                                <h6 class="font-light">
                                    Daily
                                </h6>
                                <b>
                                    5.40%
                                </b>
                            </div>
                        </div>
                    </div>
                    <div class="sparkchart" id="spark1">
                        <canvas height="50" style="display: inline-block; width: 252.438px; height: 50px; vertical-align: top;" width="252">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Product B Sales
                        </h4>
                        <div class="d-flex flex-row">
                            <div class="p-10 b-r">
                                <h6 class="font-light">
                                    Montly
                                </h6>
                                <b>
                                    20.40%
                                </b>
                            </div>
                            <div class="p-10">
                                <h6 class="font-light">
                                    Daily
                                </h6>
                                <b>
                                    5.40%
                                </b>
                            </div>
                        </div>
                    </div>
                    <div class="sparkchart" id="spark2">
                        <canvas height="50" style="display: inline-block; width: 252.438px; height: 50px; vertical-align: top;" width="252">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Product C Sales
                        </h4>
                        <div class="d-flex flex-row">
                            <div class="p-10 b-r">
                                <h6 class="font-light">
                                    Montly
                                </h6>
                                <b>
                                    20.40%
                                </b>
                            </div>
                            <div class="p-10">
                                <h6 class="font-light">
                                    Daily
                                </h6>
                                <b>
                                    5.40%
                                </b>
                            </div>
                        </div>
                    </div>
                    <div class="sparkchart" id="spark3">
                        <canvas height="50" style="display: inline-block; width: 252.438px; height: 50px; vertical-align: top;" width="252">
                        </canvas>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h3 class="card-title">
                                            Sales Overview
                                        </h3>
                                        <h6 class="card-subtitle">
                                            Ample Admin Vs Pixel Admin
                                        </h6>
                                    </div>
                                    <div class="ml-auto">
                                        <ul class="list-inline">
                                            <li>
                                                <h6 class="text-muted text-success">
                                                    <i class="fa fa-circle font-10 m-r-10 ">
                                                    </i>
                                                    Ample
                                                </h6>
                                            </li>
                                            <li>
                                                <h6 class="text-muted text-info">
                                                    <i class="fa fa-circle font-10 m-r-10">
                                                    </i>
                                                    Pixel
                                                </h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="amp-pxl" style="height: 360px;">
                                    <div class="chartist-tooltip">
                                    </div>
                                    <svg class="ct-chart-bar" height="100%" style="width: 100%; height: 100%;" width="100%" xmlns:ct="http://gionkunz.github.com/chartist-js/ct">
                                        <g class="ct-grids">
                                            <line class="ct-grid ct-vertical" x1="50" x2="766.328125" y1="325" y2="325">
                                            </line>
                                            <line class="ct-grid ct-vertical" x1="50" x2="766.328125" y1="263" y2="263">
                                            </line>
                                            <line class="ct-grid ct-vertical" x1="50" x2="766.328125" y1="201" y2="201">
                                            </line>
                                            <line class="ct-grid ct-vertical" x1="50" x2="766.328125" y1="139" y2="139">
                                            </line>
                                            <line class="ct-grid ct-vertical" x1="50" x2="766.328125" y1="77" y2="77">
                                            </line>
                                            <line class="ct-grid ct-vertical" x1="50" x2="766.328125" y1="15" y2="15">
                                            </line>
                                        </g>
                                        <g>
                                            <g class="ct-series ct-series-a">
                                                <line class="ct-bar" ct:value="9" x1="93.66629464285714" x2="93.66629464285714" y1="325" y2="101.80000000000001">
                                                </line>
                                                <line class="ct-bar" ct:value="5" x1="195.99888392857142" x2="195.99888392857142" y1="325" y2="201">
                                                </line>
                                                <line class="ct-bar" ct:value="3" x1="298.3314732142857" x2="298.3314732142857" y1="325" y2="250.6">
                                                </line>
                                                <line class="ct-bar" ct:value="7" x1="400.66406250000006" x2="400.66406250000006" y1="325" y2="151.4">
                                                </line>
                                                <line class="ct-bar" ct:value="5" x1="502.99665178571433" x2="502.99665178571433" y1="325" y2="201">
                                                </line>
                                                <line class="ct-bar" ct:value="10" x1="605.3292410714286" x2="605.3292410714286" y1="325" y2="77">
                                                </line>
                                                <line class="ct-bar" ct:value="3" x1="707.6618303571429" x2="707.6618303571429" y1="325" y2="250.6">
                                                </line>
                                            </g>
                                            <g class="ct-series ct-series-b">
                                                <line class="ct-bar" ct:value="6" x1="108.66629464285714" x2="108.66629464285714" y1="325" y2="176.2">
                                                </line>
                                                <line class="ct-bar" ct:value="3" x1="210.99888392857142" x2="210.99888392857142" y1="325" y2="250.6">
                                                </line>
                                                <line class="ct-bar" ct:value="9" x1="313.3314732142857" x2="313.3314732142857" y1="325" y2="101.80000000000001">
                                                </line>
                                                <line class="ct-bar" ct:value="5" x1="415.66406250000006" x2="415.66406250000006" y1="325" y2="201">
                                                </line>
                                                <line class="ct-bar" ct:value="4" x1="517.9966517857143" x2="517.9966517857143" y1="325" y2="225.8">
                                                </line>
                                                <line class="ct-bar" ct:value="6" x1="620.3292410714286" x2="620.3292410714286" y1="325" y2="176.2">
                                                </line>
                                                <line class="ct-bar" ct:value="4" x1="722.6618303571429" x2="722.6618303571429" y1="325" y2="225.8">
                                                </line>
                                            </g>
                                        </g>
                                        <g class="ct-labels">
                                            <foreignobject height="20" style="overflow: visible;" width="102.33258928571429" x="50" y="330">
                                                <span class="ct-label ct-horizontal ct-end" style="width: 102px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    Mon
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="20" style="overflow: visible;" width="102.33258928571429" x="152.33258928571428" y="330">
                                                <span class="ct-label ct-horizontal ct-end" style="width: 102px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    Tue
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="20" style="overflow: visible;" width="102.3325892857143" x="254.66517857142858" y="330">
                                                <span class="ct-label ct-horizontal ct-end" style="width: 102px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    Wed
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="20" style="overflow: visible;" width="102.33258928571428" x="356.9977678571429" y="330">
                                                <span class="ct-label ct-horizontal ct-end" style="width: 102px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    Thu
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="20" style="overflow: visible;" width="102.33258928571428" x="459.33035714285717" y="330">
                                                <span class="ct-label ct-horizontal ct-end" style="width: 102px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    Fri
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="20" style="overflow: visible;" width="102.33258928571433" x="561.6629464285714" y="330">
                                                <span class="ct-label ct-horizontal ct-end" style="width: 102px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    Sat
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="20" style="overflow: visible;" width="102.33258928571422" x="663.9955357142858" y="330">
                                                <span class="ct-label ct-horizontal ct-end" style="width: 102px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    Sun
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="62" style="overflow: visible;" width="30" x="10" y="263">
                                                <span class="ct-label ct-vertical ct-start" style="height: 62px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    0
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="62" style="overflow: visible;" width="30" x="10" y="201">
                                                <span class="ct-label ct-vertical ct-start" style="height: 62px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    2.5
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="62" style="overflow: visible;" width="30" x="10" y="139">
                                                <span class="ct-label ct-vertical ct-start" style="height: 62px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    5
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="62" style="overflow: visible;" width="30" x="10" y="77">
                                                <span class="ct-label ct-vertical ct-start" style="height: 62px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    7.5
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="62" style="overflow: visible;" width="30" x="10" y="15">
                                                <span class="ct-label ct-vertical ct-start" style="height: 62px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    10
                                                </span>
                                            </foreignobject>
                                            <foreignobject height="30" style="overflow: visible;" width="30" x="10" y="-15">
                                                <span class="ct-label ct-vertical ct-start" style="height: 30px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">
                                                    12.5
                                                </span>
                                            </foreignobject>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            Product Sales
                        </h3>
                        <div class="c3" id="visitor" style="height: 285px; width: 100%; max-height: 285px; position: relative;">
                            <svg height="285" style="overflow: hidden;" width="354.65625">
                                <defs>
                                    <clippath id="c3-1655834959064-clip">
                                        <rect height="261" width="354.65625">
                                        </rect>
                                    </clippath>
                                    <clippath id="c3-1655834959064-clip-xaxis">
                                        <rect height="40" width="416.65625" x="-31" y="-20">
                                        </rect>
                                    </clippath>
                                    <clippath id="c3-1655834959064-clip-yaxis">
                                        <rect height="285" width="20" x="-29" y="-4">
                                        </rect>
                                    </clippath>
                                    <clippath id="c3-1655834959064-clip-grid">
                                        <rect height="261" width="354.65625">
                                        </rect>
                                    </clippath>
                                    <clippath id="c3-1655834959064-clip-subchart">
                                        <rect width="354.65625">
                                        </rect>
                                    </clippath>
                                </defs>
                                <g transform="translate(0.5,4.5)">
                                    <text class="c3-text c3-empty" dominant-baseline="middle" style="opacity: 0;" text-anchor="middle" x="177.328125" y="130.5">
                                    </text>
                                    <rect class="c3-zoom-rect" height="261" style="opacity: 0;" width="354.65625">
                                    </rect>
                                    <g class="c3-regions" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip)" style="visibility: hidden;">
                                    </g>
                                    <g class="c3-grid" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip-grid)" style="visibility: hidden;">
                                        <g class="c3-xgrid-focus">
                                            <line class="c3-xgrid-focus" style="visibility: hidden;" x1="-10" x2="-10" y1="0" y2="261">
                                            </line>
                                        </g>
                                    </g>
                                    <g class="c3-chart" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip)">
                                        <g class="c3-event-rects c3-event-rects-single" style="fill-opacity: 0;">
                                            <rect class=" c3-event-rect c3-event-rect-0" height="261" width="354.65625" x="0.671875" y="0">
                                            </rect>
                                        </g>
                                        <g class="c3-chart-bars">
                                            <g class="c3-chart-bar c3-target c3-target-Other" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-shapes c3-shapes-Other c3-bars c3-bars-Other" style="cursor: pointer;">
                                                </g>
                                            </g>
                                            <g class="c3-chart-bar c3-target c3-target-Desktop" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-shapes c3-shapes-Desktop c3-bars c3-bars-Desktop" style="cursor: pointer;">
                                                </g>
                                            </g>
                                            <g class="c3-chart-bar c3-target c3-target-Tablet" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-shapes c3-shapes-Tablet c3-bars c3-bars-Tablet" style="cursor: pointer;">
                                                </g>
                                            </g>
                                            <g class="c3-chart-bar c3-target c3-target-Mobile" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-shapes c3-shapes-Mobile c3-bars c3-bars-Mobile" style="cursor: pointer;">
                                                </g>
                                            </g>
                                        </g>
                                        <g class="c3-chart-lines">
                                            <g class="c3-chart-line c3-target c3-target-Other" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-shapes c3-shapes-Other c3-lines c3-lines-Other">
                                                </g>
                                                <g class=" c3-shapes c3-shapes-Other c3-areas c3-areas-Other">
                                                </g>
                                                <g class=" c3-selected-circles c3-selected-circles-Other">
                                                </g>
                                                <g class=" c3-shapes c3-shapes-Other c3-circles c3-circles-Other" style="cursor: pointer;">
                                                </g>
                                            </g>
                                            <g class="c3-chart-line c3-target c3-target-Desktop" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-shapes c3-shapes-Desktop c3-lines c3-lines-Desktop">
                                                </g>
                                                <g class=" c3-shapes c3-shapes-Desktop c3-areas c3-areas-Desktop">
                                                </g>
                                                <g class=" c3-selected-circles c3-selected-circles-Desktop">
                                                </g>
                                                <g class=" c3-shapes c3-shapes-Desktop c3-circles c3-circles-Desktop" style="cursor: pointer;">
                                                </g>
                                            </g>
                                            <g class="c3-chart-line c3-target c3-target-Tablet" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-shapes c3-shapes-Tablet c3-lines c3-lines-Tablet">
                                                </g>
                                                <g class=" c3-shapes c3-shapes-Tablet c3-areas c3-areas-Tablet">
                                                </g>
                                                <g class=" c3-selected-circles c3-selected-circles-Tablet">
                                                </g>
                                                <g class=" c3-shapes c3-shapes-Tablet c3-circles c3-circles-Tablet" style="cursor: pointer;">
                                                </g>
                                            </g>
                                            <g class="c3-chart-line c3-target c3-target-Mobile" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-shapes c3-shapes-Mobile c3-lines c3-lines-Mobile">
                                                </g>
                                                <g class=" c3-shapes c3-shapes-Mobile c3-areas c3-areas-Mobile">
                                                </g>
                                                <g class=" c3-selected-circles c3-selected-circles-Mobile">
                                                </g>
                                                <g class=" c3-shapes c3-shapes-Mobile c3-circles c3-circles-Mobile" style="cursor: pointer;">
                                                </g>
                                            </g>
                                        </g>
                                        <g class="c3-chart-arcs" transform="translate(177.328125,125.5)">
                                            <text class="c3-chart-arcs-title" style="text-anchor: middle; opacity: 1;">
                                                Yearly Sales
                                            </text>
                                            <g class="c3-chart-arc c3-target c3-target-Other">
                                                <g class=" c3-shapes c3-shapes-Other c3-arcs c3-arcs-Other">
                                                    <path class=" c3-shape c3-shape c3-arc c3-arc-Other" d="M-111.47731153416856,42.277767657646336A119.225,119.225 0 0,1 -55.40662018691837,-105.56849465850391L-46.11215674604299,-87.85937414543972A99.225,99.225 0 0,0 -92.77698668046027,35.18566991679562Z" style="fill: rgb(236, 239, 241); cursor: pointer; opacity: 1;" transform="scale(1,1)">
                                                    </path>
                                                </g>
                                                <text class="" dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" transform="translate(-89.18184922733485,-33.822214126117046)">
                                                </text>
                                            </g>
                                            <g class="c3-chart-arc c3-target c3-target-Desktop">
                                                <g class=" c3-shapes c3-shapes-Desktop c3-arcs c3-arcs-Desktop">
                                                    <path class=" c3-shape c3-shape c3-arc c3-arc-Desktop" d="M-55.40662018691837,-105.56849465850391A119.225,119.225 0 0,1 -1.2779434928299889e-13,-119.225L-1.0635684049155433e-13,-99.225A99.225,99.225 0 0,0 -46.11215674604299,-87.85937414543972Z" style="fill: rgb(116, 90, 242); cursor: pointer; opacity: 1;" transform="scale(1,1)">
                                                    </path>
                                                </g>
                                                <text class="" dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" transform="translate(-22.825928059747337,-92.60843054609681)">
                                                </text>
                                            </g>
                                            <g class="c3-chart-arc c3-target c3-target-Tablet">
                                                <g class=" c3-shapes c3-shapes-Tablet c3-arcs c3-arcs-Tablet">
                                                    <path class=" c3-shape c3-shape c3-arc c3-arc-Tablet" d="M79.06079892875883,89.2411939506995A119.225,119.225 0 0,1 -111.47731153416856,42.277767657646336L-92.77698668046027,35.18566991679562A99.225,99.225 0 0,0 65.79834576394292,74.27097898727747Z" style="fill: rgb(38, 198, 218); cursor: pointer; opacity: 1;" transform="scale(1,1)">
                                                    </path>
                                                </g>
                                                <text class="" dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" transform="translate(-22.825928059747234,92.60843054609686)">
                                                </text>
                                            </g>
                                            <g class="c3-chart-arc c3-target c3-target-Mobile">
                                                <g class=" c3-shapes c3-shapes-Mobile c3-arcs c3-arcs-Mobile">
                                                    <path class=" c3-shape c3-shape c3-arc c3-arc-Mobile" d="M7.300425731417159e-15,-119.225A119.225,119.225 0 0,1 79.06079892875883,89.2411939506995L65.79834576394292,74.27097898727747A99.225,99.225 0 0,0 6.075778932269806e-15,-99.225Z" style="fill: rgb(30, 136, 229); cursor: pointer; opacity: 1;" transform="scale(1,1)">
                                                    </path>
                                                </g>
                                                <text class="" dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" transform="translate(89.18184922733485,-33.82221412611705)">
                                                </text>
                                            </g>
                                        </g>
                                        <g class="c3-chart-texts">
                                            <g class="c3-chart-text c3-target c3-target-Other" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-texts c3-texts-Other">
                                                </g>
                                            </g>
                                            <g class="c3-chart-text c3-target c3-target-Desktop" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-texts c3-texts-Desktop">
                                                </g>
                                            </g>
                                            <g class="c3-chart-text c3-target c3-target-Tablet" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-texts c3-texts-Tablet">
                                                </g>
                                            </g>
                                            <g class="c3-chart-text c3-target c3-target-Mobile" style="opacity: 1; pointer-events: none;">
                                                <g class=" c3-texts c3-texts-Mobile">
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                    <g class="c3-grid c3-grid-lines" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip-grid)">
                                        <g class="c3-xgrid-lines">
                                        </g>
                                        <g class="c3-ygrid-lines">
                                        </g>
                                    </g>
                                    <g class="c3-axis c3-axis-x" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip-xaxis)" style="visibility: visible; opacity: 0;" transform="translate(0,261)">
                                        <text class="c3-axis-x-label" dx="-0.5em" dy="-0.5em" style="text-anchor: end;" transform="" x="354.65625">
                                        </text>
                                        <g class="tick" style="opacity: 1;" transform="translate(178, 0)">
                                            <line x1="0" x2="0" y2="6">
                                            </line>
                                            <text style="text-anchor: middle; display: block;" transform="" x="0" y="9">
                                                <tspan dx="0" dy=".71em" x="0">
                                                    0
                                                </tspan>
                                            </text>
                                        </g>
                                        <path class="domain" d="M0,6V0H354.65625V6">
                                        </path>
                                    </g>
                                    <g class="c3-axis c3-axis-y" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip-yaxis)" style="visibility: visible; opacity: 0;" transform="translate(0,0)">
                                        <text class="c3-axis-y-label" dx="-0.5em" dy="1.2em" style="text-anchor: end;" transform="rotate(-90)" x="0">
                                        </text>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,240)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    10
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,213)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    15
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,186)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    20
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,159)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    25
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,131)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    30
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,104)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    35
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,77)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    40
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,50)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    45
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,23)">
                                            <line x2="-6">
                                            </line>
                                            <text style="text-anchor: end;" x="-9" y="0">
                                                <tspan dy="3" x="-9">
                                                    50
                                                </tspan>
                                            </text>
                                        </g>
                                        <path class="domain" d="M-6,1H0V261H-6">
                                        </path>
                                    </g>
                                    <g class="c3-axis c3-axis-y2" style="visibility: hidden; opacity: 0;" transform="translate(354.65625,0)">
                                        <text class="c3-axis-y2-label" dx="-0.5em" dy="-0.5em" style="text-anchor: end;" transform="rotate(-90)" x="0">
                                        </text>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,261)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,235)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.1
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,209)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.2
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,183)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.3
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,157)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.4
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,131)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.5
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,105)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.6
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,80)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.7
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,53)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.8
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,27)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    0.9
                                                </tspan>
                                            </text>
                                        </g>
                                        <g class="tick" style="opacity: 1;" transform="translate(0,1)">
                                            <line x2="6" y2="0">
                                            </line>
                                            <text style="text-anchor: start;" x="9" y="0">
                                                <tspan dy="3" x="9">
                                                    1
                                                </tspan>
                                            </text>
                                        </g>
                                        <path class="domain" d="M6,1H0V261H6">
                                        </path>
                                    </g>
                                </g>
                                <g style="visibility: hidden;" transform="translate(0.5,285.5)">
                                    <g class="c3-chart" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip-subchart)">
                                        <g class="c3-chart-bars">
                                        </g>
                                        <g class="c3-chart-lines">
                                        </g>
                                    </g>
                                    <g class="c3-brush" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip)" style="pointer-events: all; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                        <rect class="background" style="visibility: hidden; cursor: crosshair;" width="354.65625" x="0">
                                        </rect>
                                        <rect class="extent" style="cursor: move;" width="0" x="0">
                                        </rect>
                                        <g class="resize e" style="cursor: ew-resize; display: none;" transform="translate(0,0)">
                                            <rect height="6" style="visibility: hidden;" width="6" x="-3">
                                            </rect>
                                        </g>
                                        <g class="resize w" style="cursor: ew-resize; display: none;" transform="translate(0,0)">
                                            <rect height="6" style="visibility: hidden;" width="6" x="-3">
                                            </rect>
                                        </g>
                                    </g>
                                    <g class="c3-axis-x" clip-path="url(file:///C:/Users/Diego%20Sanchez/Documents/MaterialPro%20v2.2.1%20%E2%80%93%20Material%20Design%20Bootstrap%204%20Admin%20Template/materialproadmin-221/material-pro/material-pro/horizontal/index6.html#c3-1655834959064-clip-xaxis)" style="visibility: hidden; opacity: 0;" transform="translate(0,0)">
                                        <g class="tick" style="opacity: 1;" transform="translate(178, 0)">
                                            <line x1="0" x2="0" y2="6">
                                            </line>
                                            <text style="text-anchor: middle; display: block;" transform="" x="0" y="9">
                                                <tspan dx="0" dy=".71em" x="0">
                                                    0
                                                </tspan>
                                            </text>
                                        </g>
                                        <path class="domain" d="M0,6V0H354.65625V6">
                                        </path>
                                    </g>
                                </g>
                                <g transform="translate(0,265)">
                                    <g class="c3-legend-item c3-legend-item-Other" style="visibility: hidden; cursor: pointer;">
                                        <text style="pointer-events: none;" x="14" y="9">
                                            Other
                                        </text>
                                        <rect class="c3-legend-item-event" height="0" style="fill-opacity: 0;" width="0" x="0" y="-5">
                                        </rect>
                                        <line class="c3-legend-item-tile" stroke-width="10" style="stroke: rgb(236, 239, 241); pointer-events: none;" x1="-2" x2="8" y1="4" y2="4">
                                        </line>
                                    </g>
                                    <g class="c3-legend-item c3-legend-item-Desktop" style="visibility: hidden; cursor: pointer;">
                                        <text style="pointer-events: none;" x="14" y="9">
                                            Desktop
                                        </text>
                                        <rect class="c3-legend-item-event" height="0" style="fill-opacity: 0;" width="0" x="0" y="-5">
                                        </rect>
                                        <line class="c3-legend-item-tile" stroke-width="10" style="stroke: rgb(116, 90, 242); pointer-events: none;" x1="-2" x2="8" y1="4" y2="4">
                                        </line>
                                    </g>
                                    <g class="c3-legend-item c3-legend-item-Tablet" style="visibility: hidden; cursor: pointer;">
                                        <text style="pointer-events: none;" x="14" y="9">
                                            Tablet
                                        </text>
                                        <rect class="c3-legend-item-event" height="0" style="fill-opacity: 0;" width="0" x="0" y="-5">
                                        </rect>
                                        <line class="c3-legend-item-tile" stroke-width="10" style="stroke: rgb(38, 198, 218); pointer-events: none;" x1="-2" x2="8" y1="4" y2="4">
                                        </line>
                                    </g>
                                    <g class="c3-legend-item c3-legend-item-Mobile" style="visibility: hidden; cursor: pointer;">
                                        <text style="pointer-events: none;" x="14" y="9">
                                            Mobile
                                        </text>
                                        <rect class="c3-legend-item-event" height="0" style="fill-opacity: 0;" width="0" x="0" y="-5">
                                        </rect>
                                        <line class="c3-legend-item-tile" stroke-width="10" style="stroke: rgb(30, 136, 229); pointer-events: none;" x1="-2" x2="8" y1="4" y2="4">
                                        </line>
                                    </g>
                                </g>
                                <text class="c3-title" x="177.328125" y="0">
                                </text>
                            </svg>
                            <div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none;">
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr class="m-t-0 m-b-0">
                        </hr>
                    </div>
                    <div class="card-body text-center ">
                        <ul class="list-inline m-b-0">
                            <li>
                                <h6 class="text-muted text-info">
                                    <i class="fa fa-circle font-10 m-r-10 ">
                                    </i>
                                    Mobile
                                </h6>
                            </li>
                            <li>
                                <h6 class="text-muted text-primary">
                                    <i class="fa fa-circle font-10 m-r-10">
                                    </i>
                                    Desktop
                                </h6>
                            </li>
                            <li>
                                <h6 class="text-muted text-success">
                                    <i class="fa fa-circle font-10 m-r-10">
                                    </i>
                                    Tablet
                                </h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card card-inverse card-success">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="m-r-20 align-self-center">
                                <h1 class="text-white">
                                    <i class="icon-cloud-download">
                                    </i>
                                </h1>
                            </div>
                            <div>
                                <h3 class="card-title">
                                    Download count
                                </h3>
                                <h6 class="card-subtitle">
                                    March  2017
                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <h2 class="font-light text-white">
                                    35487
                                </h2>
                            </div>
                            <div class="col-8 p-t-10 p-b-20 text-right">
                                <div class="spark-count" style="height:65px">
                                    <canvas height="70" style="display: inline-block; width: 146px; height: 70px; vertical-align: top;" width="146">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img alt="Card image cap" class="" src="../assets/images/background/weatherbg.jpg">
                        <div class="card-img-overlay" style="height:110px;">
                            <h3 class="card-title text-white m-b-0 dl">
                                New Delhi
                            </h3>
                            <small class="card-text text-white font-light">
                                Sunday 15 march
                            </small>
                        </div>
                        <div class="card-body weather-small">
                            <div class="row">
                                <div class="col-8 b-r align-self-center">
                                    <div class="d-flex">
                                        <div class="display-6 text-info">
                                            <i class="wi wi-day-rain-wind">
                                            </i>
                                        </div>
                                        <div class="m-l-20">
                                            <h1 class="font-light text-info m-b-0">
                                                32
                                                <sup>
                                                    0
                                                </sup>
                                            </h1>
                                            <small>
                                                Sunny Rainy day
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    <h1 class="font-light m-b-0">
                                        25
                                        <sup>
                                            0
                                        </sup>
                                    </h1>
                                    <small>
                                        Tonight
                                    </small>
                                </div>
                            </div>
                        </div>
                    </img>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse">
                                <i class="ti-minus">
                                </i>
                            </a>
                            <a class="btn-minimize" data-action="expand">
                                <i class="mdi mdi-arrow-expand">
                                </i>
                            </a>
                            <a class="btn-close" data-action="close">
                                <i class="ti-close">
                                </i>
                            </a>
                        </div>
                        <h4 class="card-title m-b-0">
                            Product Overview
                        </h4>
                    </div>
                    <div class="card-body collapse show">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                    <tr>
                                        <th>
                                            Customer
                                        </th>
                                        <th>
                                            Photo
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Steave Jobs
                                        </td>
                                        <td>
                                            <img alt="iMac" src="../assets/images/gallery/chair.jpg" width="80">
                                            </img>
                                        </td>
                                        <td>
                                            20
                                        </td>
                                        <td>
                                            10-7-2017
                                        </td>
                                        <td>
                                            <span class="label label-success font-weight-100">
                                                Paid
                                            </span>
                                        </td>
                                        <td>
                                            <a class="text-inverse p-r-10" data-original-title="Edit" data-toggle="tooltip" href="javascript:void(0)" title="">
                                                <i class="ti-marker-alt">
                                                </i>
                                            </a>
                                            <a class="text-inverse" data-original-title="Delete" data-toggle="tooltip" href="javascript:void(0)" title="">
                                                <i class="ti-trash">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Varun Dhavan
                                        </td>
                                        <td>
                                            <img alt="iPhone" src="../assets/images/gallery/chair2.jpg" width="80">
                                            </img>
                                        </td>
                                        <td>
                                            25
                                        </td>
                                        <td>
                                            09-7-2017
                                        </td>
                                        <td>
                                            <span class="label label-warning font-weight-100">
                                                Pending
                                            </span>
                                        </td>
                                        <td>
                                            <a class="text-inverse p-r-10" data-original-title="Edit" data-toggle="tooltip" href="javascript:void(0)" title="">
                                                <i class="ti-marker-alt">
                                                </i>
                                            </a>
                                            <a class="text-inverse" data-original-title="Delete" data-toggle="tooltip" href="javascript:void(0)" title="">
                                                <i class="ti-trash">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Ritesh Desh
                                        </td>
                                        <td>
                                            <img alt="apple_watch" src="../assets/images/gallery/chair3.jpg" width="80">
                                            </img>
                                        </td>
                                        <td>
                                            12
                                        </td>
                                        <td>
                                            08-7-2017
                                        </td>
                                        <td>
                                            <span class="label label-success font-weight-100">
                                                Paid
                                            </span>
                                        </td>
                                        <td>
                                            <a class="text-inverse p-r-10" data-original-title="Edit" data-toggle="tooltip" href="javascript:void(0)" title="">
                                                <i class="ti-marker-alt">
                                                </i>
                                            </a>
                                            <a class="text-inverse" data-original-title="Delete" data-toggle="tooltip" href="javascript:void(0)" title="">
                                                <i class="ti-trash">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Hrithik
                                        </td>
                                        <td>
                                            <img alt="mac_mouse" src="../assets/images/gallery/chair4.jpg" width="80">
                                            </img>
                                        </td>
                                        <td>
                                            18
                                        </td>
                                        <td>
                                            02-7-2017
                                        </td>
                                        <td>
                                            <span class="label label-danger font-weight-100">
                                                Failed
                                            </span>
                                        </td>
                                        <td>
                                            <a class="text-inverse p-r-10" data-original-title="Edit" data-toggle="tooltip" href="javascript:void(0)" title="">
                                                <i class="ti-marker-alt">
                                                </i>
                                            </a>
                                            <a class="text-inverse" data-original-title="Delete" data-toggle="tooltip" href="javascript:void(0)" title="">
                                                <i class="ti-trash">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
    <div class="col-md-4 col-xlg-3">
        <!-- Column -->
        <div class="card earning-widget">
            <div class="card-header">
                <div class="card-actions">
                    <a class="" data-action="collapse">
                        <i class="ti-minus">
                        </i>
                    </a>
                    <a class="btn-minimize" data-action="expand">
                        <i class="mdi mdi-arrow-expand">
                        </i>
                    </a>
                    <a class="btn-close" data-action="close">
                        <i class="ti-close">
                        </i>
                    </a>
                </div>
                <h4 class="card-title m-b-0">
                    Earning
                </h4>
            </div>
            <div class="card-body b-t collapse show">
                <table class="table v-middle no-border">
                    <tbody>
                        <tr>
                            <td style="width:40px">
                                <img alt="logo" class="img-circle" src="../assets/images/users/1.jpg" width="50"/>
                            </td>
                            <td>
                                Andrew
                            </td>
                            <td align="right">
                                <span class="label label-light-info">
                                    $2300
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img alt="logo" class="img-circle" src="../assets/images/users/2.jpg" width="50"/>
                            </td>
                            <td>
                                Kristeen
                            </td>
                            <td align="right">
                                <span class="label label-light-success">
                                    $3300
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img alt="logo" class="img-circle" src="../assets/images/users/3.jpg" width="50"/>
                            </td>
                            <td>
                                Dany John
                            </td>
                            <td align="right">
                                <span class="label label-light-primary">
                                    $4300
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img alt="logo" class="img-circle" src="../assets/images/users/4.jpg" width="50"/>
                            </td>
                            <td>
                                Chris gyle
                            </td>
                            <td align="right">
                                <span class="label label-light-warning">
                                    $5300
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img alt="logo" class="img-circle" src="../assets/images/users/5.jpg" width="50"/>
                            </td>
                            <td>
                                Prabhas
                            </td>
                            <td align="right">
                                <span class="label label-light-danger">
                                    $4567
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img alt="logo" class="img-circle" src="../assets/images/users/6.jpg" width="50"/>
                            </td>
                            <td>
                                Bahubali
                            </td>
                            <td align="right">
                                <span class="label label-light-megna">
                                    $7889
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Column -->
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    <a class="" data-action="collapse">
                        <i class="ti-minus">
                        </i>
                    </a>
                    <a class="btn-minimize" data-action="expand">
                        <i class="mdi mdi-arrow-expand">
                        </i>
                    </a>
                    <a class="btn-close" data-action="close">
                        <i class="ti-close">
                        </i>
                    </a>
                </div>
                <h4 class="card-title m-b-0">
                    Discount
                </h4>
            </div>
            <div class="card-body collapse show bg-info">
                <div class="carousel slide" data-ride="carousel" id="myCarousel">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="carousel-item flex-column active">
                            <i class="fa fa-shopping-cart fa-2x text-white">
                            </i>
                            <p class="text-white">
                                25th Jan
                            </p>
                            <h3 class="text-white font-light">
                                Now Get
                                <span class="font-bold">
                                    50% Off
                                </span>
                                <br>
                                    on buy
                                </br>
                            </h3>
                            <div class="text-white m-t-20">
                                <i>
                                    - Ecommerce site
                                </i>
                            </div>
                        </div>
                        <div class="carousel-item flex-column">
                            <i class="fa fa-shopping-cart fa-2x text-white">
                            </i>
                            <p class="text-white">
                                25th Jan
                            </p>
                            <h3 class="text-white font-light">
                                Now Get
                                <span class="font-bold">
                                    50% Off
                                </span>
                                <br>
                                    on buy
                                </br>
                            </h3>
                            <div class="text-white m-t-20">
                                <i>
                                    - Ecommerce site
                                </i>
                            </div>
                        </div>
                        <div class="carousel-item flex-column">
                            <i class="fa fa-shopping-cart fa-2x text-white">
                            </i>
                            <p class="text-white">
                                25th Jan
                            </p>
                            <h3 class="text-white font-light">
                                Now Get
                                <span class="font-bold">
                                    50% Off
                                </span>
                                <br>
                                    on buy
                                </br>
                            </h3>
                            <div class="text-white m-t-20">
                                <i>
                                    - Ecommerce site
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    <a class="" data-action="collapse">
                        <i class="ti-minus">
                        </i>
                    </a>
                    <a class="btn-minimize" data-action="expand">
                        <i class="mdi mdi-arrow-expand">
                        </i>
                    </a>
                    <a class="btn-close" data-action="close">
                        <i class="ti-close">
                        </i>
                    </a>
                </div>
                <h4 class="card-title m-b-0">
                    Monthly Wineer
                </h4>
            </div>
            <div class="card-body collapse show b-t">
                <div class="m-t-30 text-center">
                    <img class="img-circle" src="../assets/images/users/5.jpg" width="150">
                        <h4 class="card-title m-t-10">
                            Hanna Gover
                        </h4>
                        <h6 class="card-subtitle">
                            Accoubts Manager Amix corp
                        </h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4">
                                <a class="link" href="javascript:void(0)">
                                    <i class="icon-people">
                                    </i>
                                    <font class="font-medium">
                                        254
                                    </font>
                                </a>
                            </div>
                            <div class="col-4">
                                <a class="link" href="javascript:void(0)">
                                    <i class="icon-picture">
                                    </i>
                                    <font class="font-medium">
                                        54
                                    </font>
                                </a>
                            </div>
                        </div>
                    </img>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    <a class="" data-action="collapse">
                        <i class="ti-minus">
                        </i>
                    </a>
                    <a class="btn-minimize" data-action="expand">
                        <i class="mdi mdi-arrow-expand">
                        </i>
                    </a>
                    <a class="btn-close" data-action="close">
                        <i class="ti-close">
                        </i>
                    </a>
                </div>
                <h4 class="card-title m-b-0">
                    New items
                </h4>
            </div>
            <div class="card-body p-0 collapse show text-center">
                <div class="carousel slide" data-ride="carousel" id="myCarousel2">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="carousel-item flex-column">
                            <img alt="user" src="../assets/images/gallery/chair.jpg">
                                <h4 class="m-b-30">
                                    Brand New Chair
                                </h4>
                            </img>
                        </div>
                        <div class="carousel-item flex-column">
                            <img alt="user" src="../assets/images/gallery/chair2.jpg">
                                <h4 class="m-b-30">
                                    Brand New Chair
                                </h4>
                            </img>
                        </div>
                        <div class="carousel-item flex-column">
                            <img alt="user" src="../assets/images/gallery/chair3.jpg">
                                <h4 class="m-b-30">
                                    Brand New Chair
                                </h4>
                            </img>
                        </div>
                        <div class="carousel-item flex-column active">
                            <img alt="user" src="../assets/images/gallery/chair4.jpg">
                                <h4 class="m-b-30">
                                    Brand New Chair
                                </h4>
                            </img>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function() {
    });
</script>
@endsection
