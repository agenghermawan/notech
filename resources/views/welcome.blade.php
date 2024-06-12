@extends('components.layout')

@section('content')
<div class="wrapper my-4 container">
    <h1 class="my-5"> Item Management</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add Item
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add new Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" action="{{ route('store.item') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="productName" class="form-label"> Name</label>
                            <input type="text" class="form-control" id="productName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label"> Photo</label>
                            <input type="file" class="form-control" id="productPrice" name="photo" required>
                        </div>
                        <div class="mb-3">
                            <label for="purchase_price" class="form-label">Purchase Price</label>
                            <input type="number" class="form-control" id="purchase_price" name="purchase_price"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="sale_price" class="form-label">Sale Price</label>
                            <input type="number" class="form-control" id="sale_price" name="sale_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock Item</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger mt-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered" id="example">
            <thead>
                <tr >
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Purchase Price</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($dataItem as $item)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $item->name }}</td>
                    <td>
                        <img src="{{ Storage::url($item->photo) }}" alt="product" width="50px" height="auto">
                    </td>
                    <td>{{ $item->purchase_price }}</td>
                    <td>{{ $item->sale_price }}</td>
                    <td>{{ $item->stock }}</td>
                    <td  align="center">
                        <button type="button" class="btn btn-none" data-bs-toggle="modal" data-bs-target="#editModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16" style="vertical-align: top !important">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                              </svg>
                        </button>

                        <button type="button" class="btn btn-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <?xml version="1.0"?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="18px"
                                height="18px"
                                style="vertical-align: top !important"
                                >
                                <path
                                    d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z" />
                            </svg>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Item {{ $item->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('product.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="mb-3 text-start">
                                                <label for="productName" class="form-label"> Name</label>
                                                <input type="text" class="form-control" id="productName" name="name" value="{{ $item->name }}" required>
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label for="productPrice" class="form-label"> Photo</label>
                                                <input type="file" class="form-control" id="productPrice" name="photo" >
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label for="purchase_price" class="form-label">Purchase Price</label>
                                                <input type="number" class="form-control" id="purchase_price" name="purchase_price" value="{{ $item->purchase_price }}"
                                                    required>
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label for="sale_price" class="form-label">Sale Price</label>
                                                <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{ $item->sale_price }}" required>
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label for="stock" class="form-label">Stock Item</label>
                                                <input type="number" class="form-control" id="stock" name="stock" value="{{ $item->stock }}" required>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                 <button type="submit" class="btn btn-primary">Update Item</button>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure want to delete this item ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <form action="{{ route('product.delete', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button  type="submit" class="btn btn-primary">Yes</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
