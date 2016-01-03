@if(\Auth::user()->prof_pic->image != null)
<img src="{{ asset('uploads/'.\Auth::user()->prof_pic->image)}}" alt="prof pic" height="20" width="20">
@else
<img src="{{ asset('uploads/default.png')}}" alt="prof pic" height="20" width="20">
@endif