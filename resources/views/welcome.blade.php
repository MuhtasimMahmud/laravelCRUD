<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script
        src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <style type="text/tailwindcss">
        @layer utilities{
            .container{
                @apply px-10 mx-auto;
            }

            .btn{
                @apply text-white rounded py-2 px-4
            }
        }
    </style>
    <title>Welcome</title>

</head>
<body>

    <div class="container">
        <div class="flex justify-between my-5">
            <h2 class="text-red-500 text-xl"> Home </h2>
            <a href="/create" class="btn bg-green-600"> Add New Contact </a>
        </div>
        @if(session('success'))
            <h2 class="text-green-600"> {{ session ('success')}}</h2>
        @endif

        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 border border-green-500 my-5">
                            <thead class="bg-green-600 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium ">ID</th>

                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium">Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium">Contact</th>

                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium">Image</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($posts as $post)
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->id }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800"> {{ $post->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"> {{ $post->contact }} </td>

                                <td class="px-6 py-4">
                                    <img src="images/{{ $post->image }}" alt="" class="w-12 h-12 object-cover rounded-full border border-gray-300 shadow-sm">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <a href="{{ route('edit', $post->id) }}" class="btn bg-green-600 hover:text-blue-800 mr-4">
                                        Edit
                                    </a>

                                    <form method="post" action="{{route('delete', $post->id)}}" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button class="bg-red-600 text-white rounded py-2 px-4" type="submit"> Delete </button>
                                    </form>

                                </td>

                            </tr>
                            @endforeach




                            </tbody>
                        </table>


                        <!--pagination-->
                        <div class="px-6 py-8">
                            <div class="[&_*]:!bg-white [&_*]:!text-gray-800">
                                {{ $posts->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>



</body>
</html>
