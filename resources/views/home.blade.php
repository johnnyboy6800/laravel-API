<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <h1> Congrats, you are logged in<h1>
        <form action="/logout" method="post">
            @csrf
            <button>
                log out
            </button>
        </form>
    <div>
        <h2>Create new post</h2>
        <form action="/create-post" method="post">
            @csrf
            <input type="text" name="title" placeholder="insira o título">
            <input type="text" name="body" placeholder="insita o texto da postagem">
            <button>save post</button>
        </form>
    </div>
    <div style="padding: 5%">
        <h2>All your posts</h2>
        @foreach ( $posts as $post )
        <div style="border: 2px solid black; background-color: gray; border-radius: 5px; margin-bottom: 15px;">
            <h3>{{$post['title']}}</h3>
            <p>by {{$post->user->name}}</p>
            <p>{{$post['body']}}</p>
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post -> id}}" method="post">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>
    @else
     <div>
        <h2>Register</h2>
        <form action="/register" method="post">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email"  type="text" placeholder="email">
            <input name="password" type="password" placeholder="senha">
            <button>Register</button>
        </form>
    </div>
      <div>
        <h2>Login</h2>
        
        <form action="/login" method="post">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="senha">
            <button>login</button>
        </form>
    </div>
    @endauth

   
</body>
</html>