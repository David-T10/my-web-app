<!DOCTYPE html>
<html>
    <head>
        <title>
            Posts
        </title>
    </head>
    <body>
        @if($user)
            <h1>{{$user}}'s List of Posts</h1>
            <p>This blog page has tons of posts, here is all the posts from {{$user}}.</p>
        @else
            <h1>Here is a list of all posts:<h1>
        @endif
    </body>
</html>