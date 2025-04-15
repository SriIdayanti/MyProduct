@extends('layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container mt-4"> <!-- Tambahkan margin atas -->
    <div class="row justify-content-center"> <!-- Gunakan justify-content-center untuk menengahkan -->
        <div class="col-md-8">
            <div class="card"> <!-- Ganti panel dengan card -->
                <div class="card-header">Dashboard</div> <!-- Ganti panel-heading dengan card-header -->
                <div class="card-body"> <!-- Ganti panel-body dengan card-body -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::check())
                        <p>Halo, {{ Auth::user()->name }}!</p>
                        You are logged in!
                    @endif
                </div>
                <!DOCTYPE html>
<html lang="en">
<head>
  

</body>
</html>

            </div>
        </div>
    </div>
</div>
@endsection
