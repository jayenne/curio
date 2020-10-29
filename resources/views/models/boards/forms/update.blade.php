<form
    class="d-flex flex-column justify-content-center align-items-start"
    data-ajax="true"
    method="POST"
    action="{{ route('api.boards.create') }}"
    enctype="multipart/form-data"
    data-success="close-modal"
>
    @csrf
    <div class="modal-header overlayed d-flex justify-content-center align-items-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">@svg('icons/arrow-right', 'icon-sm')</span>
        </button>
        <h3 data-role="title" class="text-light">{{ __("Create a new board") }}</h3>
    </div>

    <div class="modal-body">
        <article id="board-create" class="modal-item" >

                <div class="dropbox uploader">
                    @include('models.boards.cover_upload')
                </div>

                <div class="card col-12 py-4">
                    <div class="card-body">
                        <div class="d-flex justify-conten-between">
                            <div class="col-6 pl-0 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="title" class="control-label">{{ __('Title') }}<sup>*</sup></label>
                                <input id="title" type="text" class="form-control" name="title" value="" required>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                             <div class="col-6 pr-0">
                                <label for="status" class="control-label">{{ __('Visibility') }}</label>
                                <select class="custom-select" name="status" id="status">
                                    <option value="private" selected>Private</option>
                                    <option value="subscriber">Subscriber</option>
                                    <option value="public">Public</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">{{ __('Introduction') }}</label>
                            <textarea id="body" type="text" rows="5" maxlength="1024" class="form-control" name="body" ></textarea>
                            <small class="form-text text-muted">{{ __("Write a short description for others to know about this board.") }}</small>
                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                </div>

               
            
        </article>
    </div>

    <div class="modal-footer fixed-bottom ">
        <div class="col-4 overlayed d-flex justify-content-center align-items-center">
            <div class="form-group">
                <button type="submit" class="btn btn-outline-light">
                    {{ __("Create this board") }}
                </button>
            </div>
        </div>
    </div>
</form>