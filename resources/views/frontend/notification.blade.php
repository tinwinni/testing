@extends('frontend.layouts.app')
@section('title', 'Notification')
@section('content')
<div>
    
    <div class="infinite-scroll">
        @foreach ($notifications as $notification)
            <a href="{{ url('notification/' . $notification->id) }}">
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <h6><i class="fas fa-bell @if(is_null($notification->read_at)) text-danger @endif"></i> {{Illuminate\Support\Str::limit($notification->data['title'],40)}}</h6>
                        <p class="mb-1">{{Illuminate\Support\Str::limit($notification->data['message'],100)}}</p>
                        <small class="text-muted mb-1">{{Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i:s A')}}</small>
                    </div>
                </div>
            </a>
        @endforeach
        <div class="text-right active">
            {{ $notifications->links() }}
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script>
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.scrolling-pagination',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
@endsection
