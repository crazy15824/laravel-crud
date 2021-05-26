@extends('layouts.app')

@section('dashboard')
<div class="row">
    <div class="col-6">
        <ul id="dashboard_number">
            <li>
                Number of Swipes: {{$numberofswipes->count()}}
            </li>
            <li>
                Number of Templates: {{$numberoftemplates->count()}}
            </li>
            <li>
                Number of Fields: {{$numberoffields->count()}}
            </li>
        </ul> 
    </div>
</div>
@endsection