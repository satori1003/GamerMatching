<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat
        </h2>
    </x-slot>
    <div class="antialiased">
        <h1 class='title'>
            {{ $game->gametitle }} トークルーム
        </h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" onsubmit="onsubmit_Form(); return false;">
                        メッセージ : <input type="text" id="input_message" autocomplete="off" />
                        <input type="hidden" id="game_id" name="game_id" value="{{ $game->id }}"> 
                        <button type="submit" class="text-white bg-blue-700 px-5 py-2">送信</button>
                    </form>
                
                    <ul class="list-disc" id="list_message">
                        @foreach ($messages as $message)
                        <a href="/messages/{{ $message->id }}">
                            <li>
                                <strong>{{ $message->user->name }}</strong>
                                <div>{{ $message->body }}</div>
                                <p>{{ $message->created_at}}</p>
                            </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
        <div class='footer'>
            <a href="/home">戻る</a>
        </div>
    </div>
    <script>
        const elementInputMessage = document.getElementById( "input_message" );
        const gameId = document.getElementById("game_id").value;
        
        {{-- formのsubmit処理 --}}
        function onsubmit_Form()
        {
            
            {{-- 送信用テキストHTML要素からメッセージ文字列の取得 --}}
            let strMessage = elementInputMessage.value;
            if( !strMessage )
            {
                return;
            }
            params = { 
                'message': strMessage,
                'game_id': gameId
            };
            
            {{-- POSTリクエスト送信処理とレスポンス取得処理 --}}
            axios
                .post('/talk', params )
                .then( response => {
                    console.log(response);
                    console.log(gameId)
                } )
                .catch(error => {
                    console.log(error.response)
                } );
            {{-- テキストHTML要素の中身のクリア --}}
            elementInputMessage.value = "";
        }
        window.addEventListener("DOMContentLoaded", () => {
            const elementListMessage = document.getElementById("list_message");
            // created_atのフォーマット関数
    function formatCreatedAt(createdAt) {
        const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        return new Date(createdAt).toLocaleString('ja-JP', options);
    }
            
            // Listen開始と、イベント発生時の処理の定義
            window.Echo.private('chat').listen('MessageSent', (e) => {
                console.log(e);
                
                // 受け取ったメッセージのchat_idがこのページのchat_idと一致する場合のみ表示
                if (e.chat.game_id === gameId) {
                    let strUsername = e.chat.userName;
                    let strMessage = e.chat.body;
                    let messageId = e.chat.message_id;
                    let createdAt = e.chat.created_at;
        
                    let elementLi = document.createElement("li");
                    let elementUsername = document.createElement("strong");
                    let elementMessage = document.createElement("div");
                    let elementCreatedAt = document.createElement("p");
                    
                    elementUsername.textContent = strUsername;
                    elementMessage.textContent = strMessage;
                    elementCreatedAt.textContent = formatCreatedAt(createdAt);
                    elementMessage.addEventListener("click", () => {
                        window.location.href = `/messages/${messageId}`;
                    });
                    elementLi.append(elementUsername);
                    elementLi.append(elementMessage);
                    elementLi.append(elementCreatedAt);
                    elementListMessage.prepend(elementLi); // リストの一番上に追加
                }
            });
        });
    </script>
</x-app-layout>
