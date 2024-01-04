@extends('template.adminTemplate')
@section('title')
    <title>Writebot - AI Writing Assistant for Bloggers</title>

    <!-- Fonts -->
    <link
    href="https://fonts.bunny.net/css2?family=Space+Grotesk:wght@400;600;700&display=swap"
    rel="stylesheet"
    />
    <style>
    body {
        font-family: "Space Grotesk", sans-serif;
    }
    .title:empty:before {
        content: attr(data-placeholder);
        color: gray;
    }
    </style>

    <script src="https://unpkg.com/marked" defer></script>

@endsection
@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush
@section('content')

    <body class="antialiased">
        <div
            class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0"
        >
            <div class="max-w-6xl w-full mx-auto sm:px-6 lg:px-8 space-y-4 py-4">
            <div class="text-center text-gray-800 dark:text-gray-300 py-4">
                <h1 class="text-7xl font-bold">DurianAI</h1>
            </div>

            <div
                class="w-full rounded-md bg-white border-2 border-gray-600 p-4 min-h-[60px] h-full text-gray-600"
            >
                <div class="inline-flex gap-2 w-full">
                    <input
                        required
                        name="title"
                        class="w-full outline-none text-2xl font-bold"
                        placeholder="Generate your prompt here..."
                        id = "inputPrompt"
                    />
                    <button
                        class="rounded-md bg-emerald-500 px-4 py-2 text-white font-semibold" onclick="prompt()"
                    >
                        Generate
                    </button>
                </div>
            </div>
            <div class="w-full rounded-md bg-white border-2 border-gray-600 p-4 min-h-[720px] h-full text-gray-600" id="container">
                @isset($content)
                @php
                   echo $content;
                @endphp
                @endisset
            </div>
            </div>
        </div>
    </body>
@endsection
@push('script')
    <script>
        function prompt(){
            let value = $('#inputPrompt').val();
            console.log(value);
            $('#inputPrompt').val('');
            if(value != ''){
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }

                });
                $("#container").load('/write/generate',{
                    data:value
                },function(response){
                    $('#container').html(response);
                })
            }
            // $.ajax({
            //         type: 'POST',
            //         url: '/write/generate',
            //         data: $(this).serialize(),
            //         success: function(response) {
            //             if (response.content) {
            //                 // Concatenate the result into the existing content
            //                 var currentContent = $('textarea').val();
            //                 $('textarea').val(currentContent + response.content);
            //             }
            //         },
            //         error: function(error) {
            //             console.error(error.responseJSON.error);
            //         }
            //     });
        }
    </script>
@endpush
