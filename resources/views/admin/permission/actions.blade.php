<div class="dropdown actn-btn-dw">
    <a type="button" data-toggle="dropdown" class="dots">
        <img src="{{asset('assets/images/dots.svg')}}" alt="">
    </a>
    <ul class="dropdown-menu animate fadeIn">
        @can('edit-permission')
        <li></li><a href="{{route("permission.edit",$permission->id)}}">{{__('admin.button.edit')}}</a></li>
        @endcan

        @can('delete-permission')
        <li>
            <form method="POST"
              style="display: none"
              id="frmDelete-{{$permission->id}}"
              action="{{ route('permission.destroy' , $permission->id) }}">
            {!! csrf_field() !!}
            {{ method_field('DELETE') }}
            <input type="submit" id="delete_{{$permission->id}}">
        </form>
            <a href="{{ route('permission.destroy' , $permission->id) }}" data-href="{{$permission->id}}" data-toggle="modal" data-target="#confirm-delete" class="dropdown-item delete_data">{{__('admin.button.delete')}}</a>
        </li>
        @endcan
    </ul>
</div>