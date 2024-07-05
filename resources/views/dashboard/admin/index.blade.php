    @extends('dashboard.layouts.main')

    @section('container')
        <h3 class="text-capitalize mt-3">anda adalah admin</h3>
        <hr>

        <h3 class="text-uppercase text-center">data semua akun petugas</h3>
        <a href="/my-dashboard/admin/create-petugas" class="btn btn-primary d-block ms-auto" style="max-width: max-content">
            <i class="bi bi-person-plus-fill"></i> Buat akun petugas
        </a>
        <table class="shadow rounded">
            <thead>
                <tr class="text-capitalize">
                    <th>No</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($petugas as $index => $p)
                    <tr class="text-capitalize">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-lowercase">{{ $p->email }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->username }}</td>
                        <td class="d-flex flex-wrap gap-2">
                            <form action="{{ route('admin.suspend', $p->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-person-fill-x"></i> Suspend
                                </button>
                            </form>

                            <form action="{{ route('admin.ban', $p->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-person-fill-slash"></i> Banned
                                </button>
                            </form>

                            <form action="{{ route('admin.recover', $p->id) }}" method="POST"
                                class="{{ $p->is_suspended ? '' : 'd-none' }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-person-fill-up"></i> Recovery
                                </button>
                            </form>

                            <a href="{{ route('admin.edit', $p->id) }}" class="btn btn-secondary">
                                <i class="bi bi-person-fill-gear"></i> Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
            </script>
        @endif
    @endsection
