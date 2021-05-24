<div class="dropdown actn-btn-dw">
    <a type="button" data-toggle="dropdown" class="dots">
        <img src="{{asset('assets/images/dots.svg')}}" alt="">
    </a>
    <ul class="dropdown-menu animate fadeIn">
        @can('edit-user')
        <li><a href="{{route("user.edit",$user->id)}}">{{__('admin.button.edit')}}</a></li>
        @endcan
        @can('delete-user')
        <li>
            <form method="POST"
              style="display: none"
              id="frmDelete-{{$user->id}}"
              action="{{ route('user.destroy' , $user->id) }}">
            {!! csrf_field() !!}
            {{ method_field('DELETE') }}
            <input type="submit" id="delete_{{$user->id}}">
        </form>
            <a href="{{ route('user.destroy' , $user->id) }}" data-href="{{$user->id}}" data-toggle="modal" data-target="#confirm-delete" class="dropdown-item delete_data">{{__('admin.button.delete')}}</a>
        </li>
            @endcan
    </ul>
</div>