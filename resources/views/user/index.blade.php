<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All User') }}
        </h2>
    </x-slot>


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>

                            <th>UserName</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script type="text/javascript">
    $(function () {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user') }}",
            columns: [
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'date_of_birth', name: 'date_of_birth'},
                {data: 'city', name: 'city'},
                {data: 'country', name: 'country'},
                {data: 'status' , name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
