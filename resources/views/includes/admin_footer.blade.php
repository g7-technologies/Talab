<footer class="footer text-center text-sm-left">
    &copy; 2021 Talab
</footer>
@push('scripts')
<script>
    $.get('{{ route("admin_notifications") }}').done(function(data){
        $('.unread_notifications').text(data.result.length);
        for(var i=0; i<data.result.length ;i++)
        {
            $('.admin_notification').append('<a href="{{ url("/shop_joining_request")}}" class="dropdown-item py-3"><small class="float-right text-muted pl-2"></small><div class="media"><div class="avatar-md bg-primary"><i class="la la-group text-white"></i></div><div class="media-body align-self-center ml-2 text-truncate"><h6 class="my-0 font-weight-normal text-dark">Shop Name <small class="text-muted mb-0">'+data.result[i].name+'.</small> Requested to join Talab</h6></div></div></a>');
        }
    })
</script>
@endpush