<div class="banner">
    @foreach ($movies as $movie)
    <div class="banner-slide" style="background-image: url('{{ $movie['backdrop'] }}');"></div>
    <div class="banner_inner">
        <h1 class="primary-movie-name">{{ $movie['title'] }}</h1>
        <p class="primary-movie-info"> {{ $movie['release_date'] }}</p>
        <div class="primary-action">
            <a href="{{ $movie['id'] }}" class="primary-watch"><img src="./static/assets/button/watch-now.svg"
                    alt="Watch Now" /></a>
            <a href="#!" class="primary-save" id="likeButton">
                <img src="./static/assets/button/like.svg" class="likeImage" alt="Like" />
            </a>
        </div>
    </div>
    @endforeach
</div>