<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        #app{
            padding : 20px;
        }
    </style>
</head>
<body>
<div id="app">
    <table class="table" v-if="stickers.length > 0">
        <thead>
            <tr>
                <th v-for="header in headers">@{{header}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="sticker in stickers">
                <td v-for="content in Object.values(sticker)">@{{content}}</td>
            </tr>
        </tbody>
    </table>

    <div v-else class="alert alert-info">No data for now</div>

    <button class="btn btn-secondary" @click="getStickerCodes">
        <div v-if="isLoading" class="spinner-border text-info" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span v-else class="bi bi-arrow-clockwise">Refresh</span>
    </button>

</div>
</body>
<script>
    const { createApp } = Vue
    createApp({
        data() {
            return {
                stickers : <?php echo $data ?>,
                isLoading : false
            }
        },
        computed : {
            headers(){
                return Object.keys(this.stickers[0])
            },
        },
        methods : {
            async getStickerCodes(){
                try{
                    this.isLoading = true
                    const { data } = await axios.get('https://sheetdb.io/api/v1/vfego5gjhptkm?sort_by=name&sort_order=asc')

                    this.isLoading = false

                    this.stickers = data

                }catch(err){
                    this.isLoading = false
                    console.log(err)
                }
            }
        },
        mounted() {
            console.log(this.stickers)
        },
    }).mount('#app')
</script>
</html>

