<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$user->username}}</title>
        <link rel="stylesheet" href="/css/profile.css">
    </head>
    <body>
       <div class="main_container">
        @extends('layouts.nav')

        @section('nav-link')
        {{-- div of the second side --}}
        <div class="second_side">
            @if (session()->has('done'))

            <div class="message-div" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            <p class="message">
                {{session('done')}}
            </p>
            </div>
            @endif
            {{-- div containing the back button... --}}
           <div class="s-head">
            <div class="s-head-icon">
                <a href="/"><img src="icon/arrow-left.svg" alt=""></a>
            </div>
            <div class="s-head-txt">
                <h3>{{$user->username}}</h3>
                <p style="font-size: small">{{$user->tweets->count()}} Tweets</p>
                </div>
           </div>

           <div class="cover-photo">
                {{-- Add an image here later --}}
           </div>
           
           <div class="profile-picture">
            <div class="pp-cnt">
                <img onclick="showPhoto()" class="profile-photo" src="{{auth()->user()->profile->pphoto ? asset('storage/' . auth()->user()->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
                <button onclick="edit()" class="button">Edit Profile</button>
            </div>
           </div>
           <div class="rest">
             <div class="profile-details">
                <h2>{{$user->name}}</h2>
                <p class="whitesmoke">{{'@' . $user->username}}</p>
                <br>
                <p class="bio">{{$user->profile->bio}}</p>
                <p>{{$user->email}}</p>
               <div class="joined"><img class="calender" src="icon/calendar3.svg" alt=""><p class="whitesmoke">{{'Joined ' . auth()->user()->created_at}}</p></div>
                <div class="followers">
                    <p class="whitesmoke"><span style="color:black; font-weight:bold;">{{$user->following->count()}} </span>Following</p>
                    <p class="whitesmoke"><span style="color:black; font-weight:bold;">{{$user->followers->count()}} </span>Followers</p>
                </div>
           </div>
           <div class="sections">
                <div class="sec-cnt">
                <h4 class="tablinks" onclick="slide(event, 'tweet')" id="defaultOpen">Tweets</h4>
                <h4 class="tablinks" onclick="slide(event, 'tweetAndReply')">Tweets & replies</h4>
                <h4 class="tablinks" onclick="slide(event, 'media')">Media</h4>
                <h4>Likes</h4>
                </div>
           </div>  
           <div class="tweetss" id="tweet">
            @unless (count($tweets) == 0)
            @foreach ($tweets as $tweet) 
            @php 
            $id = rand();
            @endphp   
            <div id = "id{{$id}}" class="view-tweet">
                <div class="info">
                    <div class="prof">
                        <img class="p-photo" src="{{auth()->user()->profile->pphoto ? asset('storage/' . auth()->user()->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
                        <div class="id">
                            <h3>{{$user->name}}</h3><p style="font-size: large;">{{'@'. $user->username}}</p><h5>{{$tweet->created_at}}</h5>
                            <img onclick="menue('id{{$id}}')" class="menue" src="icon/three-dots.svg" alt="">
                        </div>
                        <form class="men-ue" id="" action="{{""}}">
                            <button class="menue-li">Pin Post</button>
                            <button class="menue-li">Delete Post</button>
                            <button class="menue-li">Edit Post</button>
                        </form>
                    </div>
                   
                    <a style="text-decoration: none; color:black" href="/tweet/{{$tweet['id']}}">
                         <div class="post">
                        <br>
                        <p style="font-weight: bold;">{{$tweet->tweets}}</p>
                    </div>
                </div>
            </div>
            @if ($tweet->image == '')
            <p></p>
            @else
            <div class="image-post">
                <img class="img-upload" src="/storage/{{$tweet->image}}" alt="">
            </div>
            @endif
            <ul class="reactions">
                <li> <img class="l-react" src="/icon/chat.svg" alt="">{{count($tweet->comments)}}</li>
                <li> <img class="l-react" src="/icon/repeat.svg" alt="">0</li>
                <li> <img class="l-react" src="/icon/heart.svg" alt="">0</li>
                <li> <img class="l-react" src="/icon/bar-chart.svg" alt="">0</li>
                <li> <img class="l-react" src="/icon/upload.svg" alt=""></li>
            </ul>
        </a>
            @endforeach
        @else
        <h1 style="display: flex; justify-content:center; align-items:center; margin-top:20px;">No tweets found</h1>
            @endunless
           </div>

           <div class="tweetss" id="tweetAndReply" style="display: none;">
            @unless (count($comments) == 0)
            @foreach ($comments as $comment) 
            @php 
            $id = rand();
            @endphp   
            <div id = "id{{$id}}" class="view-tweet">
                <div class="info">
                    <div class="prof">
                        <img class="p-photo" src="{{auth()->user()->profile->pphoto ? asset('storage/' . auth()->user()->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
                        <div class="id">
                            <h3>{{$user->name}}</h3><p style="font-size: large;">{{'@'. $user->username}}</p><h5>{{$comment->created_at}}</h5>
                            <img onclick="menue('id{{$id}}')" class="menue" src="icon/three-dots.svg" alt="">
                        </div>
                        <form class="men-ue" id="" action="{{""}}">
                            <button class="menue-li">Pin Post</button>
                            <button class="menue-li">Delete Post</button>
                            <button class="menue-li">Edit Post</button>
                        </form>
                    </div>
                
                         <div class="post">
                        <br>
                           <p style="color:gray">replying to <span style="color:rebeccapurple; cursor:pointer"> {{'@'. $comment->user->username}}</span></p>
                        <p style="font-weight: bold;">{{$comment->comment}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <h1 style="display: flex; justify-content:center; align-items:center; margin-top:20px;">No Comments made</h1>
            @endunless
           </div>

           <div class="all-img" id="media">
            @unless (count($tweets) == 0)
            @foreach ($tweets as $tweet)  
            <img class="all-img-upload" src="/storage/{{$tweet->image}}" alt="">
            @endforeach
            @else
            <h1 style="text-align: center; margin-top:20px">No image yet..</h1>
            @endunless
        </div>
           {{-- End... --}}
           </div>
        </div>

        

        {{-- div of the last container --}}
        <div class="third-container">
            <div class="th-container">
                <div class="search-head">
                    <img class="search" src="icon/search.svg" alt=""> 
                <form action="/profile">
                    <input class="search" type="search" name="search" id="" placeholder="Search your tweets">
                </form>
            </div>
           
            <div class="trending">
                <h3>Trends for you</h3>
                <div class="trend">
                    <div class="trending-cnt">
                        <div class="links">
                        <p style="color: rgb(192, 190, 190);">News . Trending</p>
                        <h4>BREAKING NEWS</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">133k Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>
                
                <div class="trending-cnt">
                    <div class="links">
                        <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                        <h4>Aunty Esther</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">3k Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>

                <div class="trending-cnt">
                    <div class="links">
                        <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                        <h4>Pery</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">114k Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>

                <div class="trending-cnt">
                    <div class="links">
                        <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                        <h4>Tech</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">206M Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>

                <div class="trending-cnt">
                    <div class="links">
                        <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                        <h4>Buhari</h4><p></p>
                        <p style="color: rgb(192, 190, 190);">133M Tweets</p>
                    </div>
                    <div class="t-opt">
                        <img src="icon/three-dots.svg" alt="">
                    </div>
                </div>
                <a href="#" style="text-decoration: none;">See more</a>
            </div>
        </div>
    </div>
            {{-- Div containing the others like suggestions --}}
             
        </div>
       </div>
    </body>
    @endsection
<div class="edit-profile">
    <p style="cursor: pointer; font-size: 30px; width: 3%; margin-left: 90%; margin-bottom:8%" onclick="exit()">&times</p>
    <form action="/profile" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <label for="">Update profile photo</label><br>
        <input class="edit" type="file" name="pphoto" id="" >
        @error('pphoto')
            <p style="font-size: small">{{$message}}</p>
        @enderror
        <br><br>
        <input class="edit" type="text" name="bio" id="" placeholder="Bio" value="{{$user->profile->bio}}">
        @error('bio')
            <p style="font-size: small">{{$message}}</p>
        @enderror
        <br><br>
        <button class="edit-submit" type="submit">Save Changes</button>
    </form>
</div>
<div class="photo-display">
    <p style="cursor: pointer; font-size: 30px; width: 3%; margin-left: 90%; margin-bottom:6%" onclick="exitPhoto()">&times</p>
    <img class="big-photo" src="{{auth()->user()->profile->pphoto ? asset('storage/' . auth()->user()->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
</div>
    <script>
        function menue(id) {
            var post = document.getElementById(id);
            var first = post.querySelector('.men-ue');
            first.classList.toggle("men-ue1");
        }


    function edit() {
        document.querySelector('.edit-profile').style.display = 'block';
        document.querySelector('.second_side').style.filter = 'blur(5px)';
    }

    function exit() {
        document.querySelector('.edit-profile').style.display = 'none';
         document.querySelector('.second_side').style.filter = 'none';
    }
    function showPhoto() {
        document.querySelector('.photo-display').style.display = 'block';
        document.querySelector('.second_side').style.filter = 'blur(5px)';
    }

    function exitPhoto() {
        document.querySelector('.photo-display').style.display = 'none';
         document.querySelector('.second_side').style.filter = 'none';
    }
     

    </script>
    <script src="slide.js"></script>
</html>