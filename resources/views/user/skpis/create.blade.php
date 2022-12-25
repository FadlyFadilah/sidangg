@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Buat Skpi
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("user.skpis.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        
                        <div class="form-group">
                            <label class="required" for="kualifikasi">Nama Kegiatan (Bahasa Indonesia)</label>
                            <textarea class="form-control" type="text" name="kualifikasi" id="kualifikasi" required></textarea>
                            @if($errors->has('kualifikasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kualifikasi') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="kegiatan">Nama Kegiatan (Bahasa Inggris)</label>
                            <textarea class="form-control" type="text" name="kegiatan" id="kegiatan" value="{{ old('kegiatan', '') }}" required></textarea>
                            @if($errors->has('kegiatan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kegiatan') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <div class="needsclick dropzone" id="file-dropzone">
                            </div>
                            @if($errors->has('file'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedFileMap = {}
Dropzone.options.fileDropzone = {
    url: '{{ route('user.skpis.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
      uploadedFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileMap[file.name]
      }
      $('form').find('input[name="file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($skpi) && $skpi->file)
          var files =
            {!! json_encode($skpi->file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection