@extends('layouts.app')

@section('styles')

@endsection

@section('content')



@endsection

@section('scripts')

    <!-- INPUT MASK JS-->
    <script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>

    <!--Internal  jquery.maskedinput js -->
    <script src="{{asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>

    <!--Color Picker js-->
    <script src="{{asset('assets/plugins/colorpicker/pickr.es5.min.js')}}"></script>

    <!--Internal Color Picker js-->
    <script src="{{asset('assets/js/colorpicker.js')}}"></script>

    <!-- SELECT2 JS -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- FORM ELEMENTS JS -->
    <script src="{{asset('assets/js/form-elements.js')}}"></script>

@endsection
