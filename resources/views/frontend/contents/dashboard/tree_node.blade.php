
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
                class="flex cursor-pointer flex-col justify-evenly mx-5 my-3 items-center border-2 border-green-600 w-20 shrink-0 {{ $this_parent ? "" : "relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400" }}"
            >
                <h1 class="bg-green-600 p-0.5 w-full overflow-hidden">
                   {{  $node->username }}
                </h1>
                <img
                    src={{ $node->image ? $node->image->url : 'https://xsgames.co/randomusers/assets/avatars/male/24.jpg' }}
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
        href="{{ url("/set-sponsor/?sponsor_id=$referrar_username&position=$referrar_position")}}"
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



