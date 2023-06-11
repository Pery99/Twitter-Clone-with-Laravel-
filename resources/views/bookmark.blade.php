<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Bookmark' }}</title>
    <link rel="stylesheet" href="/css/bookmark.css">
</head>

<body>
    <div class="main_container">
        @extends('layouts.nav')

        @section('nav-link')

            <div class="second_side">
                <div class="s-container">
                    <h2>Bookmarks</h2>
                    @unless (count($tweets) == 0)
                        @foreach ($tweets as $tweet)
                            <a href="/tweet/{{ $tweet['id'] }}" id="content" style="text-decoration: none; color:black;">
                                <div class="view-tweet">
                                    <div class="info">
                                        <div class="prof">
                                            <img class="p-photo"
                                                src="{{ $tweet->user->profile->pphoto ? asset('storage/' . $tweet->user->profile->pphoto) : asset('images/default.jpeg') }}"
                                                alt="">
                                            <div class="id">
                                                <h3>{{ $tweet->user->name }}</h3>
                                                <p style="font-size: medium;">{{ '@' . $tweet->user->username }}</p>
                                                <h5>{{ $tweet->created_at }}</h5>
                                                <img class="menue" src="icon/three-dots.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="post">
                                            <br>
                                            <p style="font-weight: bold;">{{ $tweet->tweets }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($tweet->image == '')
                                    <p></p>
                                @else
                                    <div class="image-post">
                                        <img class="img-upload" src="/storage/{{ $tweet->image }}" alt="">
                                    </div>
                                @endif
                                <ul class="reactions">
                                    <li> <img class="l-react" src="icon/chat.svg" alt="">
                                        <p class="count">{{ count($tweet->comments) }}</p>
                                    </li>
                                    <li> <img class="l-react" src="icon/bookmark.svg" alt="">
                                        <p class="count">{{ count($tweet->bookmarks) }}</p>
                                    </li>
                                    <li> <img class="l-react" src="icon/heart.svg" alt="">
                                        <p class="count">{{ count($tweet->likes) }}</p>
                                    </li>
                                    <li> <img class="l-react" src="icon/repeat.svg" alt="">
                                        <p class="count">0</p>
                                    </li>
                                    <li> <img class="l-react" src="icon/upload.svg" alt=""></li>
                                </ul>
                            </a>
                        @endforeach
                    @else
                        <h1 style="display: flex; justify-content:center; align-items:center; margin-top:20px;">Nothing found
                        </h1>
                    @endunless
                </div>
            </div>

            <div class="third-container">
                <div class="th-container">
                    <div class="search-head">
                        <img class="search" src="icon/search.svg" alt="">
                        <form action="/bookmark">
                            <input class="search-inp" type="search" name="search" id=""
                                placeholder="Search Bookmark">
                        </form>
                    </div>

                    <div class="trending">
                        <h3>Trends for you</h3>
                        <div class="trend">
                            <div class="trending-cnt">
                                <div class="links">
                                    <p style="color: rgb(192, 190, 190);">News . Trending</p>
                                    <h4>BREAKING NEWS</h4>
                                    <p></p>
                                    <p style="color: rgb(192, 190, 190);">133k Tweets</p>
                                </div>
                                <div class="t-opt">
                                    <img src="icon/three-dots.svg" alt="">
                                </div>
                            </div>

                            <div class="trending-cnt">
                                <div class="links">
                                    <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                                    <h4>Aunty Esther</h4>
                                    <p></p>
                                    <p style="color: rgb(192, 190, 190);">3k Tweets</p>
                                </div>
                                <div class="t-opt">
                                    <img src="icon/three-dots.svg" alt="">
                                </div>
                            </div>

                            <div class="trending-cnt">
                                <div class="links">
                                    <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                                    <h4>Pery</h4>
                                    <p></p>
                                    <p style="color: rgb(192, 190, 190);">114k Tweets</p>
                                </div>
                                <div class="t-opt">
                                    <img src="icon/three-dots.svg" alt="">
                                </div>
                            </div>

                            <div class="trending-cnt">
                                <div class="links">
                                    <p style="color: rgb(192, 190, 190);">Trending in Nigeria</p>
                                    <h4>Tech</h4>
                                    <p></p>
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
    @endsection
</body>

</html>
