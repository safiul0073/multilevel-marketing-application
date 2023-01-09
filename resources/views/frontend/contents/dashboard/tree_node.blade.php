
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
    <div class="flex flex-col justify-start items-center basis-1/2 shrink-0 min-w-max w-full">
        <div  class="flex justify-center items-center cursor-pointer">
            <div
                class="flex flex-col justify-evenly m-2 mt-3 items-center border-2 border-green-600 w-20 shrink-0 {{ $this_parent ? "" : "relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400" }}"
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
        <div class="w-full grid grid-cols-2 shrink-0 relative after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-2.5 after:bg-gray-400 before:absolute before:h-1 before:top-0 before:left-[25%] before:right-[25%] before:bg-gray-400">
            @include('frontend.contents.dashboard.tree_node', ['node' => $left_child, 'this_parent' => false])
            @include('frontend.contents.dashboard.tree_node', ['node' => $right_child, 'this_parent' => false])
        </div>
    </div>
@else
<div class="flex justify-center items-start basis-1/2 shrink-0">
    <div
        class="flex flex-col justify-center items-center border-2 border-green-600 m-2 mt-3 w-20 shrink-0 cursor-pointer relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400"
    >
        <h1 class="bg-green-600 p-0.5 w-full">Add new</h1>
        <img
            src="https://cdn-icons-png.flaticon.com/512/561/561169.png"
            width="100"
            height="100"
            class=" p-3"
            alt=""
        />
    </div>
</div>
@endif



