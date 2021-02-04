<div>
    <h3>{{$article->title}}</h3>
    @if($article->img)
        <div>
            <img src="{{$article->img}}" title="{{$article->title}}" alt="{{$article->title}}" >
        </div>
    @endif
    <div>
        {{$article->text}}
    </div>
</div>
