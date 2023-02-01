@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')<section class="pt-16 pb-10 lg:pt-[100px] lg:pb-20">
    <div class="container mx-auto">

        <div class="accordion_wrapper">
            <div class="accordion" id="accordion1">
                <div class="accordion_head">
                    <h4 class="accordion_head_title">Lorem ipsum dolor sit amet.</h4>
                    <span class="accordion_head_toggler">
                        <svg aria-hidden="true" viewBox="0 0 8 6" width="12" height="10" fill="none" class="pointer-events-none stroke-slate-700">
                            <path d="M7 1.5l-3 3-3-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="accordion_body">
                    <div class="accordion_content">
                        <p class="text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae voluptatem aut maiores
                            fuga eum, repellendus iure quam officia corrupti id totam quisquam. Eum ut tempore temporibus doloremque
                            ipsam in sequi.</p>
                        <p class="text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae voluptatem aut maiores
                            fuga eum, repellendus iure quam officia corrupti id totam quisquam. Eum ut tempore temporibus doloremque
                            ipsam in sequi.</p>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordion2">
                <div class="accordion_head">
                    <h4 class="accordion_head_title">Lorem ipsum dolor sit amet.</h4>
                    <span class="accordion_head_toggler">
                        <svg aria-hidden="true" viewBox="0 0 8 6" width="12" height="10" fill="none" class="pointer-events-none stroke-slate-700">
                            <path d="M7 1.5l-3 3-3-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="accordion_body">
                    <div class="accordion_content">
                        <p class="text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae voluptatem aut maiores
                            fuga eum, repellendus iure quam officia corrupti id totam quisquam. Eum ut tempore temporibus doloremque
                            ipsam in sequi.</p>
                        <p class="text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae voluptatem aut maiores
                            fuga eum, repellendus iure quam officia corrupti id totam quisquam. Eum ut tempore temporibus doloremque
                            ipsam in sequi.</p>
                        <p class="text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae voluptatem aut maiores
                            fuga eum, repellendus iure quam officia corrupti id totam quisquam. Eum ut tempore temporibus doloremque
                            ipsam in sequi.</p>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordion3">
                <div class="accordion_head">
                    <h4 class="accordion_head_title">Lorem ipsum dolor sit amet.</h4>
                    <span class="accordion_head_toggler">
                        <svg aria-hidden="true" viewBox="0 0 8 6" width="12" height="10" fill="none" class="pointer-events-none stroke-slate-700">
                            <path d="M7 1.5l-3 3-3-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="accordion_body">
                    <div class="accordion_content">
                        <p class="text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae voluptatem aut maiores
                            fuga eum, repellendus iure quam officia corrupti id totam quisquam. Eum ut tempore temporibus doloremque
                            ipsam in sequi.</p>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordion4">
                <div class="accordion_head">
                    <h4 class="accordion_head_title">Lorem ipsum dolor sit amet.</h4>
                    <span class="accordion_head_toggler">
                        <svg aria-hidden="true" viewBox="0 0 8 6" width="12" height="10" fill="none" class="pointer-events-none stroke-slate-700">
                            <path d="M7 1.5l-3 3-3-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="accordion_body">
                    <div class="accordion_content">
                        <p class="text">Lorem ipsu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

<script>
    window.addEventListener('load', function() {
        var allAccordionList = document.querySelectorAll('.accordion_wrapper')
        allAccordionList.forEach(function(accordionList) {
            const headers = accordionList.getElementsByClassName("accordion_head"),
                contents = accordionList.getElementsByClassName("accordion_body");
            for (let i = 0; i < headers.length; i++) {
                headers[i].addEventListener("click", () => {
                    for (let j = 0; j < headers.length; j++) {
                        if (i == j) {
                            headers[j].classList.toggle('active')
                        } else {
                            headers[j].classList.remove('active')
                        }
                    }
                    for (let j = 0; j < contents.length; j++) {
                        if (i == j) {
                            contents[j].classList.toggle('show')
                        } else {
                            contents[j].classList.remove('show')
                        }
                        handleContentHeight(contents[j])
                    }
                });
            }
            for (let i = 0; i < contents.length; i++) {
                handleContentHeight(contents[i])
            }

            function handleContentHeight(content) {
                if (content.classList.contains('show')) {
                    content.style.maxHeight = content.scrollHeight + "px";
                } else {
                    content.style.maxHeight = 0;
                }
            }
        })
    })
</script>

@endpush

@section('custome_scipt')

@endsection