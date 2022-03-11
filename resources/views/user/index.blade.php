<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
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

                {data: 'id', name: 'id'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'date_of_birth', name: 'date_of_birth'},
                {data: 'city', name: 'city'},
                {data: 'country', name: 'country'},
                {data: 'status' , name: 'status'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });

    });
</script>
