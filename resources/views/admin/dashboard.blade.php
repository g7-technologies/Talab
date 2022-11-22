@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    <!--Page Title-->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    
    <!--number_of_joined_shops , joining request, number of orders, current month profits-->
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 align-self-center text-center">
                                    <i class="fas fa-user-friends align-self-center icon-dual-success" style="font-size:30px;"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mt-0 mb-1 font-weight-semibold">{{$total_customers}}</h3>
                                    <p class="mb-0 font-12 text-uppercase font-weight-semibold-alt text-muted">Total Customers</p>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 align-self-center text-center">
                                    <i class="dripicons-store align-self-center icon-dual-pink" style="font-size:25px;"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mt-0 mb-1 font-weight-semibold">{{$number_of_joined_shops}}</h3>
                                    <p class="mb-0 font-12 text-muted text-uppercase font-weight-semibold-alt">joined shops</p>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body justify-content-center">
                            <div class="row">
                                <div class="col-4 align-self-center text-center">
                                    <i class="fas fa-hands-helping align-self-center icon-dual-secondary" style="font-size:30px;"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mt-0 mb-1 font-weight-semibold">{{$joining_request}}</h3>
                                    <p class="mb-0 font-12 text-muted text-uppercase font-weight-semibold-alt">joining request</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 align-self-center text-center">
                                    <i data-feather="shopping-cart" class="align-self-center icon-lg icon-dual-purple"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mt-0 mb-1 font-weight-semibold">{{$orders_this_month}}</h3>
                                    <p class="mb-0 font-12 text-uppercase font-weight-semibold-alt text-muted">orders this month</p>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body justify-content-center">
                            <div class="row">
                                <div class="col-4 align-self-center text-center">
                                    <i class="fas fa-money-bill align-self-center icon-dual-warning" style="font-size:30px;"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mt-0 mb-1 font-weight-semibold">SAR <?php echo round($profit_this_month[0]->profit, 0); ?></h3>
                                    <p class="mb-0 font-12 text-uppercase font-weight-semibold-alt text-muted">current months profit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Order Status</h4>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div id="eco_categories" class="apex-charts mb-n3"></div>
                        </div>
                        <div class="col-6 align-self-center">
                            <ul class="list-unstyled">
                                
                                <li class="list-item mb-2 font-weight-semibold-alt">
                                    <i class="fas fa-play text-warning mr-2"></i>Pending
                                </li>
                                <li class="list-item mb-2 font-weight-semibold-alt">
                                    <i class="fas fa-play text-primary mr-2"></i>Accepted
                                </li>
                                <li class="list-item mb-2 font-weight-semibold-alt">
                                    <i class="fas fa-play text-pink mr-2"></i>Shipped
                                </li>
                                <li class="list-item mb-2 font-weight-semibold-alt">
                                    <i class="fas fa-play text-success mr-2"></i>Delivered
                                </li>
                                <li class="list-item mb-2 font-weight-semibold-alt">
                                    <i class="fas fa-play text-danger mr-2"></i>Cancelled
                                </li>
                            </ul>
                            <a href="{{url('/view_all_orders')}}" class="btn btn-sm btn-outline-primary btn-round dual-btn-icon">View Details <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--monthly goal and early goal-->
    <!--<div class="row">-->
    <!--    <div class="col-lg-6">-->
    <!--        <div class="card">-->
    <!--            <div class="card-body">-->
    <!--                <div class="row">                                            -->
    <!--                    <div class="col-7 align-self-center">-->
    <!--                        <div class="timer-data">-->
    <!--                            <div class="icon-info mt-1 mb-4">-->
    <!--                                <i class="mdi mdi-bullseye bg-soft-success"></i>-->
    <!--                            </div>                                                -->
    <!--                            <h3 class="mt-0 text-dark">45k <span class="font-14">of 70k</span></h3> -->
    <!--                            <h4 class="mt-0 header-title text-truncate mb-1">Monthly Goal</h4>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="col-5 align-self-center">-->
    <!--                        <div class="mt-4">-->
    <!--                            <span class="text-info">Complete</span>-->
    <!--                            <small class="float-right text-muted ml-3 font-14">62%</small>-->
    <!--                            <div class="progress mt-2" style="height:5px;">-->
    <!--                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%; border-radius:5px;" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>                                                                                                  -->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="col-lg-6">-->
    <!--        <div class="card">-->
    <!--            <div class="card-body">-->
    <!--                <div class="row">                                            -->
    <!--                    <div class="col-7 align-self-center">-->
    <!--                        <div class="timer-data">-->
    <!--                            <div class="icon-info mt-1 mb-4">-->
    <!--                                <i class="mdi mdi-bullseye-arrow bg-soft-pink"></i>-->
    <!--                            </div>                                                -->
    <!--                            <h3 class="mt-0 text-dark">26m <span class="font-14">of 30m</span></h3> -->
    <!--                            <h4 class="mt-0 header-title text-truncate mb-1">Yearly Goal</h4>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="col-5 align-self-center">-->
    <!--                        <div class="mt-4">-->
    <!--                            <span class="text-info">Complete</span>-->
    <!--                            <small class="float-right text-muted ml-3 font-14">81%</small>-->
    <!--                            <div class="progress mt-2" style="height:5px;">-->
    <!--                                <div class="progress-bar bg-pink" role="progressbar" style="width: 81%; border-radius:5px;" aria-valuenow="81" aria-valuemin="0" aria-valuemax="100"></div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>                                                                                                  -->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->

    <!--top 3 popular products-->
    <div class="row">                        
        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-3">Popular Products</h4>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody>
                                @foreach($popular_products as $products_data)
                                <tr>
                                    <td class="border-top-0">
                                        <div class="media">
                                            <img src="{{ asset('public/product_images/'.$products_data->image) }}" height="80" width="80" class="mr-4" alt="...">
                                            <div class="media-body align-self-center"> 
                                                <span class="badge badge-soft-warning p-2 font-12 mb-2">{{$products_data->total_sold}} Items sold</span>                                                           
                                                <h4 class="mt-0 title-text mb-0"><a href="{{url('/product_detail/'.$products_data->product_id)}}">{{$products_data->name}}</a></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right border-top-0">
                                        <h5 class="">SAR {{$products_data->price}}</h5>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--recent 10 orders list-->
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-body order-list">
                    <h4 class="header-title mt-0 mb-3">Order List</h4>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">Order ID</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Price</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_orders as $orders_data)
                                <tr>
                                    <td><a href="{{url('order_detail/'.$orders_data->id)}}">{{$orders_data->order_id}}</a></td>
                                    <td>{{$orders_data->created_at}}</td>
                                    <td>SAR {{$orders_data->grand_total}}</td>
                                    <td>
                                        @if($orders_data->status == 0)
                                        <span class="badge badge-md badge-boxed  badge-soft-warning">Pending</span>
                                        @elseif($orders_data->status == 1)
                                        <span class="badge badge-md badge-boxed  badge-soft-success">Approved</span>
                                        @elseif($orders_data->status == 2)
                                        <span class="badge badge-md badge-boxed  badge-soft-danger">Cancelled</span>
                                        @elseif($orders_data->status == 3)
                                        <span class="badge badge-md badge-boxed  badge-soft-primary">Shipped</span>
                                        @elseif($orders_data->status == 4)
                                        <span class="badge badge-md badge-boxed  badge-soft-success">Delivered</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--profit charts-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">                                    
                    <h4 class="header-title mt-0">Profit</h4>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <ul class="nav-border nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-semibold" data-toggle="tab" href="#daily_profit_pane" role="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-semibold" data-toggle="tab" href="#monthly_profit_pane" role="tab">Monthly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active font-weight-semibold" data-toggle="tab" href="#yearly_profit_pane" role="tab">Yearly</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane pt-3" id="daily_profit_pane" role="tabpanel">
                            <div id="daily_profit" class="apex-charts"></div>
                        </div>
                        <div class="tab-pane pt-3" id="monthly_profit_pane" role="tabpanel">
                            <div id="monthly_profit" class="apex-charts"></div>
                        </div>
                        <div class="tab-pane active pt-3" id="yearly_profit_pane" role="tabpanel">
                            <canvas id="yearly_profit" class="drop-shadow w-100"  height="350"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--Number of joined shops chart-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">                                    
                    <h4 class="header-title mt-0">number of joined shops</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav-border nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-semibold" data-toggle="tab" href="#daily_joined_shops_pane" role="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-semibold" data-toggle="tab" href="#monthly_joined_shops_pane" role="tab">Monthly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active font-weight-semibold" data-toggle="tab" href="#yearly_joined_shops_pane" role="tab">Yearly</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane pt-3" id="daily_joined_shops_pane" role="tabpanel">
                            <div id="daily_joined_shops" class="apex-charts"></div>
                        </div>
                        <div class="tab-pane pt-3" id="monthly_joined_shops_pane" role="tabpanel">
                            <div id="monthly_joined_shops" class="apex-charts"></div>
                        </div>
                        <div class="tab-pane active pt-3" id="yearly_joined_shops_pane" role="tabpanel">
                            <canvas id="yearly_joined_shops" class="drop-shadow w-100"  height="350"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--number of orders chart-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">                                    
                    <h4 class="header-title mt-0">number of orders</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav-border nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-semibold" data-toggle="tab" href="#daily_orders_pane" role="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-semibold" data-toggle="tab" href="#monthly_orders_pane" role="tab">Monthly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active font-weight-semibold" data-toggle="tab" href="#yearly_orders_pane" role="tab">Yearly</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane pt-3" id="daily_orders_pane" role="tabpanel">
                            <div id="daily_orders" class="apex-charts"></div>
                        </div>
                        <div class="tab-pane pt-3" id="monthly_orders_pane" role="tabpanel">
                            <div id="monthly_orders" class="apex-charts"></div>
                        </div>
                        <div class="tab-pane active pt-3" id="yearly_orders_pane" role="tabpanel">
                            <canvas id="yearly_orders" class="drop-shadow w-100"  height="350"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@push('scripts')
