<div class="dropdown actn-btn-dw">
    <a type="button" data-toggle="dropdown" class="dots">
        <img src="{{asset('assets/images/dots.svg')}}" alt="">
    </a>
    <ul class="dropdown-menu animate fadeIn">
        @can('edit-cms')
        <li><a href="{{route("cms.edit",$cmsPage->id)}}">{{__('admin.button.edit')}}</a></li>
        @endcan
        @can('delete-cms')
        <li>
            <form method="POST"
              style="display: none"
              id="frmDelete-{{$cmsPage->id}}"
              action="{{ route('cms.destroy' , $cmsPage->id) }}">
            {!! csrf_field() !!}
            {{ method_field('DELETE') }}
            <input type="submit" id="delete_{{$cmsPage->id}}">
        </form>
            <a href="{{ route('cms.destroy' , $cmsPage->id) }}" data-href="{{$cmsPage->id}}" data-toggle="modal" data-target="#confirm-delete" class="dropdown-item delete_data">{{__('admin.button.delete')}}</a>
        </li>
            @endcan
    </ul>
</div>