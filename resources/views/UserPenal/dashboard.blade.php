@include('layout.header')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('layout.head')
    <!-- End Navbar -->
    <div class="container-fluid py-2">
        <style>
            .dashboardbox {
                height: 192px;
                background: #00bcd491;
                border-radius: 9px;
                display: flex;
                align-items: center;
                margin-bottom: auto;
            }

            .fontsize {
                font-size: 12px;
            }
        </style>
        <div class="row g-1">
            @foreach($userEvents as $data)
            <div class="col-lg-6">
                <div class="card" style="min-height: 223px;">
                    <div class="card-body">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6 custom-card">
                                    <h4 class="fontsize">{{ $data->event_name }}</h4>
                                    <p class="description fontsize">{{ $data->description }}</p>
                                    <h4 class="fontsize">Event By:- {{ $data->user->name }}</h4>
                                    <h4 class="fontsize">Event Type:- {{ $data->eventType->name }}</h4>
                                    <a href="{{ route('courespaymentpage', $data->id) }}">
                                        <button class="btn join-btn">Join Event</button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <div class="program-card">
                                        <img src="{{ asset('storage/event_images/' . $data->image_path) }}"
                                            class="card-img-top"
                                            alt="Event Image"
                                            style="padding: 12px; border-radius: 18px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>