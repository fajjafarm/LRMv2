{{-- resources/views/superadmin/businesses.blade.php --}}
<x-app-layout>
    <div class="page">
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title text-4xl font-black">
                                All Customers ({{ $businesses->total() }})
                            </h2>
                            <div class="text-muted mt-1">Your British leisure empire</div>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <a href="{{ route('admin.businesses.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v14m-7-7h14"/>
                                </svg>
                                Add New Customer
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
                                            <th>Customer</th>
                                            <th>Contact</th>
                                            <th>Facilities</th>
                                            <th>Users</th>
                                            <th>Revenue</th>
                                            <th>Status</th>
                                            <th class="w-1">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($businesses as $business)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                                <td>{{ $loop->iteration + ($businesses->currentPage() - 1) * $businesses->perPage() }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-3 bg-indigo-lt rounded">
                                                            <span class="avatar-initials">{{ strtoupper(substr($business->name, 0, 2)) }}</span>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-medium text-lg">{{ $business->name }}</div>
                                                            <div class="text-muted text-sm">{{ $business->slug }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-sm">
                                                        {{ $business->contact_email ?? '—' }}
                                                    </div>
                                                    <div class="text-muted text-xs">
                                                        {{ $business->phone ?? '—' }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-green-lt text-green">
                                                        {{ $business->facilities_count ?? 0 }} Facilities
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-blue-lt text-blue">
                                                        {{ $business->users_count ?? 0 }} Users
                                                    </span>
                                                </td>
                                                <td class="text-center font-bold text-xl">
                                                    £{{ number_format($business->monthly_price ?? 0, 0) }}
                                                    <small class="text-muted d-block">/month</small>
                                                </td>
                                                <td>
                                                    @if($business->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-list flex-nowrap">
                                                        <a href="#" class="btn btn-sm btn-primary">
                                                            View
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-ghost-secondary">
                                                            Edit
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-12">
                                                    <div class="empty">
                                                        <div class="empty-icon">🏢</div>
                                                        <p class="empty-title">No customers yet</p>
                                                        <p class="empty-subtitle text-muted">
                                                            Start by adding your first leisure centre
                                                        </p>
                                                        <a href="{{ route('admin.businesses.create') }}" class="btn btn-primary mt-4">
                                                            Add First Customer
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($businesses->hasPages())
                            <div class="card-footer d-flex align-items-center">
                                <div class="text-muted">
                                    Showing {{ $businesses->firstItem() }} to {{ $businesses->lastItem() }} of {{ $businesses->total() }} results
                                </div>
                                <div class="ms-auto">
                                    {!! $businesses->links('vendor.pagination.tabler') !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>