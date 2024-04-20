@extends('layouts.app')

@section('content')

<div x-data="memoData">
    <!-- index モード -->
    <template x-if="isModeIndex">
        <div>
            <div class="mb-5">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded" @click="onCreate">
                    メモを追加する
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <template x-for="memo in memos">
                    <div class="relative max-w-xs w-full h-auto border-2 bg-gray-50 shadow-lg rounded-lg overflow-hidden">
                        <div class="px-4 py-2">
                            <h1 class="font-bold mb-2 truncate" x-text="memo.title"></h1>
                            <p class="text-gray-700 text-base mb-5 whitespace-pre-wrap" x-text="memo.body"></p>
                        </div>
                        <div class="absolute bottom-2 right-4 space-x-2">
                            <a href="#" class="text-blue-500 hover:text-blue-700 text-sm" @click.prevent="onEdit(memo)">変更</a>
                            <a href="#" class="text-red-500 hover:text-red-700 text-sm" @click="onDelete(memo)">削除</a>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </template>

    <!-- form モード -->
    <template x-if="isModeForm">
        <div>
            <div class="mb-5">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded" @click="setMode('index')">
                    戻る
                </button>
            </div>
            <div class="w-full max-w-xl mx-auto mt-10">
                <!-- Title Input -->
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">タイトル:</label>
                    <input id="title" type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" x-model="params.title">
                </div>

                <!-- Body Textarea -->
                <div class="mb-6">
                    <label for="body" class="block text-gray-700 text-sm font-bold mb-2">本文:</label>
                    <textarea id="body" name="body" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" x-model="params.body"></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" @click="onSave">
                        送信
                    </button>
                </div>
            </div>
        </div>
    </template>

</div>

@endsection

@section('script')

<script>
    const memoData = {
        mode: 'index', // or `form`
        setMode(mode) {
            this.mode = mode;
            if (mode === 'form') {
                this.$nextTick(() => {
                    document.getElementById('title').focus();
                });
            }
        },
        isModeIndex() {
            return this.mode === 'index';
        },
        isModeForm() {
            return this.mode === 'form';
        },
        // Index
        params: {},
        onCreate() {
            this.params = {
                title: '',
                body: '',
            };
            this.setMode('form');
        },
        onEdit(memo) {
            this.params = memo;
            this.setMode('form');
        },
        // Form
        onSave() {
            if (!confirm('送信します。よろしいですか？')) return;
            const url = '{{ route('memo.save') }}';
            axios.post(url, this.params)
                .then(response => {
                    if (response.data.result === true) {
                        this.setMode('index');
                        this.getMemos();
                    }
                });
        },
        // Delete
        onDelete(memo) {
            if (!confirm('削除します。よろしいですか？')) return;
            const url = '{{ route('memo.destroy', '') }}/' + memo.id;
            const params = {
                _method: 'DELETE',
            };
            axios.post(url, params)
                .then(response => {
                    if (response.data.result === true) {
                        this.getMemos();
                    }
                });
        },
        memos: [],
        getMemos() {
            const url = '{{ route('memo.list') }}';
            axios.get(url)
                .then(response => {
                    this.memos = response.data;
                })
        },
        init() {
            this.getMemos();
        }
    };
</script>

@endsection