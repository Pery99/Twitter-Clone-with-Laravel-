<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>My Profile</title>
        <link rel="stylesheet" href="/css/profile.css">
    </head>
    <body>
       <div class="main_container">
        @extends('layouts.nav')

        @section('nav-link')
        {{-- div of the second side --}}
        <div class="second_side">
            @if (session()->has('message'))

            <div class="message-div" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            <p class="message">
                {{session('message')}}
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
                @if ($user->tweets->count() < 1)
                <p style="font-size: small">0 Tweet</p>   
                @else   
                <p style="font-size: small">{{$user->tweets->count()}} Tweets</p>
                @endif
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
                @if ($user->followers->count() >= 3)
                <h2>{{$user->name}}&check;</h2>
                    @else
                     <h2>{{$user->name}}</h2>
                @endif
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
                <h4 class="tablinks active" onclick="slide(event, 'tweet')" id="defaultOpen">Tweets</h4>
                <h4 class="tablinks" onclick="slide(event, 'tweetAndReply')">Tweets & replies ({{count($comments)}})</h4>
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
                                @if ($tweet->user->followers->count() >= 3)
                                 <h3>{{$tweet->user->name}}&check;</h3><p style="font-size:small;">{{'@'. $tweet->user->username}}</p><h5>{{$tweet->created_at}}</h5>
                                @else
                                   <h3>{{$tweet->user->name}}</h3><p style="font-size:small;">{{'@'. $tweet->user->username}}</p><h5>{{$tweet->created_at}}</h5>
                            @endif
                            <img onclick="menue('id{{$id}}')" class="menue" src="icon/three-dots.svg" alt="">
                        </div>
                        <form class="men-ue" id="" action="/delete/{{$tweet->id}}"> 
                            <button class="menue-li">Delete Post</button>
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
                <img class="l-react" src="icon/chat.svg" alt="">
                <p class="count">{{ count($tweet->comments) }}</p>
        </a>
        <form action="/bookmark" method="POST">
            @csrf
            <input type="hidden" name="tweet_id" id="" value="{{ $tweet->id }}">
            <button style="background:none; border:none" type="submit">
                <img class="l-react bookmark-js" src="/icon/bookmark.svg" alt="">
                <p class="count">{{ count($tweet->bookmarks) }}</p>
            </button>
        </form>
        @if (DB::table('likes')->where('tweet_id', $tweet->id)->where('user_id', auth()->user()->id)->first())
        <form action="/like" method="POST">
            @csrf
            <input type="hidden" name="tweet_id" id=""
                value="{{ $tweet->id }}">
            <button style="background:none; border:none" type="submit">
                <img style="width: 30px; cursor:pointer; vertical-align: middle"
                src="/icon/2855967.png" alt="">
                <p class="count">{{ $tweet->likes->count() }}</p>
            </button>
        </form>
        @else
            <form action="/like" method="POST">
                @csrf
                <input type="hidden" name="tweet_id" id=""
                    value="{{ $tweet->id }}">
                <button style="background:none; border:none" type="submit">
                    <img class="l-react" src="/icon/heart.svg" alt="">
                    <p class="count">{{ $tweet->likes->count() }}</p>
                </button>
            </form>
        @endif
        <li> <img class="l-react" src="/icon/repeat.svg" alt="">
            <p class="count">0</p>
        </li>
        <li> <img class="l-react" src="icon/upload.svg" alt=""></li>
</ul>
        
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
                             @if ($user->followers->count() >= 3)
                                 <h3>{{$user->name}}&check;</h3><p style="font-size:small;">{{'@'. $user->username}}</p><h5>{{$comment->created_at}}</h5>
                                @else
                                   <h3>{{$user->name}}</h3><p style="font-size:small;">{{'@'. $user->username}}</p><h5>{{$comment->created_at}}</h5>
                            @endif
                            {{-- <h3>{{$user->name}}</h3><p style="font-size: large;">{{'@'. $user->username}}</p><h5>{{$comment->created_at}}</h5> --}}
                            <img onclick="menue('id{{$id}}')" class="menue" src="icon/three-dots.svg" alt="">
                        </div>
                        <form class="men-ue" id="" action="/comment/delete/{{$comment->id}}">
                            <button class="menue-li">Delete Post</button>
                        </form>
                    </div>
                
                         <div class="post">
                        <br>
                       {{-- <p style="color:gray">replying to <span style="color:rebeccapurple; cursor:pointer"> {{'@'. $tweet->user->username}}</span></p> --}}
                        <p style="font-weight: bold;">{{$comment->comment}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <h1 style="display: flex; justify-content:center; align-items:center; margin-top:20px;">No Comments made</h1>
            @endunless
           </div>
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
<div class="main-edit">
    <div class="edit-profile">
        <p style="cursor: pointer; font-size: 30px; width: 3%; margin-left: 90%; margin-bottom:8%" onclick="exit()">&times</p>
        <form action="/profile" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <p style="display: inline-block">Update Profle Photo</p>
            <label class="profile-photo-label" for="pphoto"><img src="/icon/upload.svg" alt=""></label>
            <input style="display: none" class="edit" type="file" name="pphoto" id="pphoto" >
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
</div>
<div class="photo-display">
    <p style="cursor: pointer; font-size: 30px; width: 3%; margin-left: 90%; margin-bottom:6%" onclick="exitPhoto()">&times</p>
    <img class="big-photo" src="{{auth()->user()->profile->pphoto ? asset('storage/' . auth()->user()->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
</div>
   
    <script src="profile.js"></script>
</html>