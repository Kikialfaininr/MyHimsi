@extends('layouts.app-pdf')

@section('content')
    <div class="content">
        <h1>DATA LOGIN ANGGOTA</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $no => $value)
                <tr>
                    <td align="center">{{$no+1}}</td>
                    <td>{{$value->anggota->full_name}}</td>
                    <td>{{$value->name}}</td> 
                    <td>{{$value->email}}</td> 
                    <td>12345</td>  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
