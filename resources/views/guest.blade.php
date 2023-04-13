<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{'Home'}}</title>
    <link rel="stylesheet" href="css/guest.css">
</head>
<body>
   
    {{-- Div of the whole body --}}
    <div class="main_container">

        {{-- div of the first side --}}
        
        <style>
           
            
            </style>
            <div class="first_side">
                <div class="cnt">
                    {{-- Nav links of the first side --}}
                    <ul class="nav">
                        <a href=""><div class="logo"><img class="tw-icon" src="/icon/twitter.svg" alt=""></div></a>
                        <a href="/login" class="tweet">Login</a>
                    </ul>
                    {{-- Div of the profile shortcut at the bottom left --}}
                    <div class="profile-container">
                        <form class="l-out"  id="logout" action="{{"logout"}}"><button class="log-out">Log out </button></form>
                        <div class="profile">
                            <div class="profile-cnt">
                                <div class="text">
                                </div>
                            </div>
                            <div class="opt">
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            
            
        {{-- div of the second side containing the tweet section e.t.c --}}
        <div class="second_side">
            <div class="s-container">
               
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
                            <div class="textarea-forpost">
                               
                    </div>
                       
                    </div>
                </form>
                </div>
                {{-- Div of the section where posts are viewed --}}

                
               
              
                <div class="view-tweet">
                    <div class="info">
                        <div class="prof">
                            <div class="id">
                            </div>
                        </div>
                        <div class="post">
                            <br>
                            <p style="font-weight: bold;">Login to view tweets</p>
                            <br>
                            <form action="/login">
                                <button class="tweet">Login</button>
                            </form>
                        </div>
                </div>
            </div>
           

            <ul class="reactions">
               
            </ul>
            </div>
        </div>
    </div> 
           {{-- Div containing the search and the trending post --}}
           <div class="third-container">
            <div class="th-container">
                <div class="search-head">
                    <img class="search" src="icon/search.svg" alt="" > 
                <form action="/">
                    <input class="search-inp" type="search" name="search" id="" placeholder="Search Tweets">
                </form>
            </div>
            
            <div class="trending">
                <h3>Trends for you</h3>
                <div class="trend">
                   <a href="/login" class="tweet">Login</a>
                
                


               

            
        </div>
    </div>
            {{-- Div containing the others like suggestions --}}
             
        </div>
    </div>
</body>
</html>