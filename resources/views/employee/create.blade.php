@extends('layouts.admin.app')

@push('head')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/min/dropzone.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endpush

@section('section_head')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">
            Employees
        </h1>
      </div>
    </div>
</div>
@endsection

@section('content')
    <div class="m-2 p-3 border" style="max-width: 600px">
        <h4>Employee add</h4>
        <form action="{{ route('employees.store')}}" method="POST" class="mb-6" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="photo" class="form-label">
                    Photo
                </label>
                <div>@error('photo') {{$message}} @enderror</div>
                <input
                    type="file"
                    class="form-control"
                    name="photo"
                />
                <div class="text-muted">File format jpg,png up to 5MB, the minimum size of 300x300px</div>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">
                    Name
                </label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name"
                    @if(old('name')) value="{{old('name')}}" @endif
                />
                <div class="d-flex justify-content-between">
                    <div>@error('name') {{$message}} @enderror</div>
                    <div class="text-muted">
                        <span id="length">0</span>/256
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">
                    Phone
                </label>
                <input
                    type="text"
                    class="form-control"
                    name="phone"
                    data-inputmask='"mask": "+380 (99) 999 99 99"'
                    data-mask
                    @if(old('phone')) value="{{old('phone')}}" @endif
                />
                <div class="d-flex justify-content-between">
                    <div>@error('phone') {{$message}} @enderror</div>
                    <div class="text-muted">Require format +380 (xx)xxx xx xx </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    Email
                </label>
                <input
                    type="text"
                    class="form-control"
                    name="email"
                    @if(old('email')) value="{{ old('email') }}" @endif
                />
                <div>@error('email') {{$message}} @enderror</div>
            </div>

            <div class="mb-3">
                <label for="position_id" class="form-label">
                    Position
                </label>
                <div>
                    <select class="form-select" aria-label="Default select example" name="position_id">
                       @foreach ($positions as $position)
                            <option value="{{$position->id}}" @if(old('position_id') == $position->id) selected @endif>{{$position->name}}</option>
                       @endforeach
                      </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">
                    Salary, $
                </label>
                <input
                    type="text"
                    class="form-control"
                    name="salary"
                    @if(old('salary')) value="{{ old('salary') }}" @endif
                />
                <div>@error('salary') {{$message}} @enderror</div>
            </div>

            <div class="mb-3">
                <label for="head" class="form-label">
                    Head
                </label>
                <input
                    type="text"
                    class="form-control"
                    name="head"
                    list="employees"
                    @if(old('head')) value="{{ old('head') }}" @endif
                />
                <datalist id="employees">
                    @foreach($employees as $employee)
                        <option value="{{$employee->name}}"></option>
                    @endforeach
                </datalist>
                <div>@error('head') {{$message}} @enderror</div>
            </div>


            <div class="form-group">
                <label for="employment_date">Date of employment</label>
                <div class="input-group date" id="employmentdate" data-target-input="nearest">
                    <input
                    type="text"
                    class="form-control datetimepicker-input"
                    data-target="#employmentdate"
                    name="employment_date"
                    @if(old('employment_date')) value="{{old('employment_date')}}" @endif
                    />

                    <div class="input-group-append" data-target="#employmentdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div>@error('employment_date') {{$message}} @enderror</div>
            </div>

            <div class="text-end">
                <a href="{{route('employees.index')}}" class="btn border">Cancel</a>
                <input type="submit" class="btn btn-success" value="save">
            </div>

        </form>
    </div>


@endsection

@push('scripts')
    <!-- InputMask -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('admin/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('admin/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(function () {
            $('#employmentdate').datetimepicker({
                format: 'DD.MM.YY'
            });

            $('[data-mask]').inputmask();

            $('.select2').select2();

         })

         $(document).ready(function() {
            var text = $('#name').val();
            $('#length').text(text.length);
            $('#name').on ('input', function() {
                var text = $('#name').val();
                $('#length').text(text.length);
            })
        })
    </script>
@endpush
