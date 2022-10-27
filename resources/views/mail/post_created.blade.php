@component('mail::message')
{{-- <label for="">Titolo del nuovo post:</label>
<h1>
<a href="{{ route('admin.posts.show', $post) }}">
{{ $post->title }}
</a>
</h1> --}}

# nuovo post

Congratulazioni! Un nuovo post è stato aggiunto al tuo blog!

@component('mail::button', ['url' => route('admin.posts.show', $post)])
    {{ $post->title }}
@endcomponent

Grazie,<br>
    {{ config('app.name') }}
@endcomponent
