@foreach($articles as $article)
    <div>
        <h3>{{$article->title}}</h3>
        <div>
            {{ mb_strimwidth($article->text, 0, 200, "...")}}
        </div>
        <div>
            <a href="{{ route('article.show', $article)}}">Подробнее</a>
        </div>
    </div>
    </hr>
@endforeach