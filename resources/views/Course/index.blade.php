@extends('layouts.app')

@section('content')
<h1>
   courses
</h1>
<table>
<thead>
    <tr>
    <th>Course</th>
    <th>Instructor</th>
    <th>CourseHead</th>
    </tr>
</thead>

<tbody>
      @foreach ($courses as $c )
    <tr>
      
            <td>{{ $c->title }}</td>&nbsp;
            <td>{{ $c->instructor }}</td>&nbsp;
            <td>{{ $c->coursehead }}</td>&nbsp;
    </tr>        @endforeach

</tbody>
</table>
@endsection