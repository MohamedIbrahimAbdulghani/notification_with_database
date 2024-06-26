<x-app-layout>
    <x-slot name="header">
    <!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<style>
    body{
        background-color: #f1f1f1;
}
.nav-pills .nav-link.active, .nav-pills .show > .nav-link{
background-color: #17A2B8;
}
.dropdown-menu{
top: 60px;
right: 0px;
left: unset;
width: 460px;
box-shadow: 0px 5px 7px -1px #c1c1c1;
padding-bottom: 0px;
padding: 0px;
}
.dropdown-menu:before{
content: "";
position: absolute;
top: -20px;
right: 12px;
border:10px solid #343A40;
border-color: transparent transparent #343A40 transparent;
}
.head{
padding:5px 15px;
border-radius: 3px 3px 0px 0px;
}
.footer{
padding:5px 15px;
border-radius: 0px 0px 3px 3px;
}
.notification-box{
padding: 10px 0px;
}
.bg-gray{
background-color: #eee;
}
.title {
    display: block;
    color: black;
    font-weight: bold;
}
.title:hover {
    text-decoration: none;
    color: black;
}
@media (max-width: 640px) {
.dropdown-menu{
top: 50px;
left: -16px;
width: 290px;
}
.nav{
display: block;
}
.nav .nav-item,.nav .nav-item a{
padding-left: 0px;
}
.message{
font-size: 13px;
}

}
</style>
<body>
<div class="container">
<div class="row">
<div class="col-lg-10 col-sm-10 col-12 offset-lg-1 offset-sm-1">
<nav class="navbar navbar-expand-lg bg-info rounded">
<a class="navbar-brand text-light" href="#">{{auth()->user()->name}}</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: unset !important;">
<ul class="nav nav-pills mr-auto justify-content-end">
<li class="nav-item active">
<a class="nav-link text-light" href="#">Home <span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
<a class="nav-link text-light" href="{{route('posts.create')}}">Posts</a>
</li>
<li class="nav-item dropdown">
<a class="nav-link text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fa fa-bell"></i>
</a>
<ul class="dropdown-menu">
<li class="head text-light bg-dark">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<span>Notifications ( {{auth()->user()->unreadNotifications()->count()}} )</span>  <!-- this line to get number of notifications not read it -->
<a href="{{route('notification.read')}}" class="float-right text-light">Mark all as read</a>
</div>
</li>

    @foreach(auth()->user()->unreadNotifications as $notification)
        <li class="notification-box">
        <div class="row">
        <div class="col-lg-3 col-sm-3 col-3 text-center">
        <img src="/demo/man-profile.jpg" class="w-50 rounded-circle">
        </div>
        <div class="col-lg-8 col-sm-8 col-8">
        <strong class="text-info">{{$notification->data["user_name"]}}</strong>
        <a href="{{route('posts.show', $notification->data['post_id'])}}" class="title">{{$notification->data["post_title"]}}</a>
        <small class="text-warning">{{$notification->created_at}}</small>
        </div>
        </div>
        </li>
    @endforeach


<li class="footer bg-dark text-center">
<a href="" class="text-light">View All</a>
</li>
</ul>
</li>
</ul>
</div>
</nav>
</div>
</div>
</div>
</body>
</html>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
