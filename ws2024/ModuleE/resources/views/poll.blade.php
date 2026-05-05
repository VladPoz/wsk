<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>{{$poll->title}}</title>
</head>
<body>
<div class="container">
    <h1 class="title">{{$poll->title}}</h1>
    <h3>{{$poll->description}}</h3>
    <h3 style="margin-block: 1rem">{{$poll->category->name}}</h3>
    <form method="post" action="{{route('poll.submit', $poll->slug)}}">
        @csrf
        @foreach($poll->questions as $item)
            @if($item->type === 'single')
                <div style="margin-block: 1rem">
                    <p style="margin-bottom: .3rem"><b>{{$item->question}}</b></p>
                    @foreach($answers as $answer)
                        @if($answer->question_id === $item->id)
                            <div>
                                <input name="{{$answer->question_id}}" value="{{$answer->id}}" type="radio" required>
                                <label>{{$answer->answer}}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div style="margin-block: 1rem">
                    <p style="margin-bottom: .3rem"><b>{{$item->question}}</b></p>
                    @foreach($answers as $answer)
                        @if($answer->question_id === $item->id)
                            <div>
                                <input name="{{$answer->question_id}}[]" value="{{$answer->id}}" type="checkbox">
                                <label>{{$answer->answer}}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach
        <button type="submit">Send</button>
    </form>
</div>
</body>
</html>
