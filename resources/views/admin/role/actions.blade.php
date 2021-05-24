<div class="dropdown actn-btn-dw">
    <a type="button" data-toggle="dropdown" class="dots">
        <img src="{{asset('assets/images/dots.svg')}}" alt="">
    </a>
    <ul class="dropdown-menu animate fadeIn">
        @can('edit-role')
        <li><a href="{{route("role.edit",$role->id)}}">{{__('admin.label.edit')}}</a></li>
        @endcan

        @can('delete-role')
        <li>
        <form method="POST"
              style="display: none"
              id="frmDelete-{{$role->id}}"
              action="{{ route('role.destroy' , $role->id) }}">
            {!! csrf_field() !!}
            {{ method_field('DELETE') }}
            <input type="submit" id="delete_{{$role->id}}">
        </form>
        <a href="{{ route('role.destroy' , $role->id) }}" data-href="{{$role->id}}" data-toggle="modal" data-target="#confirm-delete" class="dropdown-item delete_data">{{__('admin.button.delete')}}</a>
        </li>
        @endcan
    </ul>
</div>
