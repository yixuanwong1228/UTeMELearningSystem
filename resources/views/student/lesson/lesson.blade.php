@extends('layouts.studentview')



@section('content')
<link rel="stylesheet" href="{{url('css/student/search_course.css')}}">
<style>
    .table-cell {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

</style>

<<<<<<< HEAD
<h3> BITM 2113 WEB APPLICATION DEVELOPMENT </h3>
=======

<h3>{{ session('course')->name }}</h3>
>>>>>>> bf6d6d4d439c2e60aba3b14dd71473805f9b40d0
<i class="fa-solid fa-volume-high"></i> ANNOUNCEMENT
@foreach($announcements as $announcement)
    <p> {{ $announcement->created_at->format('d M Y') }}  - {{ $announcement->details }}</p>
@endforeach


<div class="card-container">
    @foreach ($lessons as $lesson)

    <div class="card">
        <img src="{{ asset('images/lessons/' . $lesson->attribute) }}" class="card-img-top" alt="Lesson Image">
        <div class="card-body">
            <h5 class="card-title">{{ $lesson->title }}</h5>
            <p class="card-text">{{ $lesson->description }}</p>
            <a href="{{ route('student.lesson_detail',['id' => $lesson->id]) }}" class="btn-details">Details</a>
        </div>
<<<<<<< HEAD
=======
    </div>
    @endforeach
>>>>>>> bf6d6d4d439c2e60aba3b14dd71473805f9b40d0
</div>
@endsection