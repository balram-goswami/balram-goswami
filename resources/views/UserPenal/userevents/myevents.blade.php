@include('layout.header')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('layout.head')
    <!-- End Navbar -->

    <div class="container-fluid py-2">
        <div class="container">
            <div class="row">
                @foreach($Event as $data)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/event_images/' . $data->image_path) }}"
                            class="card-img-top"
                            alt="Event Image"
                            style="padding: 12px; border-radius: 18px;">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                {{ $data->event_name }} <br>
                                Guest :-{{ $data->guest_names }}<br>
                                PROGRAM :- {{ $data->event_date }}<br>
                                Speaker :- {{ $data->speaker_name }}<br>
                                @foreach($eventType as $type)
                                Event Type :- {{ $type->name }}
                                @endforeach
                            </h5>
                            <p class="card-text">{{ $data->description }}</p>
                        </div>

                        {{-- Check if the event has a corresponding PaymentHistory with status == 2 --}}
                        @php
                        $paymentHistoryForEvent = $PaymentHistory->where('event_id', $data->id)->first();
                        @endphp

                        @if($paymentHistoryForEvent && $paymentHistoryForEvent->status == 2)
                        <div class="card-footer text-center">
                            <a href="{{ route('eventtraning', $data->id) }}">
                                <button class="btn btn-primary" data-event-id="{{ $data->id }}">Start Learning</button>
                            </a>
                        </div>
                        @endif

                    </div>
                </div>
                @endforeach

                <style>
                    .create-event-card {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 150px auto;
                    }

                    .plus-icon {
                        font-size: 40px;
                        color: #000;
                    }

                    .create-event-text {
                        font-size: 16px;
                        font-weight: bold;
                        margin-top: 10px;
                    }

                    .highlight {
                        color: #28c;
                    }
                </style>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        @if(!$createEvent)
                        <div class="create-event-card text-center">
                            <a href="{{route('userevent')}}">
                                <div>
                                    <div class="plus-icon">+</div>
                                    <div class="create-event-text">
                                        CREATE NEW <span class="highlight">EVENT</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @else
                        <div class="create-event-card text-center">
                            <div>
                                <div class="plus-icon">^^</div>
                                <div class="create-event-text">
                                    Complete a course or event first before <br>creating a new <span class="highlight">event</span>.
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>