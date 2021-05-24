<div class="dropdown actn-btn-dw">
    <a type="button" data-toggle="dropdown" class="dots">
        <img src="{{asset('assets/images/dots.svg')}}" alt="">
    </a>
    <ul class="dropdown-menu animate fadeIn">
        @can('edit-module')
        <li><a href="{{route("module.edit",$module->id)}}">{{__('admin.button.edit')}}</a></li>
        @endcan
    </ul>
</div>
