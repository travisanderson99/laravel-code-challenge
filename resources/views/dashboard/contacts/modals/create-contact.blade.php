@extends('layouts.modal')

@section('content')

<div class="modal fade create-contact" id="modal-block-popin" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-popin modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">New Contact</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    Create form here
                </div>
            </div>
        </div>
    </div>
</div>

@endsection