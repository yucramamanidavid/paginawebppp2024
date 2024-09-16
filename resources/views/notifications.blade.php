<div>
    @foreach($notifications as $notification)
        <div class="notification">
            <p>{{ $notification->data['status'] }} - {{ $notification->data['student_company'] }}</p>
        </div>
    @endforeach
</div>
