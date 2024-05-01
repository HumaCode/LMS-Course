@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">Live Chat</h3>
    </div>

    <div class="tab-content" id="myTabContent">

        <div id="app">
            <chat-message></chat-message>
        </div>

    </div><!-- end tab-content -->
@endsection
