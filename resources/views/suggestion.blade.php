<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Follow</title>
    <style>
.others{
    background-color: whitesmoke;
    border-radius: 15px;
    margin: 10px;
    padding: 5px 20px;
    text-align: start;
    width: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%)
}
.follow{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 12px 0;
}
.follow-id{
    display: flex;
    align-items: center;
    gap: 10px;
}
.follow-btn{
    color: white;
    background-color: black;
    border: none;
    padding: 8px 16px;
    border-radius: 30px;
    font-weight: bold;
}
.f-text{
  display: flex;
  gap: 10px;
  align-items: center;

}
.p-photo{
    width: 50px;
    height: 50px;
    border-radius: 25px;
}
.message-div{
   position: absolute;
    left: 50%;
    top: 3%;
    width: 50%;
    transform: translate(-50%, -50%);
    background-color: #1DA1F2;
    color: white;
    padding: 15px;
    z-index: 999;
    text-align: center;
}
@media screen and (max-width: 900px) and (min-width: 500px) {
    .others{
    background-color: whitesmoke;
    border-radius: 15px;
    margin: 10px;
    padding: 10px 30px;
    text-align: start;
    width: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.follow{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 12px 0;
}
.follow-id{
    display: flex;
    align-items: center;
    gap: 10px;
}
.follow-btn{
    color: white;
    background-color: black;
    border: none;
    padding: 8px 16px;
    border-radius: 30px;
    font-weight: bold;
}
.f-text{
  display: flex;
  gap: 10px;
  align-items: center;

}
.p-photo{
    width: 50px;
    height: 50px;
    border-radius: 25px;
}
.message-div{
   position: absolute;
    left: 50%;
    top: 3%;
    width: 50%;
    transform: translate(-50%, -50%);
    background-color: #1DA1F2;
    color: white;
    padding: 15px;
    z-index: 999;
    text-align: center;
}
}
</style>
</head>
<body>
    @if (session()->has('message'))

    <div class="message-div" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
    <p class="message">
        {{session('message')}}
    </p>
    </div>
    @endif
    <div class="others">
        <h2 style="display:flex;justify-content:center;">People you can follow</h2>
        <br>
        @foreach ($users as $user)
        @if ($user->id == auth()->user()->id)
             
        @else
        <div class="follow">
            <div class="follow-id">  
                <img class="p-photo" src="/storage/{{$user->profile->pphoto}}" alt="">  
                <div class="f-text">
                    <p style="font-size: large; font-weight: bold;">{{$user->name}}</p>
                    <p style="font-size: medium;">{{'@' . $user->username}}</p>
                </div>
            </div>     
            <form action=" /users/{{$user->username}}/follow" method="POST">
                @csrf
                @if (auth()->user()->following->contains($user->id))
                    <button onclick="" class="follow-btn">Following</button>
                @else
                <button onclick="" class="follow-btn">Follow</button>
                @endif
            </form>
        </div>
        <hr>
        @endif
        @endforeach
        <br>
        {{$users->links()}}
        <div>
            <a  style="display: flex; justify-content:center; text-decoration: none; color:#03a9f4; margin:10px 0;" href="/">Skip</a>
            <p style="text-align: center">You have to follow a user before you can view their post.</p>
    </div>  
</body>
<script src="https://cdn.tailwindcss.com"></script>
</html>