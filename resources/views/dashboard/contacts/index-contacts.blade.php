@extends('layouts.backend')

@section('content')

<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                <button type="button" 
                    href="Create contact route here" 
                    class="btn btn-sm btn-primary load-modal" 
                    data-type="contact" 
                    data-method="create">
                    <i class="fa fa-fw fa-plus mr-1"></i>
                    New Contact
                </button>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ url('/contacts') }}">Contacts</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="content bg-white">
    @if($contacts->count())
        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Website</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td class="font-w700 font-size-sm">
                                <!-- Contact Full Name -->
                            </td>
                            <td class="font-size-sm">
                                <!-- Contact Email -->
                            </td>
                            <td class="font-size-sm">
                                <!-- Contact Phone -->
                            </td>
                            <td class="font-size-sm">
                                <!-- Contact Website Name  -->
                            </td>
                            <td class="pr-0 font-size-sm">
                                <div class="dropleft">
                                    <button type="button" 
                                        class="btn btn-sm btn-light dropdown-toggle dropdown-toggle-split" 
                                        data-toggle="dropdown" 
                                        aria-haspopup="true" 
                                        aria-expanded="false">
                                        View
                                        <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu font-size-sm" style="">
                                        <a class="dropdown-item load-modal" 
                                            data-type="contact" 
                                            data-method="edit"
                                            href="Edit contact route here">
                                            Edit
                                        </a>
                                        <form action="Delete contact route here" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you to delete this contact?')"
                                                class="dropdown-item text-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="block block-rounded mt-4">
            <div class="block-content">
                <p>No contacts found.</p>
            </div>
        </div>
    @endif
</div>

@endsection
