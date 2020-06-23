<div>
    @foreach($customers as $customer)
        @php
            $transactions=$customer->getTransactionsOrderBy("created_at");
            $reagents=$customer->getReagents();
            $date=array();
            $score=array();
            $sumscore=array();
            $sumspend=array();
            $sum=0;
            $sum2=0;
            $sum3=0;
            //
            $visitarray=array();
            $visit=-1;
            foreach ($transactions as $transaction)
            {
                $date[]=jdate('y/m/d',strtotime($transaction->created_at));
                if($transaction->score>0)
                {
                    $sum2+=$transaction->score;
                    $sumscore[]=$sum2;
                    $sumspend[]=$sum3;
                }
                else
                {
                    $sum3+=$transaction->score*-1;
                    $sumspend[]=$sum3;
                    $sumscore[]=$sum2;
                }
                //$points[]=$transaction->score;
                $sum+=$transaction->score;
                //$date3[][0]=jdate('y/m/d',strtotime($transaction->created_at));
                //$date3[][1]=$sum;
                $score[]=$sum;
                //
                if($visit>0)
                {
                    $visitarray[]=floor((strtotime($transaction->created_at)-$visit)/86400);

                }
                 $visit=strtotime($transaction->created_at);
            }

            $chartjs = app()->chartjs
                ->name('lineChartTest'.$customer->id)
                ->type('line')

                ->labels($date)
                ->datasets([
                    [
                        "label" => Lang::get('message.gain_score'),
                        'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                        'borderColor' => "rgba(33, 150, 243, 0.7)",
                        "pointBorderColor" => "rgba(2, 119, 189, 0.7)",
                        "pointBackgroundColor" => "rgba(2, 119, 189, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $sumscore,
                        'fill'=>false,
                    ]
                    ,
                    [
                        "label" =>Lang::get('message.spend_score'),
                        'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                        'borderColor' => "rgba(244, 67, 54, 0.7)",
                        "pointBorderColor" => "rgba(198, 40, 40, 0.7)",
                        "pointBackgroundColor" => "rgba(198, 40, 40, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $sumspend,
                        'fill'=>false,
                    ],
                     [
                        "label" => Lang::get('message.online_score'),
                        'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $score,
                        'fill'=>false,
                     ]
                ])
                ->options([]);



        $piechartjs = app()->chartjs
        ->name('pieChartTest'.$customer->id)
        ->type('doughnut')


        ->datasets([
            [
                "label" => Lang::get('message.visit_avg'),
                'backgroundColor' => ['#F44336', '#9C27B0','#3F51B5', '#2196F3','#009688', '#03A9F4'],
                'hoverBackgroundColor' => ['#F44336', '#9C27B0','#3F51B5', '#2196F3','#009688', '#03A9F4'],
                'data' => $visitarray
            ]
        ])
        ->options([]);


        $gifts=$customer->getGifts();
        $giftarray=array();
        $giftlable=array();
        foreach ($gifts as $gift)
        {
            $key = array_search($gift->title, $giftlable);
            if(false===$key)
            {
                $giftarray[]=1;
                $giftlable[]=$gift->title;
            }
            else
                $giftarray[$key]++;


        }
        $giftpiechartjs = app()->chartjs
        ->name('giftpieChartTest'.$customer->id)
        ->type('doughnut')
        ->labels($giftlable)
        ->datasets([
            [
                "label" => Lang::get('message.visit_avg'),
                'backgroundColor' => ['#F44336', '#9C27B0','#3F51B5', '#2196F3','#009688', '#03A9F4'],
                'hoverBackgroundColor' => ['#F44336', '#9C27B0','#3F51B5', '#2196F3','#009688', '#03A9F4'],
                'data' => $giftarray
            ]
        ])
        ->optionsRaw([
            'legend' => [
                'display' => false,

            ]
        ]);

        @endphp
        <div class="modal animated zoomIn text-left" id="cus{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">  {{$customer->first_name}} {{$customer->last_name}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 0px">
                                        <h4 class="card-title">{{__('message.change_score')}}</h4>
                                    </div>
                                    <div class="card-content" >
                                        <div class="card-body">
                                            {!! $chartjs->render() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 0px">
                                        <h4 class="card-title">{{__('message.visit_avg')}}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            {!! $piechartjs->render() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 0px">
                                        <h4 class="card-title">{{__('message.gift_info')}}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body" style="padding: 0px">
                                            {!! $giftpiechartjs->render() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 0px">
                                        <h4 class="card-title">{{__('message.gift_info')}}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body" style="padding: 0px">
                                            {!! $giftpiechartjs->render() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 5px">
                                        <h4 class="card-title">{{__('message.reagent_list')}}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body py-0 px-0">
                                            <div class="list-group">
                                                @forelse($reagents as $reagent)
                                                    <a href="#cus"{{$reagent->id}} class="list-group-item">
                                                        <div class="media">
                                                            <div class="media-left pr-1">
                                                                <span class="avatar avatar-sm avatar-online rounded-circle">
                                                                    <img src="/storage/avatars/avatar.png" alt="avatar"><i></i>
                                                                </span>
                                                            </div>
                                                            <div class="media-body w-100">
                                                                <h6 class="media-heading mb-0">{{$reagent->first_name}} {{$reagent->last_name}}</h6>
                                                                <p class="font-small-2 mb-0 text-muted"><td>{{$reagent->getLevel()->name}}</td></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @empty
                                                    <div>{{__('message.nocustomer')}}</div>
                                                @endforelse
                                            </div>
                                            {{--<div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('message.name')}}</th>
                                                        <th>{{__('message.lname')}}</th>
                                                        <th>{{__('message.customer_score')}}</th>
                                                        <th>{{__('message.customer_register_date')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($reagents as $reagent)
                                                        <tr>
                                                            <td>{{$reagent->first_name}}</td>
                                                            <td>{{$reagent->last_name}}</td>
                                                            <td>{{$reagent->score}}</td>
                                                            <td> {{jdate('Y/m/d',strtotime($reagent->created_at))}}</td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="4" class="text-center">{{__('message.nocustomer')}}</td> </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>