<script>
    
    $(function() {
        
        donut();
        
        $.get('{{ route("charts_data") }}').done(function(data){
            
            daily_profit(data.daily_profit);
            monthly_profit(data.monthly_profit);
            yearly_profit(data.yearly_profit);
            
            daily_joined_shops(data.daily_joined_shops);
            monthly_joined_shops(data.monthly_joined_shops);
            yearly_joined_shops(data.yearly_joined_shops);
            
            daily_orders(data.daily_orders);
            monthly_orders(data.monthly_orders);
            yearly_orders(data.yearly_orders);
        })
    });
    
    function daily_profit(data)
    {
        var options = {
            chart: {
              height: 350,
              type: 'line',
              stacked: true,
              toolbar: {
                show: false,
                autoSelected: 'zoom'
              },
              dropShadow: {
                enabled: true,
                top: 12,
                left: 0,
                bottom: 0,
                right: 0,
                blur: 2,
                color: '#ff9f43',
                opacity: 0.35
              },
            },
            colors: ['#ff9f43', '#ff9f43', '#ff9f43'],
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'smooth',
              width: [4, 4],
              dashArray: [0, 3]
            },
            grid: {
            borderColor: "#45404a2e",
            padding: {
              left: 0,
              right: 0
            },
            strokeDashArray: 4,
            },
            markers: {
            size: 0,
            hover: {
              size: 0
            }
            },
            series: [{
              name: 'Profit',
              data: data.day_profit
            }],
            
            xaxis: {
              type: 'date',
              categories: data.profit_day,
              axisBorder: {
                show: true,
                color: '#ff9f43',
              },  
              axisTicks: {
                show: true,
                color: '#ff9f43',
              },                  
            },
            yaxis: {
              labels: {
                formatter: function (value) {
                  return 'SAR '+value;
                }
              },
            },
            
            fill: {
            type: 'gradient',
            gradient: {
              gradientToColors: ['#ff9f43', '#ff9f43', '#ff9f43']
            },
            },
            tooltip: {
              x: {
                  format: 'dd/MM/yy'
              },
            },
            legend: {
            show: false,
            position: 'top',
            horizontalAlign: 'right'
            },
        }
        
        var chart = new ApexCharts(
        document.querySelector("#daily_profit"),
        options
        );
        
        chart.render();
    }
    
    function monthly_profit(data)
    {
        var options = {
            series: [{
            name: 'Profit',
            data: data.month_profit.reverse()
          },],
            chart: {
            height: 350,
            type: 'area',
            toolbar: {
              show: false,
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 2,
          },
          colors: ['#ff9f43'],
          xaxis: {
            type: 'month',
            categories: data.profit_month.reverse()
          },
          yaxis: {
            labels: {
                formatter: function (value) {
                    return "SAR " + value;
                }
            },
          },
          legend: {
            show: false,
          },
          grid: {
            borderColor: "#ff9f43",
            padding: {
              left: 0,
              right: 0
            },
            strokeDashArray: 4,
          },
          tooltip: {
            x: {
              format: 'dd/MM/yy HH:mm'
            },
          },
        };
        
        var chart = new ApexCharts(document.querySelector("#monthly_profit"), options);
        chart.render();
    }
    
    function yearly_profit(data)
    {
        var currentChartCanvas = $("#yearly_profit").get(0).getContext("2d");
        var currentChart = new Chart(currentChartCanvas, {
            type: 'bar',    
            data: {
                labels: data.profit_year,
                datasets: [{
                    label: "Profit:",
                    backgroundColor: "#ff9f43",
                    borderColor: "transparent",
                    borderWidth: 2,
                    categoryPercentage: 0.5,
                    hoverBackgroundColor: "#ff9f43",
                    hoverBorderColor: "transparent",
                    data: data.year_profit,
                },]        
            },
            
            options: {
                responsive: true,
                maintainAspectRatio: true,
                legend : {
                    display: false,
                    labels : {
                        fontColor : '#50649c'  
                    }
                },  
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return data.datasets[tooltipItems.datasetIndex].label +' SAR ' + tooltipItems.yLabel;
                        }
                    }
                },
                
                scales: {
                    xAxes: [{
                        barPercentage: 0.35,
                        categoryPercentage: 0.4,
                        display: true,
                        gridLines: {
                            color: "transparent",
                            borderDash: [0],       
                            zeroLineColor: "transparent",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2] ,         
                        },
                        ticks: {
                            fontColor: '#a4abc5',
                            beginAtZero: true,
                            padding: 12,
                        },
                        
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "#8997bd29", 
                            borderDash: [3],
                            drawBorder: false,
                            drawTicks: false,
                            zeroLineColor: "#8997bd29",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2] ,           
                        },
                        ticks: {                           
                            fontColor: '#a4abc5',
                            beginAtZero: true,
                            padding: 12,
                            callback: function(value) {
                                if ( !(value % 20) ) {
                                    return 'SAR ' + value;
                                }
                            }
                        },                        
                    }]
                },
                
            }
        });
    }
    
    function donut(data)
    {
        var options = {
            chart: {
                height: 235,
                type: 'donut',
                dropShadow: {
                  enabled: true,
                  top: 10,
                  left: 0,
                  bottom: 0,
                  right: 0,
                  blur: 2,
                  color: '#45404a2e',
                  opacity: 0.15
              },
            }, 
            plotOptions: {
              pie: {
                donut: {
                  size: '85%'
                }
              }
            },
            dataLabels: {
              enabled: false,
              },
              stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
           
            series: [Number('{{$order_percentage[0]}}'),Number('{{$order_percentage[1]}}'),Number('{{$order_percentage[2]}}'),Number('{{$order_percentage[3]}}'),Number('{{$order_percentage[4]}}')],
            legend: {
                show: false,
                position: 'bottom',
                horizontalAlign: 'center',
                verticalAlign: 'middle',
                floating: false,
                fontSize: '14px',
                offsetX: 0,
                offsetY: 5
            },
            labels: [ "Pending", "Accepted", "Shipped", "Delivered", "Cancelled"],
            colors: ["#ff9f43", '#506ee4', "#fd3c97", '#2ddab5', "#ef4d56"],
           
            responsive: [{
                breakpoint: 600,
                options: {
                  plotOptions: {
                      donut: {
                        customScale: 0.2
                      }
                    },        
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: false
                    },
                }
            }],
          
            tooltip: {
              y: {
                  formatter: function (val) {
                      return   val + "%"
                  }
              }
            }
        }
          
        var chart = new ApexCharts(
        document.querySelector("#eco_categories"),
        options
        );
        
        chart.render();
    }
    
    function daily_joined_shops(data)
    {
        var options = {
            chart: {
              height: 350,
              type: 'line',
              stacked: true,
              toolbar: {
                show: false,
                autoSelected: 'zoom'
              },
              dropShadow: {
                enabled: true,
                top: 12,
                left: 0,
                bottom: 0,
                right: 0,
                blur: 2,
                color: '#fd3c97',
                opacity: 0.35
              },
            },
            colors: ['#fd3c97', '#fd3c97', '#fd3c97'],
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'smooth',
              width: [4, 4],
              dashArray: [0, 3]
            },
            grid: {
            borderColor: "#fd3c97",
            padding: {
              left: 0,
              right: 0
            },
            strokeDashArray: 4,
            },
            markers: {
            size: 0,
            hover: {
              size: 0
            }
            },
            series: [{
              name: 'Shops Joined',
              data: data.day_shops
            }],
            
            xaxis: {
              type: 'date',
              categories: data.shops_day,
              axisBorder: {
                show: true,
                color: '#fd3c97',
              },  
              axisTicks: {
                show: true,
                color: '#fd3c97',
              },                  
            },
            yaxis: {
              labels: {
                formatter: function (value) {
                  return value + ' Shops';
                }
              },
            },
            
            fill: {
            type: 'gradient',
            gradient: {
              gradientToColors: ['#fd3c97', '#fd3c97', '#fd3c97']
            },
            },
            tooltip: {
              x: {
                  format: 'dd/MM/yy'
              },
            },
            legend: {
            show: false,
            position: 'top',
            horizontalAlign: 'right'
            },
        }
        
        var chart = new ApexCharts(
            document.querySelector("#daily_joined_shops"),
        options
        );
        
        chart.render();
    }
    
    function monthly_joined_shops(data)
    {
        var options = {
            series: [{
            name: 'Shops Joined',
            data: data.month_shops.reverse()
          },],
            chart: {
            height: 350,
            type: 'area',
            toolbar: {
              show: false,
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 2,
          },
          colors: ['#fd3c97'],
          xaxis: {
            type: 'day',
            categories: data.shops_month.reverse()
          },
          yaxis: {
            labels: {
                formatter: function (value) {
                    return value + " Shops";
                }
            },
          },
          legend: {
            show: false,
          },
          grid: {
            borderColor: "#45404a2e",
            padding: {
              left: 0,
              right: 0
            },
            strokeDashArray: 4,
          },
          tooltip: {
            x: {
              format: 'dd/MM/yy HH:mm'
            },
          },
        };
        
        var chart = new ApexCharts(document.querySelector("#monthly_joined_shops"), options);
        chart.render();
    }
    
    function yearly_joined_shops(data)
    {
        var currentChartCanvas = $("#yearly_joined_shops").get(0).getContext("2d");
        var currentChart = new Chart(currentChartCanvas, {
            type: 'bar',    
            data: {
                labels: data.shops_year,
                datasets: [{
                    label: "Shops Joined: ",
                    backgroundColor: "#fd3c97",
                    borderColor: "transparent",
                    borderWidth: 2,
                    categoryPercentage: 0.5,
                    hoverBackgroundColor: "#fd3c97",
                    hoverBorderColor: "transparent",
                    data: data.year_shops,
                },]        
            },
            
            options: {
                responsive: true,
                maintainAspectRatio: true,
                legend : {
                    display: false,
                    labels : {
                        fontColor : '#50649c'  
                    }
                },  
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return data.datasets[tooltipItems.datasetIndex].label +' ' + tooltipItems.yLabel;
                        }
                    }
                },
                
                scales: {
                    xAxes: [{
                        barPercentage: 0.35,
                        categoryPercentage: 0.4,
                        display: true,
                        gridLines: {
                            color: "transparent",
                            borderDash: [0],       
                            zeroLineColor: "transparent",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2] ,         
                        },
                        ticks: {
                            fontColor: '#a4abc5',
                            beginAtZero: true,
                            padding: 12,
                        },
                        
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "#8997bd29", 
                            borderDash: [3],
                            drawBorder: false,
                            drawTicks: false,
                            zeroLineColor: "#8997bd29",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2] ,           
                        },
                        ticks: {                           
                            fontColor: '#a4abc5',
                            beginAtZero: true,
                            padding: 12,
                            callback: function(value) {
                                if ( !(value % 10) ) {
                                    return value + ' shops'
                                }
                            }
                        },                        
                    }]
                },
                
            }
        });
    }
    
    function daily_orders(data)
    {
        var options = {
            chart: {
              height: 350,
              type: 'line',
              stacked: true,
              toolbar: {
                show: false,
                autoSelected: 'zoom'
              },
              dropShadow: {
                enabled: true,
                top: 12,
                left: 0,
                bottom: 0,
                right: 0,
                blur: 2,
                color: '#506ee4',
                opacity: 0.35
              },
            },
            colors: ['#506ee4', '#506ee4', '#506ee4'],
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'smooth',
              width: [4, 4],
              dashArray: [0, 3]
            },
            grid: {
            borderColor: "#506ee4",
            padding: {
              left: 0,
              right: 0
            },
            strokeDashArray: 4,
            },
            markers: {
            size: 0,
            hover: {
              size: 0
            }
            },
            series: [{
              name: 'Total Orders',
              data: data.day_orders
            }],
            
            xaxis: {
              type: 'date',
              categories: data.orders_day,
              axisBorder: {
                show: true,
                color: '#506ee4',
              },  
              axisTicks: {
                show: true,
                color: '#506ee4',
              },                  
            },
            yaxis: {
              labels: {
                formatter: function (value) {
                  return value + ' Orders';
                }
              },
            },
            
            fill: {
            type: 'gradient',
            gradient: {
              gradientToColors: ['#506ee4', '#506ee4', '#506ee4']
            },
            },
            tooltip: {
              x: {
                  format: 'dd/MM/yy'
              },
            },
            legend: {
            show: false,
            position: 'top',
            horizontalAlign: 'right'
            },
        }
        
        var chart = new ApexCharts(
            document.querySelector("#daily_orders"),
        options
        );
        
        chart.render();
    }
    
    function monthly_orders(data)
    {
        var options = {
            series: [{
            name: 'Total Orders',
            data: data.month_orders.reverse()
          },],
            chart: {
            height: 350,
            type: 'area',
            toolbar: {
              show: false,
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 2,
          },
          colors: ['#506ee4'],
          xaxis: {
            type: 'day',
            categories: data.orders_month.reverse()
          },
          yaxis: {
            labels: {
                formatter: function (value) {
                    return value + " Orders";
                }
            },
          },
          legend: {
            show: false,
          },
          grid: {
            borderColor: "#506ee4",
            padding: {
              left: 0,
              right: 0
            },
            strokeDashArray: 4,
          },
          tooltip: {
            x: {
              format: 'dd/MM/yy HH:mm'
            },
          },
        };
        
        var chart = new ApexCharts(document.querySelector("#monthly_orders"), options);
        chart.render();
    }
    
    function yearly_orders(data)
    {
        var currentChartCanvas = $("#yearly_orders").get(0).getContext("2d");
        var currentChart = new Chart(currentChartCanvas, {
            type: 'bar',    
            data: {
                labels: data.orders_year,
                datasets: [{
                    label: "Total Orders: ",
                    backgroundColor: "#506ee4",
                    borderColor: "transparent",
                    borderWidth: 2,
                    categoryPercentage: 0.5,
                    hoverBackgroundColor: "#506ee4",
                    hoverBorderColor: "transparent",
                    data: data.year_orders,
                },]        
            },
            
            options: {
                responsive: true,
                maintainAspectRatio: true,
                legend : {
                    display: false,
                    labels : {
                        fontColor : '#50649c'  
                    }
                },  
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return data.datasets[tooltipItems.datasetIndex].label +' ' + tooltipItems.yLabel;
                        }
                    }
                },
                
                scales: {
                    xAxes: [{
                        barPercentage: 0.35,
                        categoryPercentage: 0.4,
                        display: true,
                        gridLines: {
                            color: "transparent",
                            borderDash: [0],       
                            zeroLineColor: "transparent",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2] ,         
                        },
                        ticks: {
                            fontColor: '#a4abc5',
                            beginAtZero: true,
                            padding: 12,
                        },
                        
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "#8997bd29", 
                            borderDash: [3],
                            drawBorder: false,
                            drawTicks: false,
                            zeroLineColor: "#8997bd29",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2] ,           
                        },
                        ticks: {                           
                            fontColor: '#a4abc5',
                            beginAtZero: true,
                            padding: 12,
                            callback: function(value) {
                                if ( !(value % 10) ) {
                                    return value + ' Orders'
                                }
                            }
                        },                        
                    }]
                },
                
            }
        });
    }
    
    
</script>
@endpush