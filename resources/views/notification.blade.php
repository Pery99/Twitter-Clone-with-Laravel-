<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Activities' }}</title>
    <link rel="stylesheet" href="/css/activity.css">
</head>

<body>
    <div class="main_container">
        @extends('layouts.nav')

        @section('nav-link')

            <div class="second-side">
                <h2>These are your recent activities</h2>
                <div class="content">
                    @unless ($notifications->count() === 0)
                        @foreach ($notifications as $notification)
                            <div class="activity">
                               <ul class="act-ul">
                                <li class="list">
                                  <p class="data">{{ $notification->data }}</p> 
                                </li>
                                <p class="timestamp">{{$notification->created_at}}</p>
                               </ul>
                            </div>
                        @endforeach
                    @else
                        <h3>NO ACTIVITY</h3>
                    @endunless
                </div>
            </div>
        </div>
    @endsection
</body>

</html>
