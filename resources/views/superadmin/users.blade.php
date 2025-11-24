{{-- resources/views/superadmin/users.blade.php --}}
<x-app-layout>
    <div class="page">
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title text-4xl font-black">
                                User Management ({{ $users->total() }})
                            </h2>
                            <div class="text-muted mt-1">Control every user across the empire</div>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <a href="#" class="btn btn-primary d-flex align-items-center gap-2">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="8.5" cy="7" r="4"/>
                                    <line x1="20" y1="8" x2="20" y2="14"/>
                                    <line x1="23" y1="11" x2="17" y2="11"/>
                                </svg>
                                Add New User
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="w-1">#</th>
                                            <th>User</th>
                                            <th>Business</th>
                                            <th>Role</th>
                                            <th>Last Login</th>
                                            <th>Status</th>
                                            <th class="w-1">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                                <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md me-4 bg-indigo-lt rounded">
                                                            <span class="avatar-initials text-2xl font-bold">
                                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-medium text-lg">{{ $user->name }}</div>
                                                            <div class="text-muted text-sm">{{ $user->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-sm font-medium">
                                                        {{ $user->business?->name ?? '—' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($user->is_super_admin)
                                                        <span class="badge bg-red text-white">Super Admin</span>
                                                    @elseif($user->hasRole('manager'))
                                                        <span class="badge bg-purple">Manager</span>
                                                    @elseif($user->hasRole('lifeguard'))
                                                        <span class="badge bg-blue">Lifeguard</span>
                                                    @else
                                                        <span class="badge bg-gray">Standard</span>
                                                    @endif
                                                </td>
                                                <td class="text-sm text-muted">
                                                    {{ $user->last_login_at?->diffForHumans() ?? 'Never' }}
                                                </td>
                                                <td>
                                                    @if($user->email_verified_at)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-warning">Unverified</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-list flex-nowrap">
                                                        <button class="btn btn-sm btn-ghost-primary">
                                                            Edit
                                                        </button>
                                                        <button class="btn btn-sm btn-ghost-red">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-16">
                                                    <div class="empty">
                                                        <div class="empty-icon text-9xl">👥</div>
                                                        <p class="empty-title text-3xl font-bold">No users found</p>
                                                        <p class="empty-subtitle text-muted text-xl">
                                                            Start by adding your first staff member
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($users->hasPages())
                            <div class="card-footer d-flex align-items-center">
                                <div class="text-muted">
                                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
                                </div>
                                <div class="ms-auto">
                                    {!! $users->links('vendor.pagination.tabler') !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>