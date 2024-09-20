@extends('layouts2.app')
@section('content')

    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url('{{asset('website/img/bg-img/breadcumb3.jpg')}}');">
        <div class="bradcumbContent">
            <p>See what’s new</p>
            <h2>Register</h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <section class="Register-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="Register-content">
                        <h3>Welcome Back</h3>
                        <!-- Login Form -->
                        <div class="Register-form">
                            <form action="{{route('register')}}" method="post"  >
                                @csrf
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control" id="" aria-describedby="" placeholder="NAME" name="name" required>
                                    <small id="" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your name with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter E-mail"  name="email" required>
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="" placeholder="Password"  name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password">
                                </div>
                                <button type="submit" class="btn oneMusic-btn mt-30">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Login Area End ##### -->


@endsection
