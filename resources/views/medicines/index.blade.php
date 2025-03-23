<h1>薬の検索</h1>

<form action="{{ route('medicines.index') }}" method="GET">
    <input type="text" name="query" value="{{ old('query', $query ?? '') }}" placeholder="薬名で検索">
    <button type="submit">検索</button>
</form>

@if($medicines->isEmpty())
    <p>該当する薬は見つかりませんでした。</p>
@else
    @foreach($medicines as $medicine)
        <div style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
            <h2>{{ $medicine->name }}</h2>
            <p>カテゴリ：{{ $medicine->category }}</p>
            <p>価格：{{ $medicine->price }} {{ $medicine->currency_code }}</p>
            <p>国：{{ $medicine->country }}</p>
            <p>{{ $medicine->description }}</p>
        </div>
    @endforeach
@endif
