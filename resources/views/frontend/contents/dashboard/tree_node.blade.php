
@if ($node)
@php
    $left_child = null;
    $right_child = null;
    foreach($node->children as $n) {
        if ($n->id == $node->left_ref_id) {
            $left_child = $n;
        }

        if ($n->id == $node->right_ref_id) {
            $right_child = $n;
        }
    }
@endphp
    <div class="flex flex-col w-auto justify-start relative before:absolute before:h-1 before:top-0 before:bg-gray-400 {{ $position }}" >
        <div  class="flex justify-center items-center">
            <div
                data-modal="modal-view-user"
                onclick="showModalData({{ $node->id }})"
                class="flex cursor-pointer flex-col justify-evenly mx-5 my-3 items-center border-2 border-green-600 w-20 shrink-0 {{ $this_parent ? "" : "relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400" }}"
            >
                <h1 class="bg-green-600 p-0.5 w-full overflow-hidden">
                   {{  $node->username }}
                </h1>
                <img
                    src={{ $node->image ? $node->image->url : 'https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg' }}
                    width="100"
                    height="100"
                    class="p-1"
                    alt=""
                />
            </div>
        </div>
        <div class="flex justify-center relative after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-3 after:bg-gray-400">
            @include('frontend.contents.dashboard.tree_node', [
                'node' => $left_child,
                'this_parent' => false,
                'position'  => 'before:left-[50%] before:right-[0%]',
                'referrar_position' => 'left',
                'referrar_username' => $node->username
                ])
            @include('frontend.contents.dashboard.tree_node', [
                'node' => $right_child,
                'this_parent' => false,
                'position'  => 'before:left-[0%] before:right-[50%]',
                'referrar_position' => 'right',
                'referrar_username' => $node->username
                ])
        </div>
    </div>
@else

<div class="flex justify-center items-start relative before:absolute before:h-1 before:top-0 before:bg-gray-400 {{ $position }}" >
    <a
        class="flex flex-col justify-center items-center border-2 border-green-600 mx-1 my-3 w-20 shrink-0 cursor-pointer relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400"
        href="{{ url("/set-sponsor/?sponsor_id=$referrar_username&position=$referrar_position&map=1")}}"
    >
        <h1 class="bg-green-600 p-0.5 w-full">Add new</h1>
        <img
            src="https://cdn-icons-png.flaticon.com/512/561/561169.png"
            width="100"
            height="100"
            class=" p-3"
            alt=""
        />
    </a>
</div>
@endif

<div class="fixed inset-0 flex z-50 modal overflow-y-auto p-10" id="modal-view-user">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity modal-exit"></div>
    <div class="flex flex-col m-auto transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:p-6">
        <h1 id="ful_name_id"></h1>
        <div class="absolute top-0 right-0 pt-2 pr-2">
            <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 modal-exit">
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="bg-white">

            <div class="mx-auto py-8 px-4 sm:px-6 ">
                <div class=" w-3/4 mx-auto">
                    <div class="w-full flex justify-center items-center">
                        <img
                             alt="avatar"
                             class="w-32 h-32 rounded-full"
                             id="avatar"
                        />
                    </div>
                    <h1 id="reward"></h1>
                    <h1 id="username_id"></h1>
                    <h1 id="left"></h1>
                    <h1 id="right"></h1>
                    <h1 id="left_carry"></h1>
                    <h1 id="right_carry"></h1>
                    <h1 id="joined_date"></h1>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom_scipt')
    <script>
        async function showModalData (id) {
            const res = await fetch('modal-view/'+id)
            var data = await res.json()
            document.getElementById("ful_name_id").innerHTML =  data.full_name
            let avatar = document.getElementById("avatar");
            avatar.src = data.avatar ? data.avatar : "https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg"
            document.getElementById("reward").innerHTML = "Reward: " + data.reward
            document.getElementById("username_id").innerHTML = "Username: " + data.username
            document.getElementById("left").innerHTML = "Left: " + data.left
            document.getElementById("right").innerHTML = "Right: " + data.right
            document.getElementById("left_carry").innerHTML = "Left Carry: " + data.left_count
            document.getElementById("right_carry").innerHTML = "Right Carry: " + data.right_count
            document.getElementById("joined_date").innerHTML = "Joined Date: " + new Date(data.joined_date)
        }
    </script>
@endpush



