<div class="modal fade" id="company-modal-lg">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <form id="companyForm" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <h4 class="modal-title">{{__('form.company_label_title_edit')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="id" class="form-control" id="companyId" required>
                            </div>
                            <div class="form-group" id="logoPicture">
                            </div>
                            <div class="form-group">
                                <label for="companyInputName">{{__('form.company_label_name')}}</label>
                                <input type="text" name="name" class="form-control" id="companyInputName">
                            </div>
                            <div class="form-group">
                                <label for="companyInputEmail">{{__('form.company_label_email')}}</label>
                                <input type="email" name="email" class="form-control" id="companyInputEmail">
                            </div>
                            <div class="form-group">
                                <label for="companyInputWebsite">{{__('form.company_label_website')}}</label>
                                <input type="text" name="website" class="form-control" id="companyInputWebsite">
                            </div>
                            <div class="form-group">
                                <label for="companyInputLogo">{{__('form.company_label_logo')}}</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="custom-file-input" id="companyInputLogo" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);">
                                        <label class="custom-file-label" for="exampleInputFile">{{__('form.choose_file')}}</label>
                                    </div><!--
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>-->
                                </div>
                            </div>
                            <div class="form-group">
                                <img id="uploadedPicture" src="{{asset('images/web/noimages.png')}}" alt="logo" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onClick="$('#company-modal-lg').hide();">{{__('form.cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('form.save_changes')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>