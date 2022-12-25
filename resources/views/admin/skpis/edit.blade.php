@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ubah Skpi
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.skpis.update", [$skpi->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <label class="required" for="nama_id">Npm</label>
                            <select class="form-control select2" name="nama_id" id="nama_id" required>
                                @foreach($namas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('nama_id') ? old('nama_id') : $skpi->nama->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('nama'))
                                <span class="help-block" role="alert">{{ $errors->first('nama') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('kualifikasi') ? 'has-error' : '' }}">
                            <label class="required" for="kualifikasi">Nama Kegiatan (Bahasa Indonesia)</label>
                            <textarea class="form-control" type="text" name="kualifikasi" id="kualifikasi" value="{{ old('kualifikasi', $skpi->kualifikasi) }}" required></textarea>
                            @if($errors->has('kualifikasi'))
                                <span class="help-block" role="alert">{{ $errors->first('kualifikasi') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('kegiatan') ? 'has-error' : '' }}">
                            <label class="required" for="kegiatan">Nama Kegiatan (Bahasa Inggris)</label>
                            <textarea class="form-control" type="text" name="kegiatan" id="kegiatan" value="{{ old('kegiatan', $skpi->kegiatan) }}" required></textarea>
                            @if($errors->has('kegiatan'))
                                <span class="help-block" role="alert">{{ $errors->first('kegiatan') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                            <label for="file">File</label>
                            <div class="needsclick dropzone" id="file-dropzone">
                            </div>
                            @if($errors->has('file'))
                                <span class="help-block" role="alert">{{ $errors->first('file') }}</span>
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
    url: '{{ route('admin.skpis.storeMedia') }}',
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