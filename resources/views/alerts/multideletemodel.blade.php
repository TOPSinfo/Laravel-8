<div class="modal modal-danger fade" tabindex="-1" id="bulk_delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <div col-md-12>
                    <h4 class="modal-title">
                        <i class="voyager-trash"></i> <span style="color:#fff">  {{__('admin.message.multiple_delete_confirm')}} <span id="bulk_delete_count"></span> <span id="bulk_delete_display_name"></span>?</span>
                    </h4>
                </div>

            </div>
            <div class="modal-body" id="bulk_delete_modal_body">
            </div>
            <div class="modal-footer">
                <form action="{{route($redirectTo)}}" id="bulk_delete_form" method="POST">
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="ids" id="bulk_delete_input" value="">
                    <input type="submit" class="btn btn-danger pull-right delete-confirm"
                           value="{{__('admin.message.multiple_delete')}}">
                </form>
                <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>