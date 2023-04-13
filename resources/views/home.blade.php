<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{'Home'}}</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
   
    {{-- Div of the whole body --}}
    <div class="main_container">

        {{-- div of the first side --}}
        
        @extends('layouts.nav')
        
        @section('nav-link')
        
        {{-- div of the second side containing the tweet section e.t.c --}}
        <div class="second_side">
            <div class="s-container">
                @if (session()->has('sucess'))

                <div class="message-div" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                <p class="message">
                    {{session('sucess')}}
                </p>
                </div>
                @endif
                <h3 style="padding: 2px 8px;">Home</h3>
                <div class="cnt-body">
                    {{-- Header --}}
                    <div class="header-container">
                        <div class="header">
                            <a href="#" style="color: #1DA1F2">For you</a>
                            <a href="#">Following</a>
                        </div>
                    </div>
                    {{-- Div of the section to post tweet --}}
                    <div class="post-tweet-container">
                        <div class="post-tweet">
                            <img class="p-photo" src="{{auth()->user()->profile->pphoto ? asset('storage/' . auth()->user()->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
                            <div class="textarea-forpost">
                                <form action="/" method="POST" enctype="multipart/form-data">
                                    @csrf
                        <input class="inp" type="text" name="tweets" id="" placeholder="What's happening?">
                        @error('tweets')
                           <p style="font-size: small; color:red">{{$message}}</p> 
                        @enderror
                        <br>
                        {{-- <img class="lol" src="icon/image.svg" alt=""> --}}
                        <label style="cursor: pointer" for="image"><img src="/icon/image.svg" alt=""></label>
                        <input style="display: none;" type="file" name="image" id="image">
                        @error('image')
                        <p style="font-size: small; color:red">{{$message}}</p> 
                     @enderror
                        {{-- <img class="lol" src="icon/filetype-gif.svg" alt="">
                        <img class="lol" src="icon/list-ul.svg" alt="">
                        <img class="lol" src="icon/emoji-smile.svg" alt="">
                        <img class="lol" src="icon/geo-alt.svg" alt=""> --}}
                    </div>
                        <button class="send-tweet" type="submit">Tweet</button>
                    </div>
                </form>
                </div>
                {{-- Div of the section where posts are viewed --}}
                @unless (count($tweets) == 0)
                @foreach ($tweets as $tweet) 
                
               
              
                <a href="/tweet/{{$tweet['id']}}"  id="content" style="text-decoration: none; color:black;">    
                <div class="view-tweet">
                    <div class="info">
                        <div class="prof">
                           <img class="p-photo" src="{{$tweet->user->profile->pphoto ? asset('storage/' . $tweet->user->profile->pphoto) : asset('images/default.jpeg')}}" alt="">
                            <div class="id">
                                <h3>{{$tweet->user->name}}</h3><p style="font-size: medium;">{{'@'. $tweet->user->username}}</p><h5>{{$tweet->created_at}}</h5>
                                <img class="menue" src="icon/three-dots.svg" alt="">
                            </div>
                        </div>
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
        </a>
            <ul class="reactions">
                <li> <img class="l-react" src="icon/chat.svg" alt=""> 0</li>
                <li> <img class="l-react" src="icon/repeat.svg" alt="">0 </li>
                <li> <img class="l-react" src="icon/heart.svg" alt=""> 0</li>
                <li> <img class="l-react" src="icon/bar-chart.svg" alt=""> 0</li>
                <li> <img class="l-react" src="icon/upload.svg" alt=""></li>
            </ul>
            @endforeach
            @else
            <h1 style="display: flex; justify-content:center; align-items:center; margin-top:20px;">No tweets Found</h1>
                @endunless
            </div>
        </div>
    </div> 
           {{-- Div containing the search and the trending post --}}
           <div class="third-container">
            <div class="th-container">
                <div class="search-head">
                    <img class="search" src="icon/search.svg" alt="" > 
                <form action="/home">
                    <input class="search-inp" type="search" name="search" id="" placeholder="Search Tweets">
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
                <a href="#" style="text-decoration: none;">See more</a>
            </div>
        </div>
    </div>
            {{-- Div containing the others like suggestions --}}
            <footer>
                <div class="footer-cnt">
                <p>Terms</p>
                <p>Privacy</p>
                <p>Ads info</p>
                <p>More</p>
            </div>
                <p>&copy;Qudriod Coding Academy 2023</p>
            </footer>
           
            </div>  
        </div>
    </div>
</body>
@endsection

<script src="//unpkg.com/alpinejs" defer></script>
</html>