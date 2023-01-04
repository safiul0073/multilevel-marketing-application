@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
    <div class="lg:flex xl:flex justify-center items-center ">
        <div class="lg:w-1/2 xl:w-1/2 mx-auto">
            {{-- error message show or success message show component --}}
            @include('frontend.layouts.partials.flash-alert')
            {{-- error show or success message shop composnent --}}
            @if ($product)
                <div>
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->title}}</td>
                                <td>{{$product->price}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>{{$product->price}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>{{$product->price}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

            <div>
                <form  action="{{ route('save.user') }}" method="POST">
                    @method("post")
                    @csrf
                    <input type="hidden" name="slug" value="{{ $slug }}" >
                    <input type="hidden" name="sponsor_id" value="{{ $sponsor_id }}" >
                    <input type="hidden" name="refer_position" value="{{ $position }}" >
                    <input type="hidden" name="first_name" value="{{ $first_name }}" >
                    <input type="hidden" name="last_name" value="{{ $last_name }}" >
                    <input type="hidden" name="email" value="{{ $email }}" >
                    <input type="hidden" name="phone" value="{{ $phone }}" >
                    <input type="hidden" name="username" value="{{ $username }}" >
                    <input type="hidden" name="password" value="{{ $password }}" >
                    <div class="form-group">
                        <label for="epin_id">E-Pin Code</label>
                        <input type="text" name="epin_code" class="form-control">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

@endsection
