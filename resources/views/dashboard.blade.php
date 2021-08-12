@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">Dashboard</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Dashboard</a>
                        </li>
                    </ol>
                </nav>
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Top 250 Registrations</h3>
            </div>
            <ul class="nav nav-tabs nav-tabs-block js-tabs-enabled" data-toggle="tabs" role="tablist">
                @foreach ($registration_data as $i => $website)
                    <li class="nav-item">
                        <a class="nav-link {{ $i == 0 ? 'active' : '' }}" 
                            role="tab"
                            data-toggle="tab"
                            style="color: {{ $website['color'] }}"
                            href="#{{ slugify($website['website']) }}">
                            {{ $website['website'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="block-content tab-content">
                @foreach($registration_data as $i => $website)
                    <div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}" id="{{ slugify($website['website']) }}" role="tabpanel">
                        <div class="row">
                            <div class="col-6 col-lg-4">
                                <div class="block block-link-shadow block-bordered text-center">
                                    <div class="block-content block-content-full">
                                        <div class="font-size-h3 font-w600 text-dark">{{ $website['total_registrations'] }}</div>
                                    </div>
                                    <div class="block-content py-2 bg-body-light">
                                        <p class="font-w600 font-size-sm mb-0">
                                            Total Attendees
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4">
                                
                            </div>
                            <div class="col-6 col-lg-4">
                                
                            </div>
                        </div>
                        <canvas id="{{ slugify($website['website'])}}registrationChart"></canvas>
                    </div>
                    <script>
                    // Registrations by event
                    var registrationReport = document.getElementById('{{ slugify($website['website'])}}' + 'registrationChart').getContext('2d');
                    var myChart = new Chart(registrationReport, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($website['states']) !!},
                            datasets: [{
                                label: '# of Registrations',
                                data: {!! json_encode($website['registration_count']) !!},
                                backgroundColor: '{{ hex2rgba($website['color'], .6) }}',
                                borderColor: '{{ hex2rgba($website['color']) }}',
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: 10
                                    }
                                }]
                            },
                        }
                    });
                    </script>
                @endforeach
            </div>
        </div>
    </div>
<!-- END Page Content -->
@endsection
   